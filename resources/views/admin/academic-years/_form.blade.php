@include('admin.components._form_errors')

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $academicYear->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $academicYear->name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.start_date') }}</label>
        <input name="start_date" type="text" class="form-control flatpickr-date" value="{{ old('start_date', optional($academicYear->start_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.end_date') }}</label>
        <input name="end_date" type="text" class="form-control flatpickr-date" value="{{ old('end_date', optional($academicYear->end_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <div class="form-check form-switch mt-4">
            <input class="form-check-input" type="checkbox" name="is_current" value="1" id="is_current" @checked(old('is_current', $academicYear->is_current))>
            <label class="form-check-label" for="is_current">{{ __('app.common.is_current') }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active" @selected(old('status', $academicYear->status ?: 'active') === 'active')>{{ __('app.status.active') }}</option>
            <option value="closed" @selected(old('status', $academicYear->status) === 'closed')>{{ __('app.status.closed') }}</option>
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.academic-years.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
