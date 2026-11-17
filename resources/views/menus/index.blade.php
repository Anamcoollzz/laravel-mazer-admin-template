@extends('mazer.layouts.app-mazer')

@section('title', __('Menus') . ' - ' . config('app.name', 'Mazer Admin Dashboard'))

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>{{ __('Menus') }}</h3>
                  <p class="text-subtitle text-muted">{{ __('Kelola item menu sidebar sesuai struktur Mazer.') }}</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">{{ __('Dashboard') }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ __('Menus') }}</li>
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
          <div class="card">
              <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                  <h4 class="card-title mb-0">{{ __('Daftar Menu') }}</h4>
                  <a href="{{ route('menus.create') }}" class="btn btn-primary">
                      <i class="bi bi-plus-lg"></i> {{ __('Tambah Menu') }}
                  </a>
              </div>
              <div class="card-body">
                  <form method="GET" action="{{ route('menus.index') }}" class="row g-2 mb-3">
                      <div class="col-md-5">
                          <input
                              type="text"
                              name="search"
                              value="{{ $search }}"
                              class="form-control"
                              placeholder="{{ __('Cari title, route_name, atau url...') }}"
                          >
                      </div>
                      <div class="col-md-3">
                          <select name="type" class="form-select">
                              <option value="">{{ __('Semua Tipe') }}</option>
                              <option value="title" @selected($type === 'title')>{{ __('Title (Section)') }}</option>
                              <option value="item" @selected($type === 'item')>{{ __('Item') }}</option>
                          </select>
                      </div>
                      <div class="col-md-4 d-flex gap-2">
                          <button type="submit" class="btn btn-outline-primary">{{ __('Filter') }}</button>
                          @if ($search !== '' || $type !== '')
                              <a href="{{ route('menus.index') }}" class="btn btn-outline-secondary">{{ __('Reset') }}</a>
                          @endif
                      </div>
                  </form>

                  <div class="table-responsive">
                      <table class="table table-hover align-middle mb-0">
                          <thead>
                              <tr>
                                  <th>{{ __('Order') }}</th>
                                  <th>{{ __('Title') }}</th>
                                  <th>{{ __('Title (EN)') }}</th>
                                  <th>{{ __('Type') }}</th>
                                  <th>{{ __('Parent') }}</th>
                                  <th>{{ __('Icon') }}</th>
                                  <th>{{ __('Route / URL') }}</th>
                                  <th>{{ __('Permission') }}</th>
                                  <th>{{ __('Status') }}</th>
                                  <th class="text-end">{{ __('Aksi') }}</th>
                              </tr>
                          </thead>
                          <tbody>
                              @forelse ($menus as $menu)
                                  <tr>
                                      <td>{{ $menu->order }}</td>
                                      <td class="fw-semibold">
                                          {{ $menu->title }}
                                          @if ($menu->children_count > 0)
                                              <span class="badge bg-light-secondary text-secondary ms-1">{{ $menu->children_count }} {{ __('sub') }}</span>
                                          @endif
                                      </td>
                                      <td>{{ $menu->title_en ?? '-' }}</td>
                                      <td>
                                          <span class="badge {{ $menu->isTitle() ? 'bg-info' : 'bg-primary' }}">
                                              {{ $menu->type }}
                                          </span>
                                      </td>
                                      <td>{{ $menu->parent?->title ?? '-' }}</td>
                                      <td>
                                          @if ($menu->icon)
                                              <i class="{{ $menu->icon }} me-1"></i>
                                              <small class="text-muted">{{ $menu->icon }}</small>
                                          @else
                                              -
                                          @endif
                                      </td>
                                      <td>
                                          @if ($menu->route_name)
                                              <code>{{ $menu->route_name }}</code>
                                          @elseif ($menu->url)
                                              <small class="text-muted">{{ $menu->url }}</small>
                                          @else
                                              -
                                          @endif
                                      </td>
                                      <td>
                                          @if ($menu->permission_name)
                                              <span class="badge bg-light-warning text-warning">{{ $menu->permission_name }}</span>
                                          @else
                                              -
                                          @endif
                                      </td>
                                      <td>
                                          <span class="badge {{ $menu->is_active ? 'bg-success' : 'bg-secondary' }}">
                                              {{ $menu->is_active ? __('Active') : __('Inactive') }}
                                          </span>
                                      </td>
                                      <td class="text-end">
                                          <div class="d-inline-flex gap-1">
                                              <a
                                                  href="{{ route('menus.edit', $menu) }}"
                                                  class="btn btn-sm btn-warning"
                                                  data-bs-toggle="tooltip"
                                                  data-bs-placement="top"
                                                  title="{{ __('Edit Menu') }}"
                                                  aria-label="{{ __('Edit Menu') }}"
                                              >
                                                  <i class="bi bi-pencil-square"></i>
                                              </a>
                                              <form method="POST" action="{{ route('menus.destroy', $menu) }}" onsubmit="return confirm('{{ __('Hapus menu ini?') }}')">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button
                                                      type="submit"
                                                      class="btn btn-sm btn-danger"
                                                      data-bs-toggle="tooltip"
                                                      data-bs-placement="top"
                                                      title="{{ __('Hapus Menu') }}"
                                                      aria-label="{{ __('Hapus Menu') }}"
                                                  >
                                                      <i class="bi bi-trash"></i>
                                                  </button>
                                              </form>
                                          </div>
                                      </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td colspan="10" class="text-center text-muted py-4">{{ __('Belum ada data menu.') }}</td>
                                  </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>

                  <div class="mt-3">
                      {{ $menus->links() }}
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection
