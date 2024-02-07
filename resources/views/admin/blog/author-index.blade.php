@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  Atur {{ $active }}
@endsection

@section('headmeta')
  <!-- DataTables -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/select2/dist/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin/select2-custom.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Atur {{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Berita & Aktivitas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Atur {{ $active }}</li>
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
                      <label class="form-control-label" for="normal-input">Nama</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                        name="name" type="text" value="{{ old('name') }}" maxlength="255" required="required">
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
                      <label class="form-control-label" for="normal-input">Bio</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" maxlength="255" rows="2"
                        required="required">{{ old('bio') }}</textarea>
                      @error('bio')
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
                      <label class="form-control-label" for="select2Employee">SDM</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="select2 form-control @error('employee') is-invalid @enderror" id="select2Employee"
                        name="employee">
                        @foreach ($employees as $e)
                          <option value="{{ $e->id }}" {{ old('employee') == $e->id ? 'selected' : '' }}>
                            {{ $e->nameWithTitle }}</option>
                        @endforeach
                      </select>
                      @error('employee')
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

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-blue-dark">{{ $active }}</h6>
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
            @if ($errors->has('editName'))
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @if ($errors->has('editName'))
                    <li>{{ $errors->first('editName') }}</li>
                  @endif
                </ul>
              </div>
            @endif
            <div class="table-responsive">
              <table class="table table-bordered dataTable" id="dataTable" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="width: 50px">#</th>
                    <th>Nama</th>
                    <th>Bio</th>
                    <th>SDM</th>
                    <th style="width: 120px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($data as $d)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{!! $d->name !!}</td>
                      <td>{{ $d->bio }}</td>
                      <td>{!! $d->employee ? $d->employee->nameWithTitlePhoto : null !!}</td>
                      <td>
                        <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-form"
                          data-toggle="modal" data-target="#edit-form" href="#"
                          onclick="editModal('{{ route($route . '.edit') }}','{{ $d->id }}')"><i
                            class="fas fa-pen"></i></a>
                        @if ($used && $used[$d->id] < 1)
                          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm"
                            href="#"
                            onclick="deleteModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->name)) !!}', '{{ route($route . '.destroy', ['id' => $d->id]) }}')"><i
                              class="fas fa-trash"></i></a>
                        @else
                          <button class="btn btn-sm btn-secondary" type="button" disabled="disabled"><i
                              class="fas fa-trash"></i></button>
                        @endif
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
          <div class="text-center mx-3 my-5">
            <h3 class="text-center">Mohon Maaf,</h3>
            <h6 class="font-weight-light mb-3">Tidak ada data {{ strtolower($active) }} yang ditemukan</h6>
          </div>
        @endif
      </div>
    </div>
  </div>
  <!--Row-->

  <div class="modal fade" id="edit-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-brand-orange border-0">
          <h5 class="modal-title text-white">Ubah</h5>
          <button class="close" data-dismiss="modal" type="button" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>

        <div class="modal-load p-4">
          <div class="row">
            <div class="col-12">
              <div class="text-center my-5">
                <i class="fa fa-spin fa-circle-notch fa-lg text-brand-green"></i>
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

  <!-- DataTables -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Select2 -->
  <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

  <!-- Page level custom scripts -->
  @include('template.footjs.global.datatables')
  @include('template.footjs.global.select2')
  @include('template.footjs.modal.post_edit')
  @include('template.footjs.modal.get_delete')
@endsection
