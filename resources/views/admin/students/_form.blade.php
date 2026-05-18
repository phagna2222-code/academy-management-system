@include('admin.components._form_errors')
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $student->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.campus') }} <span class="text-danger">*</span></label>
        <select name="campus_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($campuses as $c)
                <option value="{{ $c->id }}" @selected(old('campus_id', $student->campus_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.student_code') }} <span class="text-danger">*</span></label>
        <input name="student_code" type="text" required class="form-control" value="{{ old('student_code', $student->student_code) }}">
    </div>
    <div class="col-md-5">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $student->name) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.gender') }}</label>
        <select name="gender" class="form-select tom-select">
            @foreach(['male','female'] as $g)
                <option value="{{ $g }}" @selected(old('gender', $student->gender ?: 'male') === $g)>{{ __('app.gender.'.$g) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.dob') }}</label>
        <input name="dob" type="text" class="form-control flatpickr-date" value="{{ old('dob', optional($student->dob)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.common.phone') }}</label>
        <input name="phone" type="text" class="form-control" value="{{ old('phone', $student->phone) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.email') }}</label>
        <input name="email" type="email" class="form-control" value="{{ old('email', $student->email) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.admission_date') }}</label>
        <input name="admission_date" type="text" class="form-control flatpickr-date" value="{{ old('admission_date', optional($student->admission_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.fields.linked_user') }}</label>
        <select name="user_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" @selected(old('user_id', $student->user_id) == $u->id)>{{ $u->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">{{ __('app.common.address') }}</label>
        <textarea name="address" rows="2" class="form-control">{{ old('address', $student->address) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            @foreach(['active','inactive','dropped'] as $s)
                <option value="{{ $s }}" @selected(old('status', $student->status ?: 'active') === $s)>{{ __('app.status.'.$s) }}</option>
            @endforeach
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.students.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
