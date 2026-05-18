@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $enrollment->enrollment_no)
@section('breadcrumbTitle', __('app.enrollment.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.enrollments.update', $enrollment) }}" method="POST">@csrf @method('PUT')
        @include('admin.enrollments._form')
    </form>
</div></div>
@endsection
