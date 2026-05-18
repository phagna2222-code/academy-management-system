<div wire:ignore.self id="academyModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.academy.singular') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.academy.singular') }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.components._form_errors')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
                        <input wire:model="name" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
                        <input wire:model="code" type="text" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.owner_name') }}</label>
                        <input wire:model="owner_name" type="text" class="form-control">
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
                        <label class="form-label">{{ __('app.common.website') }}</label>
                        <input wire:model="website" type="text" class="form-control">
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
