<?php

namespace App\Livewire\Admin;

use App\Models\Academy;
use App\Models\Program;
use App\Models\Subject;
use Livewire\Attributes\On;
use Livewire\Component;

class SubjectModal extends Component
{
    public ?int $editingId = null;

    public ?int $academy_id = null;

    public ?int $program_id = null;

    public string $name = '';

    public string $code = '';

    public ?string $credit = null;

    public ?string $description = null;

    public string $status = 'active';

    protected function rules(): array
    {
        return [
            'academy_id' => ['required', 'exists:academies,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'credit' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'academy_id', 'program_id', 'name', 'code', 'credit', 'description']);
        $this->status = 'active';
        $this->resetErrorBag();
    }

    #[On('subject:create')]
    public function openCreate(): void
    {
        $this->authorize('subject.create');
        $this->resetForm();
        $this->dispatch('modal:show', id: 'subjectModal');
    }

    #[On('subject:edit')]
    public function openEdit(int $id): void
    {
        $this->authorize('subject.edit');
        $this->resetForm();
        $s = Subject::findOrFail($id);
        $this->editingId = $s->id;
        $this->academy_id = $s->academy_id;
        $this->program_id = $s->program_id;
        $this->name = (string) $s->name;
        $this->code = (string) $s->code;
        $this->credit = $s->credit !== null ? (string) $s->credit : null;
        $this->description = $s->description;
        $this->status = (string) $s->status;
        $this->dispatch('modal:show', id: 'subjectModal');
    }

    public function save(): void
    {
        $this->authorize($this->editingId ? 'subject.edit' : 'subject.create');
        $data = $this->validate();

        if ($this->editingId) {
            Subject::findOrFail($this->editingId)->update($data);
            $msg = __('app.updated_successfully');
        } else {
            Subject::create($data);
            $msg = __('app.created_successfully');
        }

        $this->dispatch('modal:hide', id: 'subjectModal');
        $this->dispatch('datatable:reload', table: 'subjects-table');
        $this->dispatch('toast:success', message: $msg);
        $this->resetForm();
    }

    #[On('subject:delete')]
    public function delete(int $id): void
    {
        $this->authorize('subject.delete');
        Subject::findOrFail($id)->delete();
        $this->dispatch('datatable:reload', table: 'subjects-table');
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
        return view('livewire.admin.subject-modal', [
            'academies' => Academy::orderBy('name')->get(['id', 'name']),
            'programs' => Program::orderBy('name')->get(['id', 'name']),
        ]);
    }
}
