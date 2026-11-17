@extends('mazer.layouts.app-mazer')

@section('title', 'Products - Mazer Admin Dashboard')

@section('vendor-css')
  <link rel="stylesheet" href="{{ asset('mazzer-assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('mazzer-assets/compiled/css/table-datatable-jquery.css') }}">
@endsection

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>Products</h3>
                  <p class="text-subtitle text-muted">Kelola data produk dengan DataTable, Import/Export Excel, dan Duplikasi.</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Products</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>

      @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @error('file')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @enderror

      <section class="section">
          <div class="card">
              <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                  <h4 class="card-title mb-0">Daftar Produk</h4>
                  <div class="d-flex flex-wrap gap-2">
                      <a href="{{ route('products.export') }}" class="btn btn-success">
                          <i class="bi bi-file-earmark-excel"></i> Export Excel
                      </a>
                      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importProductModal">
                          <i class="bi bi-upload"></i> Import Excel
                      </button>
                      <a href="{{ route('products.create') }}" class="btn btn-primary">
                          <i class="bi bi-plus-lg"></i> Tambah Produk
                      </a>
                  </div>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-hover align-middle" id="table1">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>SKU</th>
                                  <th>Nama Produk</th>
                                  <th>Kategori</th>
                                  <th>Harga</th>
                                  <th>Stok</th>
                                  <th>Status</th>
                                  <th class="text-end">Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($products as $product)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td><code>{{ $product->sku }}</code></td>
                                      <td class="fw-semibold">{{ $product->name }}</td>
                                      <td>{{ $product->category ?? '-' }}</td>
                                      <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                                      <td>{{ $product->stock }}</td>
                                      <td>
                                          <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                              {{ $product->is_active ? 'Active' : 'Inactive' }}
                                          </span>
                                      </td>
                                      <td class="text-end">
                                          <div class="d-inline-flex gap-1">
                                              <form method="POST" action="{{ route('products.duplicate', $product) }}">
                                                  @csrf
                                                  <button type="submit" class="btn btn-sm btn-secondary" title="Duplikasi Produk">
                                                      <i class="bi bi-files"></i> Duplikasi
                                                  </button>
                                              </form>
                                              <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                              <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Hapus produk ini?')">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                              </form>
                                          </div>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </section>
  </div>

  <!-- Import Excel Modal -->
  <div class="modal fade" id="importProductModal" tabindex="-1" aria-labelledby="importProductModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <form method="POST" action="{{ route('products.import') }}" enctype="multipart/form-data" class="modal-content">
              @csrf
              <div class="modal-header">
                  <h5 class="modal-title" id="importProductModalLabel">Import Produk dari Excel</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="file" class="form-label">File Excel (.xlsx, .xls, .csv) <span class="text-danger">*</span></label>
                      <input type="file" id="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                  </div>
                  <div class="alert alert-light-info mb-0 small">
                      <strong>Format kolom header:</strong> <code>sku</code>, <code>name</code>, <code>category</code>, <code>price</code>, <code>stock</code>, <code>description</code>, <code>is_active</code> (1/0).<br>
                      Jika <code>sku</code> sudah ada, data produk akan otomatis diperbarui.
                      <div class="mt-2">
                          <a href="{{ route('products.template') }}" class="btn btn-sm btn-outline-primary">
                              <i class="bi bi-download"></i> Download Template Excel
                          </a>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Import</button>
              </div>
          </form>
      </div>
  </div>
@endsection

@section('vendor-js')
  <script src="{{ asset('mazzer-assets/extensions/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('mazzer-assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('mazzer-assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('mazzer-assets/static/js/pages/datatables.js') }}"></script>
@endsection
