@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.academic_year.singular'))
@section('breadcrumbTitle', __('app.academic_year.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.academic-years.store') }}" method="POST">
        @csrf
        @include('admin.academic-years._form')
    </form>
</div></div>
@endsection
