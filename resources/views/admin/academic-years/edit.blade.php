@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $academicYear->name)
@section('breadcrumbTitle', __('app.academic_year.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.academic-years.update', $academicYear) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.academic-years._form')
    </form>
</div></div>
@endsection
