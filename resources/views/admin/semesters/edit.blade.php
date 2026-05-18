@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $semester->name)
@section('breadcrumbTitle', __('app.semester.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.semesters.update', $semester) }}" method="POST">@csrf @method('PUT')
        @include('admin.semesters._form')
    </form>
</div></div>
@endsection
