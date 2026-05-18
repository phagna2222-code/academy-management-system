@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.enrollments'))
@section('breadcrumbTitle', __('app.menu.enrollments'))
@section('content')
    @include('admin.components._datatable_card', [
        'title'       => __('app.enrollment.plural'),
        'createRoute' => 'admin.enrollments.create',
        'dataUrl'     => route('admin.enrollments.data'),
        'tableId'     => 'enr-table',
        'columns'     => [
            ['data' => 'id',                 'title' => __('app.common.id')],
            ['data' => 'enrollment_no',      'title' => __('app.fields.enrollment_no')],
            ['data' => 'student_name',       'title' => __('app.menu.student'), 'orderable' => false],
            ['data' => 'class_room_name',    'title' => __('app.menu.class_room'), 'orderable' => false],
            ['data' => 'academic_year_name', 'title' => __('app.menu.academic_year'), 'orderable' => false],
            ['data' => 'semester_name',      'title' => __('app.menu.semester'), 'orderable' => false],
            ['data' => 'campus_name',        'title' => __('app.fields.campus'), 'orderable' => false],
            ['data' => 'enrollment_date',    'title' => __('app.fields.enrollment_date')],
            ['data' => 'status',             'title' => __('app.common.status')],
            ['data' => 'actions',            'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
