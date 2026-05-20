<div wire:ignore.self id="classRoomModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.class_room') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.class_room') }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.components._form_errors')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
                        <select wire:model="academy_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($academies as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.campus') }} <span class="text-danger">*</span></label>
                        <select wire:model="campus_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($campuses as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.menu.program') }} <span class="text-danger">*</span></label>
                        <select wire:model="program_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($programs as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.menu.subject') }} <span class="text-danger">*</span></label>
                        <select wire:model="subject_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.menu.academic_year') }} <span class="text-danger">*</span></label>
                        <select wire:model="academic_year_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($academicYears as $y)
                                <option value="{{ $y->id }}">{{ $y->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.menu.semester') }} <span class="text-danger">*</span></label>
                        <select wire:model="semester_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($semesters as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
                        <input wire:model="class_code" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
                        <input wire:model="name" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.room_no') }}</label>
                        <input wire:model="room_no" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.menu.teacher') }} <span class="text-danger">*</span></label>
                        <select wire:model="teacher_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($teachers as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.start_date') }}</label>
                        <input wire:model="start_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.end_date') }}</label>
                        <input wire:model="end_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.max_students') }}</label>
                        <input wire:model="max_students" type="number" min="0" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.status') }}</label>
                        <select wire:model="status" class="form-select">
                            <option value="active">{{ __('app.status.active') }}</option>
                            <option value="closed">{{ __('app.status.closed') }}</option>
                            <option value="inactive">{{ __('app.status.inactive') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('app.actions.cancel') }}</button>
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="save">{{ __('app.actions.save') }}</span>
                    <span wire:loading wire:target="save">…</span>
                </button>
            </div>
        </form>
    </div>
</div>
