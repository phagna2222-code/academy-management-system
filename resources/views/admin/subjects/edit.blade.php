@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $subject->name)
@section('breadcrumbTitle', __('app.subject.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">@csrf @method('PUT')
        @include('admin.subjects._form')
    </form>
</div></div>
@endsection
