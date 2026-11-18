@extends('mazer.layouts.app-mazer')

@section('title', __('Roles') . ' - ' . config('app.name', 'Mazer Admin Dashboard'))

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>{{ __('Role Management') }}</h3>
                  <p class="text-subtitle text-muted">{{ __('Kelola role dan permission menggunakan Spatie Permission.') }}</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">{{ __('Dashboard') }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('Roles') }}</li>
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
                  <h4 class="card-title mb-0">{{ __('Daftar Role') }}</h4>
                  <div class="d-flex flex-wrap gap-2">
                      <a href="{{ route('roles.export', request()->only(['search'])) }}" class="btn btn-success">
                          <i class="bi bi-file-earmark-excel"></i> {{ __('Export Excel') }}
                      </a>
                      <a href="{{ route('roles.create') }}" class="btn btn-primary">
                          <i class="bi bi-plus-lg"></i> {{ __('Tambah Role') }}
                      </a>
                  </div>
              </div>
              <div class="card-body">
                  <form method="GET" action="{{ route('roles.index') }}" class="row g-2 mb-3">
                      <div class="col-md-6">
                          <input
                              type="text"
                              name="search"
                              value="{{ $search }}"
                              class="form-control"
                              placeholder="{{ __('Cari nama role...') }}"
                          >
                      </div>
                      <div class="col-md-6 d-flex gap-2">
                          <button type="submit" class="btn btn-outline-primary">{{ __('Cari') }}</button>
                          @if ($search !== '')
                              <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">{{ __('Reset') }}</a>
                          @endif
                      </div>
                  </form>

                  <div class="table-responsive">
                      <table class="table table-hover align-middle mb-0">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>{{ __('Nama Role') }}</th>
                                  <th>{{ __('Guard') }}</th>
                                  <th>{{ __('Users') }}</th>
                                  <th>{{ __('Permissions') }}</th>
                                  <th class="text-end">{{ __('Aksi') }}</th>
                              </tr>
                          </thead>
                          <tbody>
                              @forelse ($roles as $role)
                                  <tr>
                                      <td>{{ $roles->firstItem() + $loop->index }}</td>
                                      <td class="fw-semibold">{{ $role->name }}</td>
                                      <td><code>{{ $role->guard_name }}</code></td>
                                      <td>
                                          <span class="badge bg-light-primary text-primary">{{ $role->users_count }} {{ __('user') }}</span>
                                      </td>
                                      <td>
                                          @forelse ($role->permissions as $permission)
                                              <span class="badge bg-secondary me-1 mb-1">{{ $permission->name }}</span>
                                          @empty
                                              <span class="text-muted">-</span>
                                          @endforelse
                                      </td>
                                      <td class="text-end">
                                          <div class="d-inline-flex gap-1">
                                              <form method="POST" action="{{ route('roles.duplicate', $role) }}">
                                                  @csrf
                                                  <button
                                                      type="submit"
                                                      class="btn btn-sm btn-secondary"
                                                      data-bs-toggle="tooltip"
                                                      data-bs-placement="top"
                                                      title="{{ __('Duplikasi Role') }}"
                                                      aria-label="{{ __('Duplikasi Role') }}"
                                                  >
                                                      <i class="bi bi-files"></i>
                                                  </button>
                                              </form>
                                              <a
                                                  href="{{ route('roles.edit', $role) }}"
                                                  class="btn btn-sm btn-warning"
                                                  data-bs-toggle="tooltip"
                                                  data-bs-placement="top"
                                                  title="{{ __('Edit Role') }}"
                                                  aria-label="{{ __('Edit Role') }}"
                                              >
                                                  <i class="bi bi-pencil-square"></i>
                                              </a>
                                              @if ($role->name !== 'super-admin')
                                                  <form method="POST" action="{{ route('roles.destroy', $role) }}" onsubmit="return confirm('{{ __('Hapus role ini?') }}')">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button
                                                          type="submit"
                                                          class="btn btn-sm btn-danger"
                                                          data-bs-toggle="tooltip"
                                                          data-bs-placement="top"
                                                          title="{{ __('Hapus Role') }}"
                                                          aria-label="{{ __('Hapus Role') }}"
                                                      >
                                                          <i class="bi bi-trash"></i>
                                                      </button>
                                                  </form>
                                              @endif
                                          </div>
                                      </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td colspan="6" class="text-center text-muted py-4">{{ __('Belum ada data role.') }}</td>
                                  </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>

                  <div class="mt-3">
                      {{ $roles->links() }}
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection
