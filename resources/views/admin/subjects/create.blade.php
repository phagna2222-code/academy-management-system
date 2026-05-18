@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.subject.singular'))
@section('breadcrumbTitle', __('app.subject.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.subjects.store') }}" method="POST">@csrf
        @include('admin.subjects._form')
    </form>
</div></div>
@endsection
