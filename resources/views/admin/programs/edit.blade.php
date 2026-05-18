@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.actions.edit') . ' — ' . $program->name)
@section('breadcrumbTitle', __('app.program.plural'))
@section('content')
<div class="card radius-10"><div class="card-body">
    <form action="{{ route('admin.programs.update', $program) }}" method="POST">@csrf @method('PUT')
        @include('admin.programs._form')
    </form>
</div></div>
@endsection
