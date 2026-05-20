<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public string $name = '';

    public string $slug = '';

    public ?string $description = null;

    public string $status = 'active';

    /** @var array<int,int> */
    public array $permissions = [];

    protected function rules(): array
    {
        return [
            'academy_id' => ['nullable', 'exists:academies,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'name', 'slug', 'description']);
        $this->status = 'active';
        $this->permissions = [];
        $this->resetErrorBag();
    }

    #[On('role:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('role.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'roleModal');
    }

    #[On('role:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('role.edit');
        $this->resetForm();
        $r = Role::with('permissions:id')->findOrFail($id);
        $this->editingId = $r->id;
        $this->academy_id = $r->academy_id;
        $this->name = (string) $r->name;
        $this->slug = (string) $r->slug;
        $this->description = $r->description;
        $this->status = (string) $r->status;
        $this->permissions = $r->permissions->pluck('id')->map(fn ($v) => (int) $v)->all();
        $this->dispatch('modal:show', id: 'roleModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'role.edit' : 'role.create');
        $data = $this->validate();
        $perms = $data['permissions'] ?? [];
        unset($data['permissions']);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($this->editingId) {
            $r = Role::findOrFail($this->editingId);
            $r->update($data);
            $r->permissions()->sync($perms);
            $msg = __('app.updated_successfully');
        } else {
            $r = Role::create($data);
            $r->permissions()->sync($perms);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'roleModal');
        $this->dispatch('datatable:reload', table: 'roles-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('role:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('role.delete');
        Role::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'roles-table');
        $this->dispatch('toast:success', message: __('app.deleted_successfully'));
    }

    protected function ensurePermission(string $permission): void
    {
        $user = auth()->user();
        if (! $user || ! $user->hasPermission($permission)) {
            abort(403, __('app.not_authorized'));
        }
    }

    public function render()
    {
        return view('livewire.admin.role-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'permissionsList' => Permission::orderBy('module')->orderBy('name')->get(['id', 'module', 'name'])->groupBy('module'),
        ]);
    }
}
