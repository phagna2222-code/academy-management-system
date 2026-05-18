<div wire:ignore.self id="campusModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.campus') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.campus') }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.components._form_errors')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
                        <select wire:model="academy_id" class="form-select" required>
                            <option value="">{{ __('app.common.choose') }}</option>
                            @foreach($academies as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
                        <input wire:model="name" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
                        <input wire:model="code" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.phone') }}</label>
                        <input wire:model="phone" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.email') }}</label>
                        <input wire:model="email" type="email" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.manager') }}</label>
                        <select wire:model="manager_id" class="form-select">
                            <option value="">—</option>
                            @foreach($managers as $m)
                                <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('app.common.address') }}</label>
                        <textarea wire:model="address" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input wire:model="is_main" id="campus-is-main" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="campus-is-main">{{ __('app.fields.is_main') }}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.status') }}</label>
                        <select wire:model="status" class="form-select">
                            <option value="active">{{ __('app.status.active') }}</option>
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
