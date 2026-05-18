<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/backend') }}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ __('app.brand') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i></div>
    </div>
    {{-- navigation --}}
    <ul class="metismenu" id="menu">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                <div class="menu-title">{{ __('app.menu.dashboard') }}</div>
            </a>
        </li>

        @can('academy.view')
        <li class="{{ request()->routeIs('admin.academies.*') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.academies.index') }}">
                <div class="parent-icon"><i class="bi bi-building"></i></div>
                <div class="menu-title">{{ __('app.menu.academies') }}</div>
            </a>
        </li>
        @endcan

        @can('campus.view')
        <li class="{{ request()->routeIs('admin.campuses.*') ? 'mm-active' : '' }}">
            <a href="{{ route('admin.campuses.index') }}">
                <div class="parent-icon"><i class="bi bi-shop-window"></i></div>
                <div class="menu-title">{{ __('app.menu.campuses') }}</div>
            </a>
        </li>
        @endcan

        <li class="{{ request()->routeIs('admin.academic-years.*') || request()->routeIs('admin.semesters.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-calendar3"></i></div>
                <div class="menu-title">{{ __('app.menu.academic_calendar') }}</div>
            </a>
            <ul>
                @can('academic_year.view')
                <li><a href="{{ route('admin.academic-years.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.academic_years') }}</a></li>
                @endcan
                @can('semester.view')
                <li><a href="{{ route('admin.semesters.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.semesters') }}</a></li>
                @endcan
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.programs.*') || request()->routeIs('admin.subjects.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-mortarboard"></i></div>
                <div class="menu-title">{{ __('app.menu.curriculum') }}</div>
            </a>
            <ul>
                @can('program.view')
                <li><a href="{{ route('admin.programs.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.programs') }}</a></li>
                @endcan
                @can('subject.view')
                <li><a href="{{ route('admin.subjects.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.subjects') }}</a></li>
                @endcan
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.teachers.*') || request()->routeIs('admin.students.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-people"></i></div>
                <div class="menu-title">{{ __('app.menu.people') }}</div>
            </a>
            <ul>
                @can('teacher.view')
                <li><a href="{{ route('admin.teachers.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.teachers') }}</a></li>
                @endcan
                @can('student.view')
                <li><a href="{{ route('admin.students.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.students') }}</a></li>
                @endcan
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.class-rooms.*') || request()->routeIs('admin.enrollments.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-easel"></i></div>
                <div class="menu-title">{{ __('app.menu.classes') }}</div>
            </a>
            <ul>
                @can('class_room.view')
                <li><a href="{{ route('admin.class-rooms.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.class_rooms') }}</a></li>
                @endcan
                @can('enrollment.view')
                <li><a href="{{ route('admin.enrollments.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.enrollments') }}</a></li>
                @endcan
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') ? 'mm-active' : '' }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-shield-lock"></i></div>
                <div class="menu-title">{{ __('app.menu.security') }}</div>
            </a>
            <ul>
                @can('user.view')
                <li><a href="{{ route('admin.users.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.users') }}</a></li>
                @endcan
                @can('role.view')
                <li><a href="{{ route('admin.roles.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.roles') }}</a></li>
                @endcan
                @can('permission.view')
                <li><a href="{{ route('admin.permissions.index') }}"><i class="bi bi-arrow-right-short"></i>{{ __('app.menu.permissions') }}</a></li>
                @endcan
            </ul>
        </li>
    </ul>
    {{-- end navigation --}}
</aside>
