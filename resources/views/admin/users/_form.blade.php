@include('admin.components._form_errors')

@php $userRoleIds = $user->exists ? $user->roles->pluck('id')->all() : []; @endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $user->name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.email') }} <span class="text-danger">*</span></label>
        <input name="email" type="email" required class="form-control" value="{{ old('email', $user->email) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.phone') }}</label>
        <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.user_type') }} <span class="text-danger">*</span></label>
        <select name="user_type" class="form-select tom-select">
            @foreach(['super_admin','admin','teacher','student','finance'] as $t)
                <option value="{{ $t }}" @selected(old('user_type', $user->user_type) === $t)>{{ __('app.user_type.'.$t) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }}</label>
        <select name="academy_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $user->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.campus') }}</label>
        <select name="campus_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($campuses as $c)
                <option value="{{ $c->id }}" @selected(old('campus_id', $user->campus_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.password') }} @if(!$user->exists) <span class="text-danger">*</span> @endif</label>
        <input name="password" type="password" class="form-control" autocomplete="new-password">
        <div class="form-text">{{ $user->exists ? __('app.common.optional') : '' }}</div>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.password_confirm') }}</label>
        <input name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.menu.roles') }}</label>
        <select name="roles[]" class="form-select tom-select" multiple>
            @foreach($roles as $r)
                <option value="{{ $r->id }}" @selected(in_array($r->id, old('roles', $userRoleIds)))>{{ $r->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            @foreach(['active','inactive','blocked'] as $s)
                <option value="{{ $s }}" @selected(old('status', $user->status ?: 'active') === $s)>{{ __('app.status.'.$s) }}</option>
            @endforeach
        </select>
    </div>
</div>

<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
