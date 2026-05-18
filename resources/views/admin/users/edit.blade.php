@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $user->name)
@section('breadcrumbTitle', __('app.user.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.users._form')
    </form>
</div></div>
@endsection
