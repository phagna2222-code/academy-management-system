<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Campus;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class CampusModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public string $name = '';

    public string $code = '';

    public ?string $phone = null;

    public ?string $email = null;

    public ?string $address = null;

    public ?int $manager_id = null;

    public bool $is_main = false;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'manager_id' => ['nullable', 'exists:users,id'],
            'is_main' => ['boolean'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'name', 'code', 'phone', 'email', 'address', 'manager_id']);
        $this->is_main = false;
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('campus:create')]
    public function openCreate(): void
    {
        $this->authorize('campus.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'campusModal');
    }

    #[On('campus:edit')]
    public function openEdit(int $id): void
    {
        $this->authorize('campus.edit');
        $this->resetForm();
        $c = Campus::findOrFail($id);
        $this->editingId = $c->id;
        $this->academy_id = $c->academy_id;
        $this->name = (string) $c->name;
        $this->code = (string) $c->code;
        $this->phone = $c->phone;
        $this->email = $c->email;
        $this->address = $c->address;
        $this->manager_id = $c->manager_id;
        $this->is_main = (bool) $c->is_main;
        $this->status = (string) $c->status;
        $this->dispatch('modal:show', id: 'campusModal');
    }

    public function save(): void
    {
        $this->authorize($this->editingId ? 'campus.edit' : 'campus.create');
        $data = $this->validate();

        if ($this->editingId) {
            Campus::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Campus::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'campusModal');
        $this->dispatch('datatable:reload', table: 'campuses-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('campus:delete')]
    public function delete(int $id): void
    {
        $this->authorize('campus.delete');
        Campus::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'campuses-table');
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
        return view('livewire.admin.campus-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'managers' => User::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
