@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $teacher->name)
@section('breadcrumbTitle', __('app.teacher.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">@csrf @method('PUT')
        @include('admin.teachers._form')
    </form>
</div></div>
@endsection
