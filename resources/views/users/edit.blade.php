@extends('mazer.layouts.app-mazer')

@section('title', __('Edit User') . ' - ' . config('app.name', 'Mazer Admin Dashboard'))

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>{{ __('Edit User') }}</h3>
                  <p class="text-subtitle text-muted">{{ __('Perbarui data user dan role yang dimiliki.') }}</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">{{ __('Dashboard') }}</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>

      <section class="section">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">{{ __('Form Edit User') }}</h4>
              </div>
              <div class="card-body">
                  <form method="POST" action="{{ route('users.update', $user) }}">
                      @csrf
                      @method('PUT')
                      @include('users._form')

                      <div class="d-flex justify-content-end gap-2 mt-4">
                          <a href="{{ route('users.index') }}" class="btn btn-light-secondary">{{ __('Batal') }}</a>
                          <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                      </div>
                  </form>
              </div>
          </div>
      </section>
  </div>
@endsection
