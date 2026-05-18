@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.permission.singular'))
@section('breadcrumbTitle', __('app.permission.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf
        @include('admin.permissions._form')
    </form>
</div></div>
@endsection
