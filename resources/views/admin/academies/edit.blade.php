@extends('admin.layouts.admin_layout')

@section('pageTitle', __('app.actions.edit') . ' — ' . $academy->name)
@section('breadcrumbTitle', __('app.academy.plural'))

@section('content')
<div class="card radius-10">
    <div class="card-body">
        <form action="{{ route('admin.academies.update', $academy) }}" method="POST">
            @csrf @method('PUT')
            @include('admin.academies._form')
        </form>
    </div>
</div>
@endsection
