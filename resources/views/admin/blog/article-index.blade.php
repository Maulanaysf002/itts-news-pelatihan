@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  {{ $active }}
@endsection

@section('headmeta')
  <!-- Bootstrap Toggle -->
  <link href="{{ asset('vendor/bootstrap4-toggle/css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
  <!-- DataTables -->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/select2/dist/css/select2-bootstrap4.min.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ Session::token() }}" />
  <style>
    .select2-container .select2-results__option[aria-disabled=true] {
      background-color: #dddfeb !important;
    }
  </style>
  <meta name="csrf-token" content="{{ Session::token() }}" />
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">{{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Berita & Aktivitas</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-blue-dark">{{ $active }}</h6>
          <a class="m-0 float-right btn btn-primary btn-sm" href="{{ route($route . '.create') }}">Tambah<i
              class="fas fa-plus-circle ml-2"></i></a>
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
              <table class="table table-bordered dataTable" id="dataTable" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="width: 50px">#</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Penulis</th>
                    @if (auth()->user()->role->name == 'Superadmin')
                      <th>Dilihat</th>
                    @endif
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tampil</th>
                    <th>Disembunyikan</th>
                    <th style="width: 120px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($data as $d)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $d->title }}</td>
                      <td>{!! strlen($d->text) > 80 ? substr($d->text, 0, strpos($d->text, ' ', 80)) . ' ...' : $d->text !!}</td>
                      <td>{!! $d->thumbnail ? $d->thumbnailPreview : null !!}</td>
                      <td>{{ $d->author ? $d->author->name : '-' }}</td>
                      @if (auth()->user()->role->name == 'Superadmin')
                        <td>{{ $d->totalViewsWithSeparator }}</td>
                      @endif
                      <td>{{ $d->implodedCategories }}</td>
                      <td>
                        @if ($d->is_draft == 0 && $d->published_at)
                          <i class="fa fa-lg fa-check-circle text-success" data-toggle="tooltip"
                            data-original-title="Terpublikasi"></i>
                        @else
                          <i class="fa fa-lg fa-question-circle text-secondary" data-toggle="tooltip"
                            data-original-title="Draf"></i>
                        @endif
                      </td>
                      <td>
                        @if ($d->is_draft == 0 && $d->published_at && $d->is_active == 1)
                          <i class="fa fa-lg fa-check-circle text-success" data-toggle="tooltip"
                            data-original-title="Ya"></i>
                        @else
                          <i class="fa fa-lg fa-times-circle text-danger" data-toggle="tooltip"
                            data-original-title="Tidak"></i>
                        @endif
                      </td>
                      <td>
                        @if ($d->is_listed == 0)
                          <i class="fa fa-lg fa-check-circle text-success" data-toggle="tooltip"
                            data-original-title="Ya"></i>
                        @else
                          <i class="fa fa-lg fa-times-circle text-danger" data-toggle="tooltip"
                            data-original-title="Tidak"></i>
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-sm btn-brand-blue" href="{{ route($route . '.show', ['id' => $d->id]) }}"><i
                            class="fas fa-eye"></i></a>
                        <a class="btn btn-sm btn-warning" href="{{ route($route . '.edit', ['id' => $d->id]) }}"><i
                            class="fas fa-pen"></i></a>
                        @if ($used && $used[$d->id] < 1)
                          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm"
                            href="#"
                            onclick="deleteModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->title)) !!}', '{{ route($route . '.destroy', ['id' => $d->id]) }}')"><i
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

  @include('template.modal.delete-confirm')

@endsection

@section('footjs')
  <!-- Plugins and scripts required by this view-->

  <!-- Page level plugins -->

  <!-- Bootstrap Toggle -->
  <script src="{{ asset('vendor/bootstrap4-toggle/js/bootstrap4-toggle.min.js') }}"></script>

  <!-- CKEditor -->
  <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Image Preview -->
  <script src="{{ asset('js/image-preview.js') }}"></script>

  <!-- Select2 -->
  <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

  <!-- Page level custom scripts -->
  @include('template.footjs.global.datatables')
  @include('template.footjs.global.select2-default')
  @include('template.footjs.global.tooltip')
  @include('template.footjs.modal.get_delete')
@endsection
