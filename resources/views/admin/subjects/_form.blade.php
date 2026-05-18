@include('admin.components._form_errors')
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $subject->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.menu.program') }} <span class="text-danger">*</span></label>
        <select name="program_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($programs as $p)
                <option value="{{ $p->id }}" @selected(old('program_id', $subject->program_id) == $p->id)>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
        <input name="code" type="text" required class="form-control" value="{{ old('code', $subject->code) }}">
    </div>
    <div class="col-md-5">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $subject->name) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.credit') }}</label>
        <input name="credit" type="number" step="0.5" min="0" class="form-control" value="{{ old('credit', $subject->credit ?? 0) }}">
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.common.description') }}</label>
        <textarea name="description" rows="2" class="form-control">{{ old('description', $subject->description) }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            <option value="active"   @selected(old('status', $subject->status ?: 'active') === 'active')>{{ __('app.status.active') }}</option>
            <option value="inactive" @selected(old('status', $subject->status) === 'inactive')>{{ __('app.status.inactive') }}</option>
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.subjects.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
