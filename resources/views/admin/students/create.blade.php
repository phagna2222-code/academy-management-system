@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.student.singular'))
@section('breadcrumbTitle', __('app.student.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.students.store') }}" method="POST">@csrf
        @include('admin.students._form')
    </form>
</div></div>
@endsection
