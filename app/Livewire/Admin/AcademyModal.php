<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use Livewire\Attributes\On;
use Livewire\Component;

class AcademyModal extends Component
{
    public ?int $editingId = null;

    public string $name = '';

    public string $code = '';

    public ?string $owner_name = null;

    public ?string $phone = null;

    public ?string $email = null;

    public ?string $website = null;

    public ?string $address = null;

    public ?string $logo = null;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:academies,code'.($this->editingId ? ",{$this->editingId}" : '')],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'code', 'owner_name', 'phone', 'email', 'website', 'address', 'logo']);
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('academy:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('academy.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'academyModal');
    }

    #[On('academy:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('academy.edit');
        $this->resetForm();
        $a = Academy::findOrFail($id);
        $this->editingId = $a->id;
        $this->name = (string) $a->name;
        $this->code = (string) $a->code;
        $this->owner_name = $a->owner_name;
        $this->phone = $a->phone;
        $this->email = $a->email;
        $this->website = $a->website;
        $this->address = $a->address;
        $this->logo = $a->logo;
        $this->status = (string) $a->status;
        $this->dispatch('modal:show', id: 'academyModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'academy.edit' : 'academy.create');
        $data = $this->validate();

        if ($this->editingId) {
            Academy::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Academy::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'academyModal');
        $this->dispatch('datatable:reload', table: 'academies-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('academy:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('academy.delete');
        Academy::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'academies-table');
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
        return view('livewire.admin.academy-modal');
    }
}
