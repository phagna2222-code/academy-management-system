<div wire:ignore.self id="teacherModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.teacher') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.teacher') }}
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
                        <label class="form-label">{{ __('app.fields.linked_user') }}</label>
                        <select wire:model="user_id" class="form-select">
                            <option value="">—</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.teacher_code') }} <span class="text-danger">*</span></label>
                        <input wire:model="teacher_code" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
                        <input wire:model="name" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.gender') }}</label>
                        <select wire:model="gender" class="form-select">
                            <option value="">—</option>
                            <option value="male">{{ __('app.gender.male') }}</option>
                            <option value="female">{{ __('app.gender.female') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.dob') }}</label>
                        <input wire:model="dob" type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.phone') }}</label>
                        <input wire:model="phone" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.common.email') }}</label>
                        <input wire:model="email" type="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.qualification') }}</label>
                        <input wire:model="qualification" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.specialization') }}</label>
                        <input wire:model="specialization" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.joining_date') }}</label>
                        <input wire:model="joining_date" type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.salary_type') }} <span class="text-danger">*</span></label>
                        <select wire:model="salary_type" class="form-select">
                            <option value="fixed">{{ __('app.salary_type.fixed') }}</option>
                            <option value="per_class">{{ __('app.salary_type.per_class') }}</option>
                            <option value="per_session">{{ __('app.salary_type.per_session') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('app.fields.salary_amount') }}</label>
                        <input wire:model="salary_amount" type="number" step="0.01" min="0" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('app.common.address') }}</label>
                        <textarea wire:model="address" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.status') }}</label>
                        <select wire:model="status" class="form-select">
                            <option value="active">{{ __('app.status.active') }}</option>
                            <option value="inactive">{{ __('app.status.inactive') }}</option>
                            <option value="resigned">{{ __('app.status.resigned') }}</option>
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
