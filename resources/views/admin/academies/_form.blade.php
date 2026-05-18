@include('admin.components._form_errors')

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" class="form-control" required value="{{ old('name', $academy->name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
        <input name="code" type="text" class="form-control" required value="{{ old('code', $academy->code) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.owner_name') }}</label>
        <input name="owner_name" type="text" class="form-control" value="{{ old('owner_name', $academy->owner_name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.phone') }}</label>
        <input name="phone" type="text" class="form-control" value="{{ old('phone', $academy->phone) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.email') }}</label>
        <input name="email" type="email" class="form-control" value="{{ old('email', $academy->email) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.website') }}</label>
        <input name="website" type="text" class="form-control" value="{{ old('website', $academy->website) }}">
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.common.address') }}</label>
        <textarea name="address" rows="2" class="form-control">{{ old('address', $academy->address) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active"   @selected(old('status', $academy->status) === 'active')>{{ __('app.status.active') }}</option>
            <option value="inactive" @selected(old('status', $academy->status) === 'inactive')>{{ __('app.status.inactive') }}</option>
        </select>
    </div>
</div>

<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.academies.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
