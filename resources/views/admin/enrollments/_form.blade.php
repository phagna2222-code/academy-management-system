@include('admin.components._form_errors')
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $enrollment->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.campus') }} <span class="text-danger">*</span></label>
        <select name="campus_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($campuses as $c)
                <option value="{{ $c->id }}" @selected(old('campus_id', $enrollment->campus_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.academic_year') }} <span class="text-danger">*</span></label>
        <select name="academic_year_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academicYears as $y)
                <option value="{{ $y->id }}" @selected(old('academic_year_id', $enrollment->academic_year_id) == $y->id)>{{ $y->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.semester') }}</label>
        <select name="semester_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($semesters as $s)
                <option value="{{ $s->id }}" @selected(old('semester_id', $enrollment->semester_id) == $s->id)>{{ $s->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.program') }}</label>
        <select name="program_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($programs as $p)
                <option value="{{ $p->id }}" @selected(old('program_id', $enrollment->program_id) == $p->id)>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.class_room') }} <span class="text-danger">*</span></label>
        <select name="class_room_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($classRooms as $c)
                <option value="{{ $c->id }}" @selected(old('class_room_id', $enrollment->class_room_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.menu.student') }} <span class="text-danger">*</span></label>
        <select name="student_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($students as $s)
                <option value="{{ $s->id }}" @selected(old('student_id', $enrollment->student_id) == $s->id)>[{{ $s->student_code }}] {{ $s->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.enrollment_no') }} <span class="text-danger">*</span></label>
        <input name="enrollment_no" type="text" required class="form-control" value="{{ old('enrollment_no', $enrollment->enrollment_no) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.enrollment_date') }} <span class="text-danger">*</span></label>
        <input name="enrollment_date" type="text" required class="form-control flatpickr-date" value="{{ old('enrollment_date', optional($enrollment->enrollment_date)->format('Y-m-d') ?: now()->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            @foreach(['active','completed','dropped','transferred','cancelled'] as $s)
                <option value="{{ $s }}" @selected(old('status', $enrollment->status ?: 'active') === $s)>{{ __('app.status.'.$s) }}</option>
            @endforeach
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
