@extends('mazer.layouts.app-mazer')

@section('title', __('Profile') . ' - ' . config('app.name', 'Mazer Admin Dashboard'))

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>{{ __('Profile') }}</h3>
                  <p class="text-subtitle text-muted">{{ __('Kelola informasi profil dan avatar akun Anda.') }}</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">{{ __('Dashboard') }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>

      @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
          </div>
      @endif

      <section class="section">
          <div class="row">
              <div class="col-12 col-lg-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex justify-content-center align-items-center flex-column text-center">
                              <div class="avatar avatar-2xl mb-3">
                                  <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                              </div>
                              <h4 class="mt-2 mb-1">{{ $user->name }}</h4>
                              <p class="text-muted mb-2">{{ $user->email }}</p>
                              <div>
                                  @forelse ($user->getRoleNames() as $roleName)
                                      <span class="badge bg-primary me-1">{{ $roleName }}</span>
                                  @empty
                                      <span class="badge bg-secondary">{{ __('User') }}</span>
                                  @endforelse
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-12 col-lg-8">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                      </div>
                      <div class="card-body">
                          <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')

                              <div class="row g-3">
                                  <div class="col-md-6">
                                      <label for="name" class="form-label">{{ __('Nama') }} <span class="text-danger">*</span></label>
                                      <input
                                          type="text"
                                          id="name"
                                          name="name"
                                          value="{{ old('name', $user->name) }}"
                                          class="form-control @error('name') is-invalid @enderror"
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
                                          required
                                      >
                                      @error('email')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>

                                  <div class="col-12">
                                      <label for="avatar" class="form-label">{{ __('Avatar') }}</label>
                                      <input
                                          type="file"
                                          id="avatar"
                                          name="avatar"
                                          accept="image/jpeg,image/png,image/webp"
                                          class="form-control @error('avatar') is-invalid @enderror"
                                      >
                                      @error('avatar')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>

                                  <div class="col-md-6">
                                      <label for="password" class="form-label">
                                          {{ __('Password') }} <small class="text-muted">({{ __('kosongkan jika tidak diubah') }})</small>
                                      </label>
                                      <input
                                          type="password"
                                          id="password"
                                          name="password"
                                          class="form-control @error('password') is-invalid @enderror"
                                      >
                                      @error('password')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </div>

                                  <div class="col-md-6">
                                      <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
                                      <input
                                          type="password"
                                          id="password_confirmation"
                                          name="password_confirmation"
                                          class="form-control"
                                      >
                                  </div>
                              </div>

                              <div class="d-flex justify-content-end mt-4">
                                  <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection
