@extends('mazer.layouts.app-mazer')

@section('title', __('Users') . ' - ' . config('app.name', 'Mazer Admin Dashboard'))

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>{{ __('User Management') }}</h3>
                  <p class="text-subtitle text-muted">{{ __('Kelola data user dan role Spatie.') }}</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">{{ __('Dashboard') }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('Users') }}</li>
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

      @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
          </div>
      @endif

      <section class="section">
          <div class="card">
              <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                  <h4 class="card-title mb-0">{{ __('Daftar User') }}</h4>
                  <a href="{{ route('users.create') }}" class="btn btn-primary">
                      <i class="bi bi-plus-lg"></i> {{ __('Tambah User') }}
                  </a>
              </div>
              <div class="card-body">
                  <form method="GET" action="{{ route('users.index') }}" class="row g-2 mb-3">
                      <div class="col-md-5">
                          <input
                              type="text"
                              name="search"
                              value="{{ $search }}"
                              class="form-control"
                              placeholder="{{ __('Cari nama atau email...') }}"
                          >
                      </div>
                      <div class="col-md-3">
                          <select name="role" class="form-select">
                              <option value="">{{ __('Semua Role') }}</option>
                              @foreach ($roles as $role)
                                  <option value="{{ $role->name }}" @selected($selectedRole === $role->name)>{{ $role->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-4 d-flex gap-2">
                          <button type="submit" class="btn btn-outline-primary">{{ __('Filter') }}</button>
                          @if ($search !== '' || $selectedRole !== '')
                              <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">{{ __('Reset') }}</a>
                          @endif
                      </div>
                  </form>

                  <div class="table-responsive">
                      <table class="table table-hover align-middle mb-0">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>{{ __('Nama') }}</th>
                                  <th>{{ __('Email') }}</th>
                                  <th>{{ __('Roles') }}</th>
                                  <th>{{ __('Dibuat') }}</th>
                                  <th class="text-end">{{ __('Aksi') }}</th>
                              </tr>
                          </thead>
                          <tbody>
                              @forelse ($users as $user)
                                  <tr>
                                      <td>{{ $users->firstItem() + $loop->index }}</td>
                                      <td>
                                          <div class="d-flex align-items-center gap-2">
                                              <div class="avatar avatar-md">
                                                  <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}">
                                              </div>
                                              <span class="fw-semibold">{{ $user->name }}</span>
                                          </div>
                                      </td>
                                      <td>{{ $user->email }}</td>
                                      <td>
                                          @forelse ($user->roles as $role)
                                              <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                          @empty
                                              <span class="text-muted">-</span>
                                          @endforelse
                                      </td>
                                      <td>{{ $user->created_at?->format('d M Y') }}</td>
                                      <td class="text-end">
                                          <div class="d-inline-flex gap-1">
                                              <a
                                                  href="{{ route('users.edit', $user) }}"
                                                  class="btn btn-sm btn-warning"
                                                  data-bs-toggle="tooltip"
                                                  data-bs-placement="top"
                                                  title="{{ __('Edit User') }}"
                                                  aria-label="{{ __('Edit User') }}"
                                              >
                                                  <i class="bi bi-pencil-square"></i>
                                              </a>
                                              <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('{{ __('Hapus user ini?') }}')">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button
                                                      type="submit"
                                                      class="btn btn-sm btn-danger"
                                                      data-bs-toggle="tooltip"
                                                      data-bs-placement="top"
                                                      title="{{ __('Hapus User') }}"
                                                      aria-label="{{ __('Hapus User') }}"
                                                  >
                                                      <i class="bi bi-trash"></i>
                                                  </button>
                                              </form>
                                          </div>
                                      </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td colspan="6" class="text-center text-muted py-4">{{ __('Belum ada data user.') }}</td>
                                  </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>

                  <div class="mt-3">
                      {{ $users->links() }}
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection
