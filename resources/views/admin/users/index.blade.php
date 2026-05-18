@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.users'))
@section('breadcrumbTitle', __('app.menu.users'))
@section('content')
    @include('admin.components._datatable_card', [
        'title'       => __('app.user.plural'),
        'createRoute' => 'admin.users.create',
        'dataUrl'     => route('admin.users.data'),
        'tableId'     => 'users-table',
        'columns'     => [
            ['data' => 'id',            'title' => __('app.common.id')],
            ['data' => 'name',          'title' => __('app.common.name')],
            ['data' => 'email',         'title' => __('app.common.email')],
            ['data' => 'phone',         'title' => __('app.common.phone'), 'orderable' => false],
            ['data' => 'user_type',     'title' => __('app.fields.user_type')],
            ['data' => 'academy_name',  'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'campus_name',   'title' => __('app.fields.campus'), 'orderable' => false],
            ['data' => 'role_list',     'title' => __('app.menu.roles'), 'orderable' => false, 'searchable' => false],
            ['data' => 'status',        'title' => __('app.common.status')],
            ['data' => 'actions',       'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
