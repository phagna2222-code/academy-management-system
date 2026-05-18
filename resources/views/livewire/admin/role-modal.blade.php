<div wire:ignore.self id="roleModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.role') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.role') }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.components._form_errors')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.academy') }}</label>
                        <select wire:model="academy_id" class="form-select">
                            <option value="">{{ __('app.common.all') }}</option>
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
                        <label class="form-label">{{ __('app.fields.slug') }}</label>
                        <input wire:model="slug" type="text" class="form-control">
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

                    <div class="col-12">
                        <label class="form-label fw-bold">{{ __('app.menu.permissions') }}</label>
                        <div class="row g-3">
                            @foreach($permissionsList as $module => $perms)
                                <div class="col-md-6">
                                    <div class="border rounded p-2 h-100">
                                        <div class="fw-semibold mb-2 text-capitalize">{{ str_replace('_', ' ', $module) }}</div>
                                        @foreach($perms as $p)
                                            <div class="form-check">
                                                <input wire:model="permissions" value="{{ $p->id }}" id="role-perm-{{ $p->id }}" class="form-check-input" type="checkbox">
                                                <label class="form-check-label" for="role-perm-{{ $p->id }}">{{ $p->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
