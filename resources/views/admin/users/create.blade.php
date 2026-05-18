@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.user.singular'))
@section('breadcrumbTitle', __('app.user.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        @include('admin.users._form')
    </form>
</div></div>
@endsection
