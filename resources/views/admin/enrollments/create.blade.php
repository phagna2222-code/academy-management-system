@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.enrollment.singular'))
@section('breadcrumbTitle', __('app.enrollment.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.enrollments.store') }}" method="POST">@csrf
        @include('admin.enrollments._form')
    </form>
</div></div>
@endsection
