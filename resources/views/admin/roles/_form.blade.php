@include('admin.components._form_errors')

@php $attached = $attached ?? ($role->exists ? $role->permissions->pluck('id')->all() : []); @endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $role->name) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.slug') }}</label>
        <input name="slug" type="text" class="form-control" value="{{ old('slug', $role->slug) }}">
        <div class="form-text">{{ __('app.common.optional') }}</div>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.academy') }}</label>
        <select name="academy_id" class="form-select tom-select">
            <option value="">{{ __('app.common.all') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $role->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.common.description') }}</label>
        <textarea name="description" rows="2" class="form-control">{{ old('description', $role->description) }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">{{ __('app.menu.permissions') }}</label>
        <div class="border rounded p-3">
            @foreach($permissions as $module => $perms)
                <details class="mb-2" open>
                    <summary class="fw-semibold text-capitalize">{{ str_replace('_',' ', $module) }}</summary>
                    <div class="row g-2 mt-2">
                        @foreach($perms as $p)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $p->id }}" id="perm-{{ $p->id }}"
                                           @checked(in_array($p->id, old('permissions', $attached)))>
                                    <label class="form-check-label small" for="perm-{{ $p->id }}">{{ $p->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </details>
            @endforeach
        </div>
    </div>

    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active"   @selected(old('status', $role->status ?: 'active') === 'active')>{{ __('app.status.active') }}</option>
            <option value="inactive" @selected(old('status', $role->status) === 'inactive')>{{ __('app.status.inactive') }}</option>
        </select>
    </div>
</div>

<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
