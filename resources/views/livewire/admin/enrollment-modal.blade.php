<div wire:ignore.self id="enrollmentModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.enrollment') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.enrollment') }}
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
                        <label class="form-label">{{ __('app.menu.program') }} <span class="text-danger">*</span></label>
                        <select wire:model="program_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($programs as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.menu.class_room') }} <span class="text-danger">*</span></label>
                        <select wire:model="class_room_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($classRooms as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.menu.student') }} <span class="text-danger">*</span></label>
                        <select wire:model="student_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($students as $s)
                                <option value="{{ $s->id }}">[{{ $s->student_code }}] {{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('app.fields.enrollment_no') }} <span class="text-danger">*</span></label>
                        <input wire:model="enrollment_no" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('app.fields.enrollment_date') }} <span class="text-danger">*</span></label>
                        <input wire:model="enrollment_date" type="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.status') }}</label>
                        <select wire:model="status" class="form-select">
                            @foreach(['active','completed','dropped','transferred','cancelled'] as $s)
                                <option value="{{ $s }}">{{ __('app.status.'.$s) }}</option>
                            @endforeach
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
