@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  {{ $active }}
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">{{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profil Saya</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-md-3 mb-4">
      <div class="list-group shadow">
        <a class="list-group-item list-group-item-action {{ request()->routeIs('profile.*') ? 'active' : '' }}"
          href="{{ route('profile.index') }}">
          <i class="fas fa-user fa-fw mr-2"></i>
          Profil Saya
        </a>
        <a class="list-group-item list-group-item-action {{ request()->routeIs('change-password.*') ? 'active' : '' }}"
          href="{{ route('change-password.index') }}">
          <i class="fas fa-lock fa-fw mr-2"></i>
          Ubah Sandi
        </a>
      </div>
    </div>

    <!-- Content Column -->
    <div class="col-md-9 mb-4">

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">{{ $active }}</h6>
        </div>
        <div class="card-body">
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Sukses!</strong> {{ Session::get('success') }}
              <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if (Session::has('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Gagal!</strong> {{ Session::get('danger') }}
              <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <form id="password-form" action="{{ route($route . '.update') }}" enctype="multipart/form-data" method="post"
            accept-charset="utf-8">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Sandi Lama</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control" name="old_pass" type="password" maxlength="255" required="">
                      @error('old_pass')
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
                    <div class="col-lg-3 col-md-4 col-12 pt-2">
                      <label class="form-control-label" for="normal-input">Sandi Baru</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control" name="new_pass" type="password" minlength="8" maxlength="255"
                        required="">
                      <small class="form-text">Minimal terdiri dari 8 karakter.</small>
                      @error('new_pass')
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
                    <div class="col-lg-3 col-md-4 col-12 pt-2">
                      <label class="form-control-label" for="normal-input">Konfirmasi Sandi</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control" name="new_pass_confirmation" type="password" maxlength="255"
                        required="">
                      @error('new_pass_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-lg-10 col-md-12">
                <div class="text-right">
                  <input class="btn btn-success" type="submit" value="Simpan">
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

  <!-- Page level custom scripts -->
  @include('template.footjs.global.tooltip')
@endsection
