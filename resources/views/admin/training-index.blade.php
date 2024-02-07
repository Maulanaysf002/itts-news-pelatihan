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
  <!-- Bootstrap DatePicker -->
  <link href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
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
      <div class="card shadow" id="addItemCard">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark">Buat Pelatihan Baru</h6>
        </div>
        <div class="card-body px-4 py-3">
          <form id="addItemForm" action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="normal-input">Judul <span
                          class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control form-control-sm @error('title') is-invalid @enderror" id="title"
                        name="title" type="text" value="{{ old('title') }}" maxlength="255" required="required"
                        placeholder="tidak boleh menggunakan karakter (/, &, ^, @, dll)">
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
                      <label class="form-control-label" for="normal-input">Flayer</label>
                    </div>
                    <div class="col-lg-7 col-md-8 col-12">
                      @php
                        $inputImageName = 'image';
                      @endphp
                      <img class="img-thumbnail photo-preview" id="preview{{ ucwords($inputImageName) }}"
                        src="{{ asset('img/admin/default-flayer.jpg') }}">
                      <input class="file image-input d-none" name="{{ $inputImageName }}" type="file"
                        accept="image/jpg,image/jpeg,image/png,image/webp">
                      <div class="input-group mt-3">
                        <input class="form-control form-control-sm @error($inputImageName) is-invalid @enderror"
                          id="file{{ ucwords($inputImageName) }}" type="text" disabled placeholder="Unggah gambar...">
                        <div class="input-group-append">
                          <button class="browse btn btn-sm btn-primary" type="button">Pilih</button>
                        </div>
                      </div>
                      <small class="form-text text-muted">Rasio 8R. Ekstensi .jpg, .jpeg, .png, .webp. Maks 500
                        kb.</small>
                      @error($inputImageName)
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
                      <label class="form-control-label" for="normal-input">Deskripsi</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <textarea class="form-control" id="desc" name="desc" maxlength="255" rows="3" placeholder="boleh kosong"> </textarea>
                      @error('desc')
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
                      <label class="form-control-label" for="selectType">Tipe pelatihan <span
                          class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="form-control" id="selectType" name="type" required="required">
                        <option value="" {{ old('type') ? '' : 'selected' }} disabled="disabled">Pilih salah
                          satu</option>
                        @foreach ($type as $t)
                          <option value="{{ $t->id }}" {{ old('type') == $t->id ? 'selected' : '' }}>
                            {{ $t->name }}</option>
                        @endforeach
                      </select>
                      @error('type')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row ">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="dateInput">Tanggal Pelaksanaan</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <div class="input-group date">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input class="form-control" id="dateInput" name="date" type="text"
                          value="{{ date('d F Y') }}" placeholder="Pilih tanggal">
                      </div>
                      @error('date')
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
                      <label class="form-control-label" for="normal-input">Link Zoom</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <input class="form-control form-control-sm @error('link') is-invalid @enderror" id="link"
                        name="link" type="text" value="{{ old('link') }}" maxlength="255"
                        required="required" placeholder="mis. https://www.google.com/">
                      @error('link')
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
                      <label class="form-control-label" for="select2Speaker">Pemateri<span
                          class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="select2-multiple form-control" id="select2Speaker" name="speaker[]"
                        multiple="multiple" required="required">
                        @foreach ($speaker as $s)
                          <option value="{{ $s->id }}"
                            {{ old('speaker') ? (in_array($s->id, old('speaker')) ? 'selected' : '') : '' }}>
                            {{ $s->nameWithTitle }}</option>
                        @endforeach
                      </select>
                      @error('speaker')
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
                      <label class="form-control-label" for="select2Moderator">Moderator<span
                          class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="select2-multiple form-control" id="select2Moderator" name="moderator[]"
                        multiple="multiple" required="required">
                        @foreach ($moderator as $m)
                          <option value="{{ $m->id }}"
                            {{ old('moderator') ? (in_array($m->id, old('moderator')) ? 'selected' : '') : '' }}>
                            {{ $m->nameWithTitle }}</option>
                        @endforeach
                      </select>
                      @error('moderator')
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
                      <label class="form-control-label" for="select2Collaboration">Kolaborasi
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="select2-multiple form-control" id="select2Collaboration" name="collaboration[]"
                        multiple="multiple">
                        @foreach ($collaboration as $c)
                          <option value="{{ $c->id }}" placeholder="boleh kosong, default logo itts"
                            {{ old('collaboration') ? (in_array($c->id, old('collaboration')) ? 'selected' : '') : '' }}>
                            {{ $c->name }}</option>
                        @endforeach
                      </select>
                      @error('collabortion')
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
                      <label class="form-control-label" for="selectType">Penanda Tangan Sertifikat<span
                          class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="form-control" id="selectType" name="signature" required="required">
                        <option value="" {{ old('signature') ? '' : 'selected' }} disabled="disabled">Pilih salah
                          satu</option>
                        @foreach ($signature as $s)
                          <option value="{{ $s->id }}" {{ old('signature') == $s->id ? 'selected' : '' }}>
                            {{ $s->nameWithTitle }}</option>
                        @endforeach
                      </select>
                      @error('signature')
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
                      <label class="form-control-label" for="selectType">Penanda Tangan SK<span
                          class="text-danger">*</span></label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="form-control" id="selectType" name="sksignature" required="required">
                        <option value="" {{ old('sksignature') ? '' : 'selected' }} disabled="disabled">Pilih
                          salah
                          satu</option>
                        @foreach ($sksignature as $sks)
                          <option value="{{ $sks->id }}" {{ old('sksignature') == $sks->id ? 'selected' : '' }}>
                            {{ $sks->nameWithTitle }}</option>
                        @endforeach
                      </select>
                      @error('signature')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-lg-10 col-md-12">
                <div class="row">
                  <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-12 text-left">
                    {{-- @if ($premixes && count($premixes) > 0)
                      <button class="btn btn-brand-green-dark btn-make" data-toggle="modal" data-target="#make-confirm"
                        type="button">Buat</button>
                    @else
                      <button class="btn btn-secondary btn-make" data-toggle="modal" data-target="#make-confirm"
                        type="button" disabled="disabled">Buat</button>
                    @endif --}}
                    <button class="btn btn-brand-green-dark" type="submit">Buat</button>
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
            <div class="table-responsive">
              <table class="table table-bordered dataTable" id="dataTable" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>Flayer</th>
                    <th>Waktu</th>
                    <th>Link Zoom</th>
                    <th>Pemateri</th>
                    <th>Moderator</th>
                    <th>Kolaborasi</th>
                    <th>Kode Training</th>
                    <th>Penandatangan Sertif</th>
                    <th>Penandatangan SK</th>
                    <th>status</th>
                    <th>aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($data as $d)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $d->title }}</td>
                      <td>{{ $d->description }}</td>
                      <td>{!! $d->avatar !!}</td>
                      <td>{{ $d->dateId }}</td>
                      <td>
                        @if ($d->meet_link)
                          <a class="text-brand-blue" href="{{ $d->meet_link }}"
                            target="_blank">{{ $d->meet_link }}</a><i class="bi bi-box-arrow-up-right ml-2"></i>
                        @endif
                      </td>
                      <td>
                        @foreach ($d->speakerName as $n)
                          <span class="badge badge-light font-weight-normal">{{ $n }}</span>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($d->moderatorName as $n)
                          <span class="badge badge-light font-weight-normal">{{ $n }}</span>
                        @endforeach
                      </td>
                      <td>
                        @foreach ($d->collabName as $c)
                          <span class="badge badge-light font-weight-normal">{{ $c }}</span>
                        @endforeach
                      </td>
                      <td>{{ $d->training_code }}</td>
                      <td>
                        @foreach ($d->signatureName as $s)
                          {{ $s }}
                        @endforeach
                      </td>
                      <td>
                        @foreach ($d->sksignatureName as $sksn)
                          {{ $sksn }}
                        @endforeach
                      </td>
                      <td>
                        @if ($d->status == 0)
                          <span class="badge badge-pill badge-danger" data-toggle="tooltip"
                            data-original-title="klik icon Ceklis jika pelatihan {{ $d->title }} sudah terlaksana">Belum
                            Terlaksana</span>
                        @elseif($d->status == 1)
                          <span class="badge badge-pill badge-success" data-toggle="tooltip"
                            data-original-title="Data Pelatihan {{ $d->title }} tidak bisa dirubah">Sudah
                            Terlaksana</span>
                        @else
                          -
                        @endif
                      </td>
                      <td>
                        {{-- edit data --}}
                        @if ($d->status == 0)
                          <a class="btn btn-sm btn-warning mb-1" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#"
                            onclick="editModal('{{ route($route . '.edit') }}','{{ $d->id }}')"><i
                              class="fas fa-pen" data-toggle="tooltip"
                              data-original-title="Edit Pelatihan {{ $d->title }}"></i></a>
                        @elseif($d->status == 1)
                          <a class="btn btn-sm btn-warning mb-1 disabled" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#"
                            onclick="editModal('{{ route($route . '.edit') }}','{{ $d->id }}')"><i
                              class="fas fa-pen"></i></a>
                        @endif


                        {{-- hapus data --}}
                        @if ($used && $used[$d->id] < 1)
                          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-confirm"
                            href="#"
                            onclick="deleteModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->name)) !!}', '{{ route($route . '.destroy', ['id' => $d->id]) }}')"><i
                              class="fas fa-trash"></i></a>
                        @else
                          <button class="btn btn-sm btn-secondary" type="button" disabled="disabled"><i
                              class="fas fa-trash"></i></button>
                        @endif

                        {{-- selesaikan pelatihan --}}
                        @if ($d->status == 0 && \Carbon\Carbon::parse($d->t_date)->isPast())
                          <a class="btn btn-sm btn-success mt-1" data-toggle="modal"
                            data-target="#traininFinish-confirm" href="#"
                            onclick="finishTrainingModal('{{ $active }}', '{!! addslashes(htmlspecialchars($d->name)) !!}', '{{ route($route . '.finish', ['id' => $d->id]) }}')"><i
                              class="fas fa-check" data-toggle="tooltip"
                              data-original-title="Selesaikan Pelatihan {{ $d->title }}"></i></a>
                          {{-- <form action="{{ route($route . '.finish', ['id' => $d->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success btn-check mt-1" type="submit">
                              <i class="fas fa-check" data-toggle="tooltip"
                                data-original-title="Selesaikan Pelatihan {{ $d->title }}"></i>
                            </button>
                          </form> --}}
                        @elseif ($d->status == 0 && \Carbon\Carbon::parse($d->t_date)->isFuture())
                          <a class="btn btn-sm btn-danger mt-1" data-toggle="modal"><i class="fas fa-check"
                              data-toggle="tooltip"
                              data-original-title="dapat diselesaikan pada tanggal {{ date('d-m-Y', strtotime($d->t_date)) }}"></i></a>
                        @elseif($d->status == 1)
                          <a class="btn btn-sm btn-success mt-1 disabled" data-toggle="modal" href="#"><i
                              class="fas fa-check" data-toggle="tooltip"
                              data-original-title="Pelatihan {{ $d->title }} telah selesai"></i></a>
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
            <div class="alert
                              alert-success alert-dismissible fade show m-3"
              role="alert">
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
  @include('template.modal.trainingFinish-confirm')
@endsection

@section('footjs')
  <!-- Plugins and scripts required by this view-->

  <!-- Page level plugins -->

  <!-- Image Preview (untuk gambar) -->
  <script src="{{ asset('js/image-preview.js') }}"></script>

  <!-- DataTables -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Bootstrap Datepicker -->
  <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
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
  @include('template.footjs.modal.get_finish')
@endsection
