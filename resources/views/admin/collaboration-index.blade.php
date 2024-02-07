@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  {{ $active }}
@endsection

@section('headmeta')
  <!-- DataTables -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/select2/dist/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2-custom.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">{{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark ">Tambah Kolaboraso</h6>
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
                      <label class="form-control-label" for="normal-input">Nama Institusi<span
                          class="text-danger">*</span></label>

                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                        name="name" type="text" value="{{ old('name') }}" placeholder="masukan nama institusi"
                        maxlength="255" required="required">
                      @error('name')
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
                      <label class="form-control-label" for="normal-input">Logo</label>
                    </div>
                    <div class="col-lg-7 col-md-8 col-12">
                      @php
                        $inputImageName = 'logo';
                      @endphp
                      <img class="img-thumbnail photo-preview" id="preview{{ ucwords($inputImageName) }}"
                        src="{{ asset('img/admin/default-flayer.jpg') }}">
                      <input class="file image-input d-none" name="{{ $inputImageName }}" type="file"
                        accept="image/jpg,image/jpeg,image/png,image/webp">
                      <div class="input-group mt-3">
                        <input class="form-control form-control-sm @error($inputImageName) is-invalid @enderror"
                          id="file{{ ucwords($inputImageName) }}" type="text" disabled
                          placeholder="Unggah gambar, untuk diletakan di sertifikat">
                        <div class="input-group-append">
                          <button class="browse btn btn-sm btn-primary" type="button">Pilih</button>
                        </div>
                      </div>
                      <small class="form-text text-muted">Rasio 1:1. Ekstensi .jpg, .jpeg, .png, .webp. Maks 500
                        kb.</small>
                      @error($inputImageName)
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
                    <input class="btn btn-sm btn-brand-green-dark" type="submit" value="Tambah">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark">{{ $active }}</h6>
        </div>
        @if (count($data) > 0)
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
            <div class="table-responsive">
              <table class="table table-flush dataTable" id="dataTable" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Nama</th>
                    <th>Logo</th>
                    <th style="width: 120px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($data as $d)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $d->name }}</td>
                      <td>{!! $d->avatar !!}</td>
                      <td>
                        {{-- edit --}}
                        <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-form"
                          data-toggle="modal" data-target="#edit-form" href="#"
                          onclick="editModal('{{ route($route . '.edit') }}','{{ $d->id }}')"><i
                            class="fas fa-pen"></i></a>
                        {{-- delete --}}
                        <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm"
                          href="#"
                          onclick="deleteModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->name)) !!}', '{{ route($route . '.destroy', ['id' => $d->id]) }}')"><i
                            class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @else
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
              <strong>Sukses!</strong> {{ Session::get('success') }}
              <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if (Session::has('danger'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
              <strong>Gagal!</strong> {{ Session::get('danger') }}
              <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger m-3">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="text-center mx-3 my-5">
            <h3 class="text-center">Mohon Maaf,</h3>
            <h6 class="font-weight-light mb-3">Tidak ada data {{ strtolower($active) }} yang ditemukan</h6>
          </div>
        @endif
      </div>
    </div>
    <!--Row-->

    <div class="modal fade" id="edit-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
      tabindex="-1" style="display: none;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-brand-green-dark border-0">
            <h5 class="modal-title text-white">Ubah</h5>
            <button class="close" data-dismiss="modal" type="button" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>

          <div class="modal-load p-4">
            <div class="row">
              <div class="col-12">
                <div class="text-center my-5">
                  <i class="fa fa-spin fa-circle-notch fa-lg text-brand-primary"></i>
                  <h5 class="font-weight-light mb-3">Memuat...</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body p-4" style="display: none;">
          </div>
        </div>
      </div>
    </div>

    <!--Row-->

    <div class="modal fade" id="edit-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
      tabindex="-1" style="display: none;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-brand-green-dark border-0">
            <h5 class="modal-title text-white">Ubah</h5>
            <button class="close" data-dismiss="modal" type="button" aria-label="Close">
              <span aria-hidden="true">x</span>
            </button>
          </div>

          <div class="modal-load p-4">
            <div class="row">
              <div class="col-12">
                <div class="text-center my-5">
                  <i class="fa fa-spin fa-circle-notch fa-lg text-brand-primary"></i>
                  <h5 class="font-weight-light mb-3">Memuat...</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body p-4" style="display: none;">
          </div>
        </div>
      </div>
    </div>

    @include('template.modal.delete-confirm')
  @endsection

  @section('footjs')
    <!-- Plugins and scripts required by this view-->

    <!-- Page level plugins -->

    <!-- Image Preview (untuk gambar) -->
    <script src="{{ asset('js/image-preview.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Easy Number Separator JS -->
    <script src="{{ asset('vendor/easy-number-separator/easy-number-separator.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

    <!-- Page level custom scripts -->
    @include('template.footjs.global.datatables')
    @include('template.footjs.global.select2')
    @include('template.footjs.global.tooltip')
    @include('template.footjs.modal.post_edit')
    @include('template.footjs.modal.get_delete')
  @endsection
