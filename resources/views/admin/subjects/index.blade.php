@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.subjects'))
@section('breadcrumbTitle', __('app.menu.subjects'))
@section('content')
    @include('admin.components._datatable_card', [
        'title'       => __('app.subject.plural'),
        'createRoute' => 'admin.subjects.create',
        'dataUrl'     => route('admin.subjects.data'),
        'tableId'     => 'subj-table',
        'columns'     => [
            ['data' => 'id',           'title' => __('app.common.id')],
            ['data' => 'academy_name', 'title' => __('app.fields.academy'), 'orderable' => false],
            ['data' => 'program_name', 'title' => __('app.menu.program'), 'orderable' => false],
            ['data' => 'code',         'title' => __('app.common.code')],
            ['data' => 'name',         'title' => __('app.common.name')],
            ['data' => 'credit',       'title' => __('app.fields.credit')],
            ['data' => 'status',       'title' => __('app.common.status')],
            ['data' => 'actions',      'title' => __('app.common.actions'), 'orderable' => false, 'searchable' => false],
        ],
    ])
@endsection
