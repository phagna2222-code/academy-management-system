@include('admin.components._form_errors')
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $program->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.campus') }}</label>
        <select name="campus_id" class="form-select tom-select">
            <option value="">{{ __('app.common.all') }}</option>
            @foreach($campuses as $c)
                <option value="{{ $c->id }}" @selected(old('campus_id', $program->campus_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
        <input name="code" type="text" required class="form-control" value="{{ old('code', $program->code) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $program->name) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.duration_years') }}</label>
        <input name="duration_years" type="number" step="0.5" min="0" class="form-control" value="{{ old('duration_years', $program->duration_years ?? 1) }}">
    </div>
    <div class="col-md-9">
        <label class="form-label">{{ __('app.common.description') }}</label>
        <textarea name="description" rows="2" class="form-control">{{ old('description', $program->description) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active"   @selected(old('status', $program->status ?: 'active') === 'active')>{{ __('app.status.active') }}</option>
            <option value="inactive" @selected(old('status', $program->status) === 'inactive')>{{ __('app.status.inactive') }}</option>
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.programs.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
