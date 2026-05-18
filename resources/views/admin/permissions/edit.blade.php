@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $permission->name)
@section('breadcrumbTitle', __('app.permission.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.permissions._form')
    </form>
</div></div>
@endsection
