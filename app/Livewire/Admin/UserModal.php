<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Campus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class UserModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $campus_id = null;

    public string $name = '';

    public string $email = '';

    public ?string $phone = null;

    public string $user_type = 'admin';

    public string $status = 'active';

    public string $password = '';

    public string $password_confirmation = '';

    /** @var array<int,int> */
    public array $roles = [];

    protected function rules(): array
    {
        return [
            'academy_id' => ['nullable', 'exists:academies,id'],
            'campus_id' => ['nullable', 'exists:campuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'.($this->editingId ? ",{$this->editingId}" : '')],
            'phone' => ['nullable', 'string', 'max:50'],
            'user_type' => ['required', 'in:super_admin,admin,teacher,student,finance'],
            'status' => ['required', 'in:active,inactive,blocked'],
            'password' => [$this->editingId ? 'nullable' : 'required', 'confirmed', 'min:6'],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,id'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'campus_id', 'name', 'email', 'phone', 'password', 'password_confirmation']);
        $this->user_type = 'admin';
        $this->status = 'active';
        $this->roles = [];
        $this->resetErrorBag();
    }

    #[On('user:create')]
    public function openCreate(): void
    {
        $this->authorize('user.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'userModal');
    }

    #[On('user:edit')]
    public function openEdit(int $id): void
    {
        $this->authorize('user.edit');
        $this->resetForm();
        $u = User::with('roles:id')->findOrFail($id);
        $this->editingId = $u->id;
        $this->academy_id = $u->academy_id;
        $this->campus_id = $u->campus_id;
        $this->name = (string) $u->name;
        $this->email = (string) $u->email;
        $this->phone = $u->phone;
        $this->user_type = (string) $u->user_type;
        $this->status = (string) $u->status;
        $this->roles = $u->roles->pluck('id')->map(fn ($v) => (int) $v)->all();
        $this->dispatch('modal:show', id: 'userModal');
    }

    public function save(): void
    {
        $this->authorize($this->editingId ? 'user.edit' : 'user.create');
        $data = $this->validate();
        $roles = $data['roles'] ?? [];
        unset($data['roles'], $data['password_confirmation']);

        if ($this->editingId) {
            $u = User::findOrFail($this->editingId);
            if (! empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
            $u->update($data);
            $u->roles()->sync($roles);
            $msg = __('app.updated_successfully');
        } else {
            $data['password'] = Hash::make($data['password']);
            $u = User::create($data);
            $u->roles()->sync($roles);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'userModal');
        $this->dispatch('datatable:reload', table: 'users-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('user:delete')]
    public function delete(int $id): void
    {
        $this->authorize('user.delete');
        if ($id === auth()->id()) {
            $this->dispatch('toast:warning', message: __('app.not_authorized'));

            return;
        }
        User::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'users-table');
        $this->dispatch('toast:success', message: __('app.deleted_successfully'));
    }

    protected function authorize(string $permission): void
    {
        $user = auth()->user();
        if (! $user || ! $user->hasPermission($permission)) {
            abort(403, __('app.not_authorized'));
        }
    }

    public function render()
    {
        return view('livewire.admin.user-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'campuses' => Campus::orderBy('name')->get(['id', 'name']),
            'allRoles' => Role::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
