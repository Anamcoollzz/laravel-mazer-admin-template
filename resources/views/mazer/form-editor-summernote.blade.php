@extends('mazer.layouts.app-mazer')

@section('title', 'Summernote - Mazer Admin Dashboard')

@section('vendor-css')
  <link rel="stylesheet" href="{{ asset('mazer-assets/vendors/summernote/summernote-lite.min.css') }}">
  <link rel="stylesheet" href="{{ asset('mazer-assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('mazer-assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
@endsection

@section('page-heading')
  <div class="page-heading">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-md-6 order-md-1 order-last">
                  <h3>Summernote </h3>
                  <p class="text-subtitle text-muted">Super simple WYSIWYG editor. But you must include jQuery
                  </p>
              </div>
              <div class="col-12 col-md-6 order-md-2 order-first">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Summernote</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>
      <section class="section">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Default Editor</h4>
                      </div>
                      <div class="card-body">
                          <div id="summernote"></div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section class="section">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Word Hints</h4>
                      </div>
                      <div class="card-body">
                          <div id="hint"></div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
@endsection

@section('vendor-js')
  <script src="{{ asset('mazer-assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('mazer-assets/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('mazer-assets/vendors/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('mazer-assets/vendors/summernote/summernote-lite.min.js') }}"></script>
  <script>
      $('#summernote').summernote({
          tabsize: 2,
          height: 120,
      })
      $("#hint").summernote({
          height: 100,
          toolbar: false,
          placeholder: 'type with apple, orange, watermelon and lemon',
          hint: {
              words: ['apple', 'orange', 'watermelon', 'lemon'],
              match: /\b(\w{1,})$/,
              search: function (keyword, callback) {
                  callback($.grep(this.words, function (item) {
                      return item.indexOf(keyword) === 0;
                  }));
              }
          }
      });

  </script>
@endsection
