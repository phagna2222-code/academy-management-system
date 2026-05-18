@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.teacher.singular'))
@section('breadcrumbTitle', __('app.teacher.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.teachers.store') }}" method="POST">@csrf
        @include('admin.teachers._form')
    </form>
</div></div>
@endsection
