@extends('admin.layouts.admin_layout')

@section('pageTitle', __('app.actions.create') . ' — ' . __('app.academy.singular'))
@section('breadcrumbTitle', __('app.academy.plural'))

@section('content')
<div class="card radius-10">
    <div class="card-body">
        <form action="{{ route('admin.academies.store') }}" method="POST">
            @csrf
            @include('admin.academies._form')
        </form>
    </div>
</div>
@endsection
