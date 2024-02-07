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
  <meta name="csrf-token" content="{{ Session::token() }}" />
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/select2/dist/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin/select2-custom.css') }}" rel="stylesheet">
  <!-- Bootstrap DatePicker -->
  <link href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Filter Berdasarkan Training</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <ul class="nav nav-pills p-3">
          <ul class="nav">
            <li class="nav-item" id="belumSelesaiTab">
              <a class="nav-link {{ request('trainingStatus') == 0 ? 'active text-white' : '' }}"
                href="{{ route('admin.participant.index', ['trainingStatus' => 0]) }}">Belum
                Selesai</a>
            </li>
            <li class="nav-item hidden" id="selesaiTab">
              <a class="nav-link {{ request('trainingStatus') == 1 ? 'active text-white' : '' }}"
                href="{{ route('admin.participant.index', ['trainingStatus' => 1]) }}">Selesai</a>
            </li>
          </ul>
        </ul>
      </div>
    </div>
  </div>

  {{-- table --}}
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark">Training</h6>
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
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if (count($training) > 0)
            <div class="table-responsive">
              <table class="table table-bordered dataTable" id="dataTable" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>title</th>
                    <th>flayer</th>
                    <th>waktu</th>
                    <th>aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($training as $t)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $t->title }}</td>
                      <td>{!! $t->avatar !!}</td>
                      <td>{{ $t->dateId }}</td>
                      <td>
                        <a class="btn btn-sm btn-brand-green-dark"
                          href="{{ route('admin.participant.detail', ['id' => $t->id]) }}"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
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
          <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
              <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </ul>
          </div>
        @endif
        {{-- <div class="text-center mx-3 my-5">
          <h3 class="text-center">Mohon Maaf,</h3>
          <h6 class="font-weight-light mb-3">Tidak ada data {{ strtolower($active) }} yang ditemukan</h6>
        </div> --}}
      </div>
    </div>
  </div>

  <!--Row-->

  <div class="modal fade" id="edit-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary border-0">
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
  @include('template.footjs.global.tooltip')
  @include('template.footjs.global.select2-multiple')
  @include('template.footjs.global.datepicker')
  @include('template.footjs.modal.post_edit')
  @include('template.footjs.modal.get_delete')
@endsection
