@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.permissions'))
@section('breadcrumbTitle', __('app.menu.permissions'))
@section('content')
    @livewire('admin.permission-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.permission.plural'),
        'module'      => 'permission',
        'dataUrl'     => route('admin.permissions.data'),
        'tableId'     => 'permissions-table',
        'columns'     => [
            ['data' => 'id',          'title' => __('app.common.id')],
            ['data' => 'module',      'title' => __('app.fields.module')],
            ['data' => 'name',        'title' => __('app.common.name')],
            ['data' => 'slug',        'title' => __('app.fields.slug')],
            ['data' => 'description', 'title' => __('app.common.description'), 'orderable' => false],
            ['data' => 'actions',     'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
