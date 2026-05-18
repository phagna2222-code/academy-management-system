@extends('admin.layouts.admin_layout')
@section('pageTitle', __('app.menu.profile'))
@section('breadcrumbTitle', __('app.menu.profile'))
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card radius-10"><div class="card-body">
            <h5 class="mb-3">{{ __('app.profile.update_info') }}</h5>
            @include('admin.components._form_errors')
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">{{ __('app.common.name') }}</label>
                    <input name="name" type="text" required class="form-control" value="{{ old('name', $user->name) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('app.common.email') }}</label>
                    <input name="email" type="email" required class="form-control" value="{{ old('email', $user->email) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('app.common.phone') }}</label>
                    <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>
                <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
            </form>
        </div></div>
    </div>
    <div class="col-lg-6">
        <div class="card radius-10"><div class="card-body">
            <h5 class="mb-3">{{ __('app.profile.change_password') }}</h5>
            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label">{{ __('app.fields.current_password') }}</label>
                    <input name="current_password" type="password" required class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('app.fields.new_password') }}</label>
                    <input name="password" type="password" required class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('app.fields.password_confirm') }}</label>
                    <input name="password_confirmation" type="password" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">{{ __('app.actions.save') }}</button>
            </form>
        </div></div>
    </div>
</div>
@endsection
