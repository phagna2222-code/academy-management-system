@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $student->name)
@section('breadcrumbTitle', __('app.student.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.students.update', $student) }}" method="POST">@csrf @method('PUT')
        @include('admin.students._form')
    </form>
</div></div>
@endsection
