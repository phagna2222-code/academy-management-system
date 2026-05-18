<?php

namespace App\Livewire\Admin;

use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Semester;
use Livewire\Attributes\On;
use Livewire\Component;

class SemesterModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $academic_year_id = null;

    public string $name = '';

    public ?string $start_date = null;

    public ?string $end_date = null;

    public ?int $sort_order = 0;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,closed'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'academic_year_id', 'name', 'start_date', 'end_date']);
        $this->sort_order = 0;
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('semester:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('semester.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'semesterModal');
    }

    #[On('semester:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('semester.edit');
        $this->resetForm();
        $s = Semester::findOrFail($id);
        $this->editingId = $s->id;
        $this->academy_id = $s->academy_id;
        $this->academic_year_id = $s->academic_year_id;
        $this->name = (string) $s->name;
        $this->start_date = optional($s->start_date)->format('Y-m-d');
        $this->end_date = optional($s->end_date)->format('Y-m-d');
        $this->sort_order = $s->sort_order ?? 0;
        $this->status = (string) $s->status;
        $this->dispatch('modal:show', id: 'semesterModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'semester.edit' : 'semester.create');
        $data = $this->validate();

        if ($this->editingId) {
            Semester::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Semester::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'semesterModal');
        $this->dispatch('datatable:reload', table: 'semesters-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('semester:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('semester.delete');
        Semester::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'semesters-table');
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
        return view('livewire.admin.semester-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'academicYears' => AcademicYear::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
