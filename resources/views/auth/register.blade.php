<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register') }} - {{ config('app.name', 'Mazer Admin Dashboard') }}</title>

    <link rel="shortcut icon" href="{{ asset('mazzer-assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('mazzer-assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazzer-assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazzer-assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="{{ asset('mazzer-assets/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="auth-logo">
                            <a href="{{ route('mazer.index.html') }}"><img src="{{ asset('mazzer-assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
                        </div>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Language switcher">
                            <a href="{{ route('locale.switch', 'id') }}" class="btn {{ app()->getLocale() === 'id' ? 'btn-primary' : 'btn-outline-primary' }}">ID</a>
                            <a href="{{ route('locale.switch', 'en') }}" class="btn {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-outline-primary' }}">EN</a>
                        </div>
                    </div>
                    <h1 class="auth-title">{{ __('Sign Up') }}</h1>
                    <p class="auth-subtitle mb-5">{{ __('Input your data to register to our website.') }}</p>

                    <form method="POST" action="{{ route('app.auth.register.store') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="{{ __('Email') }}"
                                required
                                autofocus
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control form-control-xl @error('name') is-invalid @enderror"
                                placeholder="{{ __('Name') }}"
                                required
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="password"
                                name="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="{{ __('Password') }}"
                                required
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control form-control-xl"
                                placeholder="{{ __('Confirm Password') }}"
                                required
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Sign Up') }}</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('app.auth.login') }}" class="font-bold">{{ __('Log in') }}</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>
