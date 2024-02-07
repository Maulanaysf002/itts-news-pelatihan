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
      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
  </div>

  <!-- client row -->
  <div class="row flex justify-content-center">
    <!-- Jumlah Pelatihan -->
    <div class="col-xl-3 col-md-6 col-12 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Jumlah Pelatihan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ isset($data['training']) && $data['training'] ? $data['training'] : 0 }}</div>
            </div>
            <div class="col-auto">
              <i class="mdi mdi-package-variant-closed fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Peserta Card -->
    <div class="col-xl-3 col-md-6 col-12 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Total Peserta Mendaftar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ isset($data['user']) && $data['user'] ? $data['user'] : 0 }}</div>
            </div>
            <div class="col-auto">
              <i class="mdi mdi-package-variant-closed fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Sertifikat Card -->
    <div class="col-xl-3 col-md-6 col-12 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Total Sertifikat Tercetak</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                {{ isset($data['certificate']) && $data['certificate'] ? $data['certificate'] : 0 }}</div>
            </div>
            <div class="col-auto">
              <i class="mdi mdi-package-variant-closed fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!--Row-->
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body mx-4 my-2">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm text-brand-green-dark mb-1">
                Selamat Datang,</div>
              <div class="h2 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->name }}</div>
            </div>
            <div class="col-auto">
              <img class="img-fluid px-3 px-sm-4 my-3" src="{{ asset('img/undraw_city_life_gnpr.svg') }}" alt="Welcome"
                style="width: 25rem;">
            </div>
          </div>
          <div class="text-center">


          </div>
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
