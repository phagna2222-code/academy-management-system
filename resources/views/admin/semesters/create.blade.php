@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.semester.singular'))
@section('breadcrumbTitle', __('app.semester.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.semesters.store') }}" method="POST">@csrf
        @include('admin.semesters._form')
    </form>
</div></div>
@endsection
