@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $classRoom->name)
@section('breadcrumbTitle', __('app.class_room.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.class-rooms.update', $classRoom) }}" method="POST">@csrf @method('PUT')
        @include('admin.class-rooms._form')
    </form>
</div></div>
@endsection
