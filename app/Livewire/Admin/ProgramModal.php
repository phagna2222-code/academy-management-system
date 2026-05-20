<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Campus;
use App\Models\Program;
use Livewire\Attributes\On;
use Livewire\Component;

class ProgramModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $campus_id = null;

    public string $name = '';

    public string $code = '';

    public ?string $description = null;

    public ?int $duration_years = null;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['nullable', 'exists:campuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'duration_years' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'campus_id', 'name', 'code', 'description', 'duration_years']);
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('program:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('program.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'programModal');
    }

    #[On('program:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('program.edit');
        $this->resetForm();
        $p = Program::findOrFail($id);
        $this->editingId = $p->id;
        $this->academy_id = $p->academy_id;
        $this->campus_id = $p->campus_id;
        $this->name = (string) $p->name;
        $this->code = (string) $p->code;
        $this->description = $p->description;
        $this->duration_years = $p->duration_years;
        $this->status = (string) $p->status;
        $this->dispatch('modal:show', id: 'programModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'program.edit' : 'program.create');
        $data = $this->validate();

        if ($this->editingId) {
            Program::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Program::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'programModal');
        $this->dispatch('datatable:reload', table: 'programs-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('program:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('program.delete');
        Program::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'programs-table');
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
        return view('livewire.admin.program-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'campuses' => Campus::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
