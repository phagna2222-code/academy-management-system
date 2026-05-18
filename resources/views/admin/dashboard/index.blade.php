@extends('admin.layouts.admin_layout')

@section('pageTitle', __('app.menu.dashboard'))
@section('breadcrumbTitle', __('app.menu.dashboard'))

@section('content')
<div class="row">
    @php
        $cards = [
            ['k' => 'academies', 'label' => __('app.menu.academies'), 'icon' => 'bi-building',     'bg' => 'bg-primary'],
            ['k' => 'campuses',  'label' => __('app.menu.campuses'),  'icon' => 'bi-shop-window',  'bg' => 'bg-success'],
            ['k' => 'teachers',  'label' => __('app.menu.teachers'),  'icon' => 'bi-person-badge', 'bg' => 'bg-info'],
            ['k' => 'students',  'label' => __('app.menu.students'),  'icon' => 'bi-mortarboard', 'bg' => 'bg-warning'],
            ['k' => 'users',     'label' => __('app.menu.users'),     'icon' => 'bi-people',       'bg' => 'bg-secondary'],
        ];
    @endphp

    @foreach($cards as $c)
        <div class="col-12 col-sm-6 col-xl">
            <div class="card radius-10 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">{{ $c['label'] }}</p>
                            <h4 class="my-1">{{ $stats[$c['k']] ?? 0 }}</h4>
                        </div>
                        <div class="ms-auto fs-3 text-white rounded-circle d-flex align-items-center justify-content-center {{ $c['bg'] }}"
                             style="width:48px;height:48px;">
                            <i class="bi {{ $c['icon'] }}"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="card radius-10">
    <div class="card-body">
        <h5 class="mb-1">{{ __('app.app_name') }}</h5>
        <p class="text-muted mb-0">
            Multi-branch academy management — manage academies, campuses, programs, subjects, teachers, students,
            classes and enrollments. Use the sidebar to navigate.
        </p>
    </div>
</div>
@endsection
