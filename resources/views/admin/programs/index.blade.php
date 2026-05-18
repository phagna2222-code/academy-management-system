@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.programs'))
@section('breadcrumbTitle', __('app.menu.programs'))
@section('content')
    @include('admin.components._datatable_card', [
        'title'       => __('app.program.plural'),
        'createRoute' => 'admin.programs.create',
        'dataUrl'     => route('admin.programs.data'),
        'tableId'     => 'pgm-table',
        'columns'     => [
            ['data' => 'id',             'title' => __('app.common.id')],
            ['data' => 'academy_name',   'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'campus_name',    'title' => __('app.fields.campus'), 'orderable' => false],
            ['data' => 'code',           'title' => __('app.common.code')],
            ['data' => 'name',           'title' => __('app.common.name')],
            ['data' => 'duration_years', 'title' => __('app.fields.duration_years')],
            ['data' => 'status',         'title' => __('app.common.status')],
            ['data' => 'actions',        'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
