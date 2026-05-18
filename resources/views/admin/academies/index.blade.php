@extends('admin.layouts.admin_layout')

@section('pageTitle', __('app.menu.academies'))
@section('breadcrumbTitle', __('app.menu.academies'))

@section('content')
    @livewire('admin.academy-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.academy.plural'),
        'module'      => 'academy',
        'dataUrl'     => route('admin.academies.data'),
        'tableId'     => 'academies-table',
        'order'       => [[0, 'desc']],
        'columns'     => [
            ['data' => 'id',         'title' => __('app.common.id')],
            ['data' => 'code',       'title' => __('app.common.code')],
            ['data' => 'name',       'title' => __('app.common.name')],
            ['data' => 'owner_name', 'title' => __('app.common.owner')],
            ['data' => 'phone',      'title' => __('app.common.phone'), 'orderable' => false],
            ['data' => 'email',      'title' => __('app.common.email')],
            ['data' => 'status',     'title' => __('app.common.status')],
            ['data' => 'created_at', 'title' => __('app.common.created_at')],
            ['data' => 'actions',    'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
