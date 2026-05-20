<?php

namespace App\Livewire\Admin;

use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\ClassRoom;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Attributes\On;
use Livewire\Component;

class ClassRoomModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $campus_id = null;

    public ?int $program_id = null;

    public ?int $subject_id = null;

    public ?int $academic_year_id = null;

    public ?int $semester_id = null;

    public ?int $teacher_id = null;

    public string $class_code = '';

    public string $name = '';

    public ?string $room_no = null;

    public ?string $start_date = null;

    public ?string $end_date = null;

    public ?int $max_students = 0;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'class_code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'room_no' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'max_students' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:active,closed,inactive'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingId', 'academy_id', 'campus_id', 'program_id', 'subject_id',
            'academic_year_id', 'semester_id', 'teacher_id', 'class_code', 'name',
            'room_no', 'start_date', 'end_date',
        ]);
        $this->max_students = 0;
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('class_room:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('class_room.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'classRoomModal');
    }

    #[On('class_room:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('class_room.edit');
        $this->resetForm();
        $c = ClassRoom::findOrFail($id);
        $this->editingId = $c->id;
        $this->academy_id = $c->academy_id;
        $this->campus_id = $c->campus_id;
        $this->program_id = $c->program_id;
        $this->subject_id = $c->subject_id;
        $this->academic_year_id = $c->academic_year_id;
        $this->semester_id = $c->semester_id;
        $this->teacher_id = $c->teacher_id;
        $this->class_code = (string) $c->class_code;
        $this->name = (string) $c->name;
        $this->room_no = $c->room_no;
        $this->start_date = optional($c->start_date)->format('Y-m-d');
        $this->end_date = optional($c->end_date)->format('Y-m-d');
        $this->max_students = $c->max_students ?? 0;
        $this->status = (string) $c->status;
        $this->dispatch('modal:show', id: 'classRoomModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'class_room.edit' : 'class_room.create');
        $data = $this->validate();

        if ($this->editingId) {
            ClassRoom::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            ClassRoom::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'classRoomModal');
        $this->dispatch('datatable:reload', table: 'class-rooms-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('class_room:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('class_room.delete');
        ClassRoom::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'class-rooms-table');
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
        return view('livewire.admin.class-room-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'campuses' => Campus::orderBy('name')->get(['id', 'name']),
            'programs' => Program::orderBy('name')->get(['id', 'name']),
            'subjects' => Subject::orderBy('name')->get(['id', 'name']),
            'academicYears' => AcademicYear::orderBy('name')->get(['id', 'name']),
            'semesters' => Semester::orderBy('name')->get(['id', 'name']),
            'teachers' => Teacher::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
