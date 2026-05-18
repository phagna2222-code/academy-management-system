@extends('admin.layouts.admin_layout')

@section('pageTitle', __('app.menu.campuses'))
@section('breadcrumbTitle', __('app.menu.campuses'))

@section('content')
    @livewire('admin.campus-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.campus.plural'),
        'module'      => 'campus',
        'dataUrl'     => route('admin.campuses.data'),
        'tableId'     => 'campuses-table',
        'columns'     => [
            ['data' => 'id',           'title' => __('app.common.id')],
            ['data' => 'academy_name', 'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'code',         'title' => __('app.common.code')],
            ['data' => 'name',         'title' => __('app.common.name')],
            ['data' => 'manager_name', 'title' => __('app.common.manager'), 'orderable' => false],
            ['data' => 'phone',        'title' => __('app.common.phone'), 'orderable' => false],
            ['data' => 'is_main',      'title' => __('app.common.is_main')],
            ['data' => 'status',       'title' => __('app.common.status')],
            ['data' => 'actions',      'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
