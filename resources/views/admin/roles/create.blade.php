@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.role.singular'))
@section('breadcrumbTitle', __('app.role.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        @include('admin.roles._form')
    </form>
</div></div>
@endsection
