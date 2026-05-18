@include('admin.components._form_errors')

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $semester->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.menu.academic_year') }} <span class="text-danger">*</span></label>
        <select name="academic_year_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academicYears as $y)
                <option value="{{ $y->id }}" @selected(old('academic_year_id', $semester->academic_year_id) == $y->id)>{{ $y->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $semester->name) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.sort') }}</label>
        <input name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $semester->sort_order ?? 0) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.start_date') }}</label>
        <input name="start_date" type="text" class="form-control flatpickr-date" value="{{ old('start_date', optional($semester->start_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.end_date') }}</label>
        <input name="end_date" type="text" class="form-control flatpickr-date" value="{{ old('end_date', optional($semester->end_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active" @selected(old('status', $semester->status ?: 'active') === 'active')>{{ __('app.status.active') }}</option>
            <option value="closed" @selected(old('status', $semester->status) === 'closed')>{{ __('app.status.closed') }}</option>
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.semesters.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
