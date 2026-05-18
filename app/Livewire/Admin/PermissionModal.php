<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PermissionModal extends Component
{
    public ?int $editingId = null;

    public string $module = '';

    public string $name = '';

    public string $slug = '';

    public ?string $description = null;

    protected function rules(): array
    {
        return [
            'module' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:permissions,slug'.($this->editingId ? ",{$this->editingId}" : '')],
            'description' => ['nullable', 'string'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'module', 'name', 'slug', 'description']);
        $this->resetErrorBag();
    }

    #[On('permission:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('permission.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'permissionModal');
    }

    #[On('permission:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('permission.edit');
        $this->resetForm();
        $p = Permission::findOrFail($id);
        $this->editingId = $p->id;
        $this->module = (string) $p->module;
        $this->name = (string) $p->name;
        $this->slug = (string) $p->slug;
        $this->description = $p->description;
        $this->dispatch('modal:show', id: 'permissionModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'permission.edit' : 'permission.create');
        $data = $this->validate();
        $data['slug'] = $data['slug'] ?: Str::slug($data['module'].'.'.$data['name'], '.');

        if ($this->editingId) {
            Permission::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Permission::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'permissionModal');
        $this->dispatch('datatable:reload', table: 'permissions-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('permission:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('permission.delete');
        Permission::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'permissions-table');
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
        return view('livewire.admin.permission-modal');
    }
}
