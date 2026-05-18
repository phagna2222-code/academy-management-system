@include('admin.components._form_errors')
<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.academy') }} <span class="text-danger">*</span></label>
        <select name="academy_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academies as $a)
                <option value="{{ $a->id }}" @selected(old('academy_id', $classRoom->academy_id) == $a->id)>{{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.campus') }} <span class="text-danger">*</span></label>
        <select name="campus_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($campuses as $c)
                <option value="{{ $c->id }}" @selected(old('campus_id', $classRoom->campus_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.program') }} <span class="text-danger">*</span></label>
        <select name="program_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($programs as $p)
                <option value="{{ $p->id }}" @selected(old('program_id', $classRoom->program_id) == $p->id)>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.subject') }} <span class="text-danger">*</span></label>
        <select name="subject_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($subjects as $s)
                <option value="{{ $s->id }}" @selected(old('subject_id', $classRoom->subject_id) == $s->id)>{{ $s->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.academic_year') }} <span class="text-danger">*</span></label>
        <select name="academic_year_id" class="form-select tom-select" required>
            <option value="">{{ __('app.common.choose') }}</option>
            @foreach($academicYears as $y)
                <option value="{{ $y->id }}" @selected(old('academic_year_id', $classRoom->academic_year_id) == $y->id)>{{ $y->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.semester') }}</label>
        <select name="semester_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($semesters as $s)
                <option value="{{ $s->id }}" @selected(old('semester_id', $classRoom->semester_id) == $s->id)>{{ $s->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.code') }} <span class="text-danger">*</span></label>
        <input name="class_code" type="text" required class="form-control" value="{{ old('class_code', $classRoom->class_code) }}">
    </div>
    <div class="col-md-5">
        <label class="form-label">{{ __('app.common.name') }} <span class="text-danger">*</span></label>
        <input name="name" type="text" required class="form-control" value="{{ old('name', $classRoom->name) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.fields.room_no') }}</label>
        <input name="room_no" type="text" class="form-control" value="{{ old('room_no', $classRoom->room_no) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.menu.teacher') }}</label>
        <select name="teacher_id" class="form-select tom-select">
            <option value="">—</option>
            @foreach($teachers as $t)
                <option value="{{ $t->id }}" @selected(old('teacher_id', $classRoom->teacher_id) == $t->id)>{{ $t->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.start_date') }}</label>
        <input name="start_date" type="text" class="form-control flatpickr-date" value="{{ old('start_date', optional($classRoom->start_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.end_date') }}</label>
        <input name="end_date" type="text" class="form-control flatpickr-date" value="{{ old('end_date', optional($classRoom->end_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.fields.max_students') }}</label>
        <input name="max_students" type="number" min="0" class="form-control" value="{{ old('max_students', $classRoom->max_students ?? 0) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.common.status') }}</label>
        <select name="status" class="form-select tom-select">
            @foreach(['active','closed','inactive'] as $s)
                <option value="{{ $s }}" @selected(old('status', $classRoom->status ?: 'active') === $s)>{{ __('app.status.'.$s) }}</option>
            @endforeach
        </select>
    </div>
</div>
<hr>
<div class="d-flex gap-2 justify-content-end">
    <a href="{{ route('admin.class-rooms.index') }}" class="btn btn-light">{{ __('app.actions.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
</div>
