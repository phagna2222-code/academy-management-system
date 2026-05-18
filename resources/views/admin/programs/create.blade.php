@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.program.singular'))
@section('breadcrumbTitle', __('app.program.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.programs.store') }}" method="POST">@csrf
        @include('admin.programs._form')
    </form>
</div></div>
@endsection
