<div wire:ignore.self id="userModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form wire:submit.prevent="save" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @if($editingId)
                        {{ __('app.actions.edit') }} — {{ __('app.menu.user') }}
                    @else
                        {{ __('app.actions.create') }} — {{ __('app.menu.user') }}
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
                            <option value="">—</option>
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
                        <label class="form-label">{{ __('app.common.email') }} <span class="text-danger">*</span></label>
                        <input wire:model="email" type="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.phone') }}</label>
                        <input wire:model="phone" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.user_type') }} <span class="text-danger">*</span></label>
                        <select wire:model="user_type" class="form-select">
                            @foreach(['super_admin','admin','teacher','student','finance'] as $t)
                                <option value="{{ $t }}">{{ __('app.user_type.'.$t) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            {{ __('app.fields.password') }}
                            @if(! $editingId) <span class="text-danger">*</span> @endif
                        </label>
                        <input wire:model="password" type="password" class="form-control" autocomplete="new-password">
                        @if($editingId)
                            <div class="form-text">{{ __('app.fields.password_leave_blank') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.fields.password_confirm') }}</label>
                        <input wire:model="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('app.common.status') }}</label>
                        <select wire:model="status" class="form-select">
                            @foreach(['active','inactive','blocked'] as $s)
                                <option value="{{ $s }}">{{ __('app.status.'.$s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('app.menu.roles') }}</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($allRoles as $r)
                                <div class="form-check">
                                    <input wire:model="roles" value="{{ $r->id }}" id="user-role-{{ $r->id }}" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="user-role-{{ $r->id }}">{{ $r->name }}</label>
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
