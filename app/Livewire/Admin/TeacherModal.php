<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Campus;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class TeacherModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $campus_id = null;

    public ?int $user_id = null;

    public string $teacher_code = '';

    public string $name = '';

    public ?string $gender = null;

    public ?string $dob = null;

    public ?string $phone = null;

    public ?string $email = null;

    public ?string $address = null;

    public ?string $qualification = null;

    public ?string $specialization = null;

    public ?string $joining_date = null;

    public string $salary_type = 'fixed';

    public ?string $salary_amount = null;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'teacher_code' => ['required', 'string', 'max:50', 'unique:teachers,teacher_code'.($this->editingId ? ",{$this->editingId}" : '')],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female'],
            'dob' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'joining_date' => ['nullable', 'date'],
            'salary_type' => ['required', 'in:fixed,per_class,per_session'],
            'salary_amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,inactive,resigned'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset([
            'editingId', 'academy_id', 'campus_id', 'user_id', 'teacher_code', 'name',
            'gender', 'dob', 'phone', 'email', 'address', 'qualification', 'specialization',
            'joining_date', 'salary_amount',
        ]);
        $this->salary_type = 'fixed';
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('teacher:create')]
    public function openCreate(): void
    {
        $this->ensurePermission('teacher.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'teacherModal');
    }

    #[On('teacher:edit')]
    public function openEdit(int $id): void
    {
        $this->ensurePermission('teacher.edit');
        $this->resetForm();
        $t = Teacher::findOrFail($id);
        $this->editingId = $t->id;
        $this->academy_id = $t->academy_id;
        $this->campus_id = $t->campus_id;
        $this->user_id = $t->user_id;
        $this->teacher_code = (string) $t->teacher_code;
        $this->name = (string) $t->name;
        $this->gender = $t->gender;
        $this->dob = optional($t->dob)->format('Y-m-d');
        $this->phone = $t->phone;
        $this->email = $t->email;
        $this->address = $t->address;
        $this->qualification = $t->qualification;
        $this->specialization = $t->specialization;
        $this->joining_date = optional($t->joining_date)->format('Y-m-d');
        $this->salary_type = (string) ($t->salary_type ?: 'fixed');
        $this->salary_amount = $t->salary_amount !== null ? (string) $t->salary_amount : null;
        $this->status = (string) $t->status;
        $this->dispatch('modal:show', id: 'teacherModal');
    }

    public function save(): void
    {
        $this->ensurePermission($this->editingId ? 'teacher.edit' : 'teacher.create');
        $data = $this->validate();

        if ($this->editingId) {
            Teacher::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Teacher::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'teacherModal');
        $this->dispatch('datatable:reload', table: 'teachers-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('teacher:delete')]
    public function delete(int $id): void
    {
        $this->ensurePermission('teacher.delete');
        Teacher::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'teachers-table');
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
        return view('livewire.admin.teacher-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'campuses' => Campus::orderBy('name')->get(['id', 'name']),
            'users' => User::where('user_type', 'teacher')->orderBy('name')->get(['id', 'name']),
        ]);
    }
}
