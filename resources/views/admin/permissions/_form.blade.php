@include('admin.components._form_errors')

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.module') }} <span class="text-danger">*</span></label>
        <input name="module" type="text" required class="form-control" value="{{ old('module', $permission->module) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $permission->name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.slug') }}</label>
        <input name="slug" type="text" class="form-control" value="{{ old('slug', $permission->slug) }}">
        <div class="form-text">{{ __('app.common.optional') }}</div>
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.common.description') }}</label>
        <textarea name="description" rows="2" class="form-control">{{ old('description', $permission->description) }}</textarea>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.permissions.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
