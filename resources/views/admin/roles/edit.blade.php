@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $role->name)
@section('breadcrumbTitle', __('app.role.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.roles._form')
    </form>
</div></div>
@endsection
