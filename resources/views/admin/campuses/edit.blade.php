@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $campus->name)
@section('breadcrumbTitle', __('app.campus.plural'))
@section('content')
<div class="card radius-10">
    <div class="card-body">
        <form action="{{ route('admin.campuses.update', $campus) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.campuses._form')
        </form>
    </div>
</div>
@endsection
