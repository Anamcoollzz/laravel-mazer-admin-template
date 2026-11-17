@extends('mazer.layouts.app-mazer')

@section('title', 'Edit Menu - Mazer Admin Dashboard')

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>Edit Menu</h3>
                  <p class="text-subtitle text-muted">Perbarui konfigurasi item menu sidebar.</p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('mazer.index.html') }}">Dashboard</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Edit</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>

      <section class="section">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Form Edit Menu</h4>
              </div>
              <div class="card-body">
                  <form method="POST" action="{{ route('menus.update', $menu) }}">
                      @csrf
                      @method('PUT')
                      @include('menus._form')

                      <div class="d-flex justify-content-end gap-2 mt-4">
                          <a href="{{ route('menus.index') }}" class="btn btn-light-secondary">Batal</a>
                          <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                  </form>
              </div>
          </div>
      </section>
  </div>
@endsection
