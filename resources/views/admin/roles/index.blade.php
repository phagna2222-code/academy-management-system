@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.roles'))
@section('breadcrumbTitle', __('app.menu.roles'))
@section('content')
    @livewire('admin.role-modal')

    @include('admin.components._datatable_card', [
        'title'       => __('app.role.plural'),
        'module'      => 'role',
        'dataUrl'     => route('admin.roles.data'),
        'tableId'     => 'roles-table',
        'columns'     => [
            ['data' => 'id',                'title' => __('app.common.id')],
            ['data' => 'name',              'title' => __('app.common.name')],
            ['data' => 'slug',              'title' => __('app.fields.slug')],
            ['data' => 'academy_name',      'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'permissions_count', 'title' => __('app.menu.permissions'), 'searchable' => false],
            ['data' => 'status',            'title' => __('app.common.status')],
            ['data' => 'actions',           'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
