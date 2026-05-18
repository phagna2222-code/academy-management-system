<?php

namespace App\Livewire\Admin;

use App\Models\AcademicYear;
use App\Models\Academy;
use Livewire\Attributes\On;
use Livewire\Component;

class AcademicYearModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public string $name = '';

    public ?string $start_date = null;

    public ?string $end_date = null;

    public bool $is_current = false;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_current' => ['boolean'],
            'status' => ['required', 'in:active,closed'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'name', 'start_date', 'end_date']);
        $this->is_current = false;
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('academic_year:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('academic_year.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'academicYearModal');
    }

    #[On('academic_year:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('academic_year.edit');
        $this->resetForm();
        $y = AcademicYear::findOrFail($id);
        $this->editingId = $y->id;
        $this->academy_id = $y->academy_id;
        $this->name = (string) $y->name;
        $this->start_date = optional($y->start_date)->format('Y-m-d');
        $this->end_date = optional($y->end_date)->format('Y-m-d');
        $this->is_current = (bool) $y->is_current;
        $this->status = (string) $y->status;
        $this->dispatch('modal:show', id: 'academicYearModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'academic_year.edit' : 'academic_year.create');
        $data = $this->validate();

        if ($this->editingId) {
            AcademicYear::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            AcademicYear::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'academicYearModal');
        $this->dispatch('datatable:reload', table: 'academic-years-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('academic_year:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('academic_year.delete');
        AcademicYear::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'academic-years-table');
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
        return view('livewire.admin.academic-year-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
