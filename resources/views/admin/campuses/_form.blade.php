@include('admin.components._form_errors')

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $campus->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
        <input name="code" type="text" required class="form-control" value="{{ old('code', $campus->code) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $campus->name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.phone') }}</label>
        <input name="phone" type="text" class="form-control" value="{{ old('phone', $campus->phone) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.email') }}</label>
        <input name="email" type="email" class="form-control" value="{{ old('email', $campus->email) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.manager') }}</label>
        <select name="manager_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($managers as $m)
                <option value="{{ $m->id }}" @selected(old('manager_id', $campus->manager_id) == $m->id)>{{ $m->name }} ({{ $m->email }})</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.common.address') }}</label>
        <textarea name="address" rows="2" class="form-control">{{ old('address', $campus->address) }}</textarea>
    </div>
    <div class="col-md-6">
        <div class="form-check form-switch mt-4">
            <input class="form-check-input" type="checkbox" name="is_main" value="1" id="is_main" @checked(old('is_main', $campus->is_main))>
            <label class="form-check-label" for="is_main">{{ __('app.common.is_main') }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active"   @selected(old('status', $campus->status) === 'active')>{{ __('app.status.active') }}</option>
            <option value="inactive" @selected(old('status', $campus->status) === 'inactive')>{{ __('app.status.inactive') }}</option>
        </select>
    </div>
</div>

<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.campuses.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
