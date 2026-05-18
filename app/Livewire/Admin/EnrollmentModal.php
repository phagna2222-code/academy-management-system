<?php

namespace App\Livewire\Admin;

use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\ClassRoom;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class EnrollmentModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $campus_id = null;

    public ?int $academic_year_id = null;

    public ?int $semester_id = null;

    public ?int $program_id = null;

    public ?int $class_room_id = null;

    public ?int $student_id = null;

    public string $enrollment_no = '';

    public ?string $enrollment_date = null;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'class_room_id' => ['required', 'exists:class_rooms,id'],
            'student_id' => ['required', 'exists:students,id'],
            'enrollment_no' => ['required', 'string', 'max:50', 'unique:enrollments,enrollment_no'.($this->editingId ? ",{$this->editingId}" : '')],
            'enrollment_date' => ['required', 'date'],
            'status' => ['required', 'in:active,completed,dropped,transferred,cancelled'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingId', 'academy_id', 'campus_id', 'academic_year_id', 'semester_id',
            'program_id', 'class_room_id', 'student_id', 'enrollment_no',
        ]);
        $this->enrollment_date = now()->format('Y-m-d');
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('enrollment:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('enrollment.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'enrollmentModal');
    }

    #[On('enrollment:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('enrollment.edit');
        $this->resetForm();
        $e = Enrollment::findOrFail($id);
        $this->editingId = $e->id;
        $this->academy_id = $e->academy_id;
        $this->campus_id = $e->campus_id;
        $this->academic_year_id = $e->academic_year_id;
        $this->semester_id = $e->semester_id;
        $this->program_id = $e->program_id;
        $this->class_room_id = $e->class_room_id;
        $this->student_id = $e->student_id;
        $this->enrollment_no = (string) $e->enrollment_no;
        $this->enrollment_date = optional($e->enrollment_date)->format('Y-m-d');
        $this->status = (string) $e->status;
        $this->dispatch('modal:show', id: 'enrollmentModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'enrollment.edit' : 'enrollment.create');
        $data = $this->validate();

        if ($this->editingId) {
            Enrollment::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Enrollment::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'enrollmentModal');
        $this->dispatch('datatable:reload', table: 'enrollments-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('enrollment:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('enrollment.delete');
        Enrollment::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'enrollments-table');
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
        return view('livewire.admin.enrollment-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'campuses' => Campus::orderBy('name')->get(['id', 'name']),
            'academicYears' => AcademicYear::orderBy('name')->get(['id', 'name']),
            'semesters' => Semester::orderBy('name')->get(['id', 'name']),
            'programs' => Program::orderBy('name')->get(['id', 'name']),
            'classRooms' => ClassRoom::orderBy('name')->get(['id', 'name']),
            'students' => Student::orderBy('name')->get(['id', 'name', 'student_code']),
        ]);
    }
}
