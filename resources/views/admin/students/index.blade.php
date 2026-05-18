@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.students'))
@section('breadcrumbTitle', __('app.menu.students'))
@section('content')
    @livewire('admin.student-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.student.plural'),
        'module'      => 'student',
        'dataUrl'     => route('admin.students.data'),
        'tableId'     => 'students-table',
        'columns'     => [
            ['data' => 'id',             'title' => __('app.common.id')],
            ['data' => 'student_code',   'title' => __('app.fields.student_code')],
            ['data' => 'name',           'title' => __('app.common.name')],
            ['data' => 'academy_name',   'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'campus_name',    'title' => __('app.fields.campus'), 'orderable' => false],
            ['data' => 'gender',         'title' => __('app.fields.gender')],
            ['data' => 'admission_date', 'title' => __('app.fields.admission_date')],
            ['data' => 'status',         'title' => __('app.common.status')],
            ['data' => 'actions',        'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
