<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Campus;
use App\Models\Student;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class StudentModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $campus_id = null;

    public ?int $user_id = null;

    public string $student_code = '';

    public string $name = '';

    public ?string $gender = null;

    public ?string $dob = null;

    public ?string $phone = null;

    public ?string $email = null;

    public ?string $address = null;

    public ?string $photo = null;

    public ?string $admission_date = null;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'student_code' => ['required', 'string', 'max:50', 'unique:students,student_code'.($this->editingId ? ",{$this->editingId}" : '')],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female'],
            'dob' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'photo' => ['nullable', 'string'],
            'admission_date' => ['nullable', 'date'],
            'status' => ['required', 'in:active,inactive,blocked'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingId', 'academy_id', 'campus_id', 'user_id', 'student_code', 'name',
            'gender', 'dob', 'phone', 'email', 'address', 'photo', 'admission_date',
        ]);
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('student:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('student.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'studentModal');
    }

    #[On('student:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('student.edit');
        $this->resetForm();
        $s = Student::findOrFail($id);
        $this->editingId = $s->id;
        $this->academy_id = $s->academy_id;
        $this->campus_id = $s->campus_id;
        $this->user_id = $s->user_id;
        $this->student_code = (string) $s->student_code;
        $this->name = (string) $s->name;
        $this->gender = $s->gender;
        $this->dob = optional($s->dob)->format('Y-m-d');
        $this->phone = $s->phone;
        $this->email = $s->email;
        $this->address = $s->address;
        $this->photo = $s->photo;
        $this->admission_date = optional($s->admission_date)->format('Y-m-d');
        $this->status = (string) $s->status;
        $this->dispatch('modal:show', id: 'studentModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'student.edit' : 'student.create');
        $data = $this->validate();

        if ($this->editingId) {
            Student::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Student::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'studentModal');
        $this->dispatch('datatable:reload', table: 'students-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('student:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('student.delete');
        Student::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'students-table');
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
        return view('livewire.admin.student-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'campuses' => Campus::orderBy('name')->get(['id', 'name']),
            'users' => User::where('user_type', 'student')->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
