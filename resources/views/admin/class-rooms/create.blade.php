@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.create') . ' — ' . __('app.class_room.singular'))
@section('breadcrumbTitle', __('app.class_room.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.class-rooms.store') }}" method="POST">@csrf
        @include('admin.class-rooms._form')
    </form>
</div></div>
@endsection
