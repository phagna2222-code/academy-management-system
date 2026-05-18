<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
        </div>

        <div class="top-navbar d-none d-xl-block">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('app.menu.dashboard') }}</a>
                </li>
                @auth
                    @if(auth()->user()->current_campus_name)
                        <li class="nav-item">
                            <span class="nav-link"><i class="bi bi-shop-window me-1"></i>{{ auth()->user()->current_campus_name }}</span>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>

        <form class="searchbar d-none d-xl-flex ms-auto" onsubmit="return false;">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
            <input class="form-control" type="text" placeholder="{{ __('app.search_placeholder') }}">
        </form>

        <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
                {{-- Language switcher (no page refresh via Livewire) --}}
                <li class="nav-item">
                    @livewire('language-switcher')
                </li>

                {{-- User dropdown --}}
                @auth
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-1">
                            <img src="{{ auth()->user()->avatar_url }}" class="user-img" alt="">
                            <div class="user-name d-none d-sm-block">{{ auth()->user()->name }}</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                <div class="d-flex align-items-center">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="" class="rounded-circle" width="60" height="60">
                                    <div class="ms-3">
                                        <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                        <small class="mb-0 dropdown-user-designation text-secondary">{{ __('app.user_type.' . auth()->user()->user_type) }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                                    <div class="setting-text ms-3"><span>{{ __('app.menu.profile') }}</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                                    <div class="setting-text ms-3"><span>{{ __('app.menu.dashboard') }}</span></div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                                        <div class="setting-text ms-3"><span>{{ __('app.logout') }}</span></div>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
