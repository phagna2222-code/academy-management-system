@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.semesters'))
@section('breadcrumbTitle', __('app.menu.semesters'))
@section('content')
    @livewire('admin.semester-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.semester.plural'),
        'module'      => 'semester',
        'dataUrl'     => route('admin.semesters.data'),
        'tableId'     => 'semesters-table',
        'columns'     => [
            ['data' => 'id',                 'title' => __('app.common.id')],
            ['data' => 'academy_name',       'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'academic_year_name', 'title' => __('app.menu.academic_year'), 'orderable' => false],
            ['data' => 'name',               'title' => __('app.common.name')],
            ['data' => 'start_date',         'title' => __('app.common.start_date')],
            ['data' => 'end_date',           'title' => __('app.common.end_date')],
            ['data' => 'sort_order',         'title' => __('app.common.sort')],
            ['data' => 'status',             'title' => __('app.common.status')],
            ['data' => 'actions',            'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
