@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.class_rooms'))
@section('breadcrumbTitle', __('app.menu.class_rooms'))
@section('content')
    @include('admin.components._datatable_card', [
        'title'       => __('app.class_room.plural'),
        'createRoute' => 'admin.class-rooms.create',
        'dataUrl'     => route('admin.class-rooms.data'),
        'tableId'     => 'cls-table',
        'columns'     => [
            ['data' => 'id',                 'title' => __('app.common.id')],
            ['data' => 'class_code',         'title' => __('app.common.code')],
            ['data' => 'name',               'title' => __('app.common.name')],
            ['data' => 'campus_name',        'title' => __('app.fields.campus'), 'orderable' => false],
            ['data' => 'program_name',       'title' => __('app.menu.program'), 'orderable' => false],
            ['data' => 'subject_name',       'title' => __('app.menu.subject'), 'orderable' => false],
            ['data' => 'teacher_name',       'title' => __('app.menu.teacher'), 'orderable' => false],
            ['data' => 'academic_year_name', 'title' => __('app.menu.academic_year'), 'orderable' => false],
            ['data' => 'status',             'title' => __('app.common.status')],
            ['data' => 'actions',            'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
