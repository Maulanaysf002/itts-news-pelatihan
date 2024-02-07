@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  Tambah {{ $active }}
@endsection

@section('headmeta')
  <!-- Bootstrap Tagsinput -->
  <link href="{{ asset('vendor/bootstrap4-tagsinput/bootstrap4-tagsinput.css') }}" rel="stylesheet">
  <!-- Bootstrap Toggle -->
  <link href="{{ asset('vendor/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/select2/dist/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin/select2-custom.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ Session::token() }}" />
  </style>
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Tambah {{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Berita & Aktivitas</a></li>
      <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">{{ $active }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-blue-dark">Tambah</h6>
        </div>
        <div class="card-body px-4 py-3">
          <form id="addItemForm" action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="selectAuthor">Penulis</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="select2 form-control form-control-sm @error('author') is-invalid @enderror"
                        id="selectAuthor" name="author" required="required">
                        @foreach ($authors as $a)
                          <option value="{{ $a->id }}" {{ old('author') == $a->id ? 'selected' : '' }}>
                            {{ $a->name }}</option>
                        @endforeach
                      </select>
                      @error('author')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Judul</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control form-control-sm @error('title') is-invalid @enderror" id="title"
                        name="title" type="text" value="{{ old('title') }}" placeholder="Tuliskan judul di sini"
                        maxlength="255">
                      @error('title')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Deskripsi</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <textarea class="form-control form-control-sm @error('text') is-invalid @enderror ckeditor" id="text"
                        name="text" rows="15" required="required">{!! old('text') !!}</textarea>
                      @error('text')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Gambar</label>
                    </div>
                    <div class="col-lg-7 col-md-8 col-12">
                      @php
                        $inputImageName = 'thumbnail';
                      @endphp
                      <img class="img-thumbnail article-thumbnail-preview" id="preview{{ ucwords($inputImageName) }}"
                        src="{{ asset('img/article/default.png') }}">
                      <input class="file image-input d-none" name="{{ $inputImageName }}" type="file"
                        accept="image/jpg,image/jpeg,image/png,image/webp">
                      <div class="input-group mt-3">
                        <input class="form-control form-control-sm @error($inputImageName) is-invalid @enderror"
                          id="file{{ ucwords($inputImageName) }}" type="text" disabled placeholder="Unggah gambar...">
                        <div class="input-group-append">
                          <button class="browse btn btn-sm btn-brand-blue" type="button">Pilih</button>
                        </div>
                      </div>
                      <small class="form-text text-muted">Rasio 3:2. Ekstensi .jpg, .jpeg, .png, .webp. Maks 256
                        KB.</small>
                      @error($inputImageName)
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @if ($categories && count($categories) > 0)
              <div class="row">
                <div class="col-lg-10 col-md-12">
                  <div class="form-group">
                    <div class="row mb-3">
                      <div class="col-lg-3 col-md-4 col-12">
                        <label class="form-control-label" for="select2Categories">Kategori</label>
                      </div>
                      <div class="col-lg-9 col-md-8 col-12">
                        <select class="select2-multiple form-control" id="select2Categories" name="categories[]"
                          multiple="multiple">
                          @foreach ($categories as $c)
                            <option value="{{ $c->id }}"
                              {{ old('categories') ? (in_array($c->id, old('categories')) ? 'selected' : '') : '' }}>
                              {{ $c->name }}</option>
                          @endforeach
                        </select>
                        @error('categories')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Kata Kunci</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input id="editKeywords" name="keywords" data-role="tagsinput" type="text"
                        value="{{ old('keywords') }}">
                      @error('keywords')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Sembunyikan dari Daftar?</label>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                      <input class="active-toggle" name="unlisted" data-toggle="toggle" data-on="Ya"
                        data-off="Tidak" data-onstyle="success" data-offstyle="danger" data-size="small"
                        type="checkbox" {{ old('unlisted') ? 'checked' : null }}>
                      @error('unlisted')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Publikasi Langsung?</label>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                      <input class="active-toggle" name="publish" data-toggle="toggle" data-on="Ya"
                        data-off="Tidak" data-onstyle="success" data-offstyle="danger" data-size="small"
                        type="checkbox" {{ old('publish') ? 'checked' : null }}>
                      @error('publish')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-1">
              <div class="col-lg-10 col-md-12">
                <div class="row">
                  <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-12 text-left">
                    <input class="btn btn-sm btn-brand-blue" type="submit" value="Tambah">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->

@endsection

@section('footjs')
  <!-- Plugins and scripts required by this view-->

  <!-- Page level plugins -->

  <!-- Bootstrap Tagsinput -->
  <script src="{{ asset('vendor/bootstrap4-tagsinput/bootstrap4-tagsinput.js') }}"></script>

  <!-- Bootstrap Toggle -->
  <script src="{{ asset('vendor/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>

  <!-- CKEditor -->
  <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

  <!-- Image Preview -->
  <script src="{{ asset('js/image-preview.js') }}"></script>

  <!-- Select2 -->
  <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

  <!-- Page level custom scripts -->
  @include('template.footjs.global.select2-default')
  @include('template.footjs.global.select2-multiple')
@endsection
