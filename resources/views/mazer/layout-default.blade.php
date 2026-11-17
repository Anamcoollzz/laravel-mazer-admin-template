@extends('mazer.layouts.app-mazer')

@section('title', 'Layout Default - Mazer Admin Dashboard')

@section('vendor-css')
  <link rel="stylesheet" href="{{ asset('mazer-assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('mazer-assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
@endsection

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>Layout Default</h3>
                  <p class="text-subtitle text-muted">The default layout </p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Layout Default</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>
      <section class="section">
          <div class="card">
              <div class="card-header">
                  <h4 class="card-title">Default Layout</h4>
              </div>
              <div class="card-body">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, commodi? Ullam quaerat
                  similique iusto
                  temporibus, vero aliquam praesentium, odit deserunt eaque nihil saepe hic deleniti? Placeat
                  delectus
                  quibusdam ratione ullam!
              </div>
          </div>
      </section>
  </div>
@endsection

@section('vendor-js')
  <script src="{{ asset('mazer-assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('mazer-assets/js/bootstrap.bundle.min.js') }}"></script>
@endsection
