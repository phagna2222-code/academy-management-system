@include('admin.layouts.admin_partials.head')
<body class="bg-login">
<style>
    body.bg-login {
        background: linear-gradient(135deg, #2c5cb9, #4d7cdc);
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
    }
    .login-card { width: 100%; max-width: 420px; border: 0; border-radius: 12px; box-shadow: 0 12px 30px rgba(0,0,0,.2); }
    .lang-switch { position: absolute; top: 1rem; right: 1rem; }
</style>

<div class="lang-switch">
    @livewire('language-switcher')
</div>

<div class="login-card card">
    <div class="card-body p-4 p-md-5">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/backend/assets/images/logo-icon.png') }}" alt="" height="48">
            <h4 class="mt-2 mb-0">{{ __('app.app_name') }}</h4>
            <small class="text-muted">{{ __('app.login') }}</small>
        </div>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label">{{ __('app.common.email') }}</label>
                <input name="email" type="email" required value="{{ old('email', 'admin@example.com') }}" autocomplete="username"
                       class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('app.fields.password') }}</label>
                <input name="password" type="password" required autocomplete="current-password"
                       class="form-control @error('password') is-invalid @enderror">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">{{ __('app.remember_me') }}</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">{{ __('app.login') }}</button>
        </form>

        <div class="mt-3 small text-muted text-center">
            <strong>Demo:</strong> admin@example.com / password
        </div>
    </div>
</div>

@include('admin.layouts.admin_partials.scripts')
</body>
</html>
