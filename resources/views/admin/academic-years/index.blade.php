@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.academic_years'))
@section('breadcrumbTitle', __('app.menu.academic_years'))
@section('content')
    @livewire('admin.academic-year-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.academic_year.plural'),
        'module'      => 'academic_year',
        'dataUrl'     => route('admin.academic-years.data'),
        'tableId'     => 'academic-years-table',
        'columns'     => [
            ['data' => 'id',           'title' => __('app.common.id')],
            ['data' => 'academy_name', 'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'name',         'title' => __('app.common.name')],
            ['data' => 'start_date',   'title' => __('app.common.start_date')],
            ['data' => 'end_date',     'title' => __('app.common.end_date')],
            ['data' => 'is_current',   'title' => __('app.common.is_current')],
            ['data' => 'status',       'title' => __('app.common.status')],
            ['data' => 'actions',      'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
