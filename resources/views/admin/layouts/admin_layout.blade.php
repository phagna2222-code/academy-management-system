@include('admin.layouts.admin_partials.head')

<body>
<div class="wrapper">
    {{-- top header --}}
    @include('admin.layouts.admin_partials.header')

    {{-- sidebar --}}
    @include('admin.layouts.admin_partials.left_sidebar')

    {{-- content --}}
    <main class="page-content">
        {{-- breadcrumb --}}
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">@yield('breadcrumbTitle', __('app.brand'))</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door"></i></a>
                        </li>
                        @hasSection('breadcrumb')
                            @yield('breadcrumb')
                        @else
                            <li class="breadcrumb-item active" aria-current="page">@yield('pageTitle', __('app.brand'))</li>
                        @endif
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                @yield('pageActions')
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- overlay --}}
    <div class="overlay nav-toggle-icon"></div>

    {{-- Back To Top --}}
    <a href="#" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

@include('admin.layouts.admin_partials.scripts')
</body>
</html>
