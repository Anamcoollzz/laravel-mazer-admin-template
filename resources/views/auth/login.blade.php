<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }} - {{ config('app.name', 'Mazer Admin Dashboard') }}</title>

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
                    <div class="auth-logo">
                        <a href="{{ route('mazer.index.html') }}"><img src="{{ asset('mazzer-assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">{{ __('Log in.') }}</h1>
                    <p class="auth-subtitle mb-5">{{ __('Log in with your data that you entered during registration.') }}</p>

                    <form method="POST" action="{{ route('app.auth.login.attempt') }}">
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

                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input
                                class="form-check-input me-2"
                                type="checkbox"
                                name="remember"
                                value="1"
                                id="remember"
                                @checked(old('remember'))
                            >
                            <label class="form-check-label text-gray-600" for="remember">
                                {{ __('Keep me logged in') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Log in') }}</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('app.auth.register') }}" class="font-bold">{{ __('Sign up') }}</a>.
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
