@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.teachers'))
@section('breadcrumbTitle', __('app.menu.teachers'))
@section('content')
    @livewire('admin.teacher-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.teacher.plural'),
        'module'      => 'teacher',
        'dataUrl'     => route('admin.teachers.data'),
        'tableId'     => 'teachers-table',
        'columns'     => [
            ['data' => 'id',            'title' => __('app.common.id')],
            ['data' => 'teacher_code',  'title' => __('app.fields.teacher_code')],
            ['data' => 'name',          'title' => __('app.common.name')],
            ['data' => 'academy_name',  'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'campus_name',   'title' => __('app.fields.campus'), 'orderable' => false],
            ['data' => 'gender',        'title' => __('app.fields.gender')],
            ['data' => 'joining_date',  'title' => __('app.fields.joining_date')],
            ['data' => 'status',        'title' => __('app.common.status')],
            ['data' => 'actions',       'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
