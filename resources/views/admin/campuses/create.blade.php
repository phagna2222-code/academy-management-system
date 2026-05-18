@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.campus.singular'))
@section('breadcrumbTitle', __('app.campus.plural'))
@section('content')
<div class="card radius-10">
    <div class="card-body">
        <form action="{{ route('admin.campuses.store') }}" method="POST">
            @csrf
            @include('admin.campuses._form')
        </form>
    </div>
</div>
@endsection
