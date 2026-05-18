<div wire:ignore.self id="programModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.program') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.program') }}
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
                        <label class="form-label">{{ __('app.fields.campus') }}</label>
                        <select wire:model="campus_id" class="form-select">
                            <option value="">—</option>
                            @foreach($campuses as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
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
                        <label class="form-label">{{ __('app.fields.duration_years') }}</label>
                        <input wire:model="duration_years" type="number" min="0" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.status') }}</label>
                        <select wire:model="status" class="form-select">
                            <option value="active">{{ __('app.status.active') }}</option>
                            <option value="inactive">{{ __('app.status.inactive') }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('app.common.description') }}</label>
                        <textarea wire:model="description" rows="2" class="form-control"></textarea>
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
