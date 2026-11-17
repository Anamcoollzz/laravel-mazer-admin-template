@php
    $assignedRoles = old('roles', $user->exists ? $user->roles->pluck('name')->all() : []);
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">{{ __('Nama') }} <span class="text-danger">*</span></label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $user->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="{{ __('Nama lengkap') }}"
            required
        >
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="{{ __('user@example.com') }}"
            required
        >
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label">
            {{ __('Password') }} @if (! $user->exists) <span class="text-danger">*</span> @else <small class="text-muted">({{ __('kosongkan jika tidak diubah') }})</small> @endif
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            @required(! $user->exists)
        >
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="password_confirmation" class="form-label">
            {{ __('Konfirmasi Password') }} @if (! $user->exists) <span class="text-danger">*</span> @endif
        </label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="form-control"
            @required(! $user->exists)
        >
    </div>

    <div class="col-md-6">
        <label for="avatar" class="form-label">{{ __('Avatar') }}</label>
        <div class="d-flex align-items-center gap-3">
            @if ($user->exists)
                <div class="avatar avatar-md">
                    <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                </div>
            @endif
            <input
                type="file"
                id="avatar"
                name="avatar"
                accept="image/jpeg,image/png,image/webp"
                class="form-control @error('avatar') is-invalid @enderror"
            >
        </div>
        @error('avatar')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label d-block">{{ __('Roles') }}</label>
        <div class="row g-2">
            @forelse ($roles as $role)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-check">
                        <input
                            class="form-check-input @error('roles') is-invalid @enderror"
                            type="checkbox"
                            name="roles[]"
                            value="{{ $role->name }}"
                            id="role_{{ $role->id }}"
                            @checked(in_array($role->name, $assignedRoles, true))
                        >
                        <label class="form-check-label" for="role_{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted">{{ __('Belum ada role tersedia.') }}</div>
            @endforelse
        </div>
        @error('roles')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
        @error('roles.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
