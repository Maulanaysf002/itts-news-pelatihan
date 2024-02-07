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
    <h1 class="h3 mb-0 text-gray-800">Data Peserta</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $active }}</li>
    </ol>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card">
        <div class="card-body p-4">
          <div class="d-flex flex-row mb-2">
            @foreach ($training as $t)
              <div class="img-thumbnail d-inline-block"><img class="avatar-xl" class="pl-3"
                  src="{{ asset($t->showImage) }}" alt="user-{{ $t->id }}"></div>
              <div style="margin-left: 30px">
                <h3 class="font-weight-medium mt-md-3 mb-0">{{ $t->title }}</h3>
                <span>{{ $t->dateID }}</span>
              </div>
            @endforeach
          </div>
          <div class="d-flex justify-content-end mt-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.participant.index') }}">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Pemateri --}}
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark">PEMATERI</h6>
        </div>
        @if (count($trainingSpeaker) > 0)
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
              <table class="table align-items-center table-flush" id="" role="grid"
                aria-describedby="dataTable_info" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Institusi</th>
                    <th>Kode Sertifikat</th>
                    <th>Kode SK</th>
                    <th>Kehadiran</th>
                    <th>aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($trainingSpeaker as $Ts)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td style="font-weight: bold">{{ $Ts->speaker->nameWithTitle }}</td>
                      <td>{{ $Ts->speaker->position }}</td>
                      <td>{{ $Ts->speaker->institution }}</td>
                      <td>{{ $Ts->certificate_code }}</td>
                      <td>{{ $Ts->invitation_code }}</td>
                      <td>
                        @if ($Ts->certificate_code == 0)
                          <form action="{{ route('admin.training.speaker.presence', ['id' => $Ts->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success btn-check mt-1" type="submit">
                              <i class="fas fa-check" data-toggle="tooltip"
                                data-original-title="Absenkan Pemateri {{ $Ts->speaker->nameWithTitle }}"></i>
                            </button>
                          </form>
                        @else
                          <a class="btn btn-sm btn-success mb-1 disabled" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#"><i class="fas fa-check "></i></a>
                        @endif
                      </td>
                      <td>
                        @if ($Ts->invitation_code)
                          <form action="{{ route('admin.training.speaker.invitation', ['id' => $Ts->id]) }}"
                            method="POST">
                            @csrf
                            <input name='certificate_code' type="text" value="{{ $Ts->invitation_code }}" hidden>
                            <input class="btn btn-sm btn-warning btn-check mt-1" type="submit"
                              value="Unduh Surat Undangan ">
                          </form>
                        @endif
                        @if ($Ts->certificate_code == 0)
                          <a class="btn btn-sm btn-success mt-1 disabled" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#">Unduh Sertifikat</a>
                        @else
                          <form
                            action="{{ route('admin.training.speaker.certificate', ['certificate_code' => $Ts->certificate_code]) }}"
                            method="POST">
                            @csrf
                            <input name='certificate_code' type="text" value="{{ $Ts->certificate_code }}" hidden>
                            <input class="btn btn-sm btn-success btn-check mt-1" type="submit"
                              value="Unduh Sertifikat">
                            {{-- <button class="btn btn-sm btn-success btn-check mt-1" type="submit">
                              <i class="fas fa-check" data-toggle="tooltip"
                                data-original-title="Absenkan Pemateri {{ $Ts->speaker->nameWithTitle }}"></i>
                            </button> --}}
                          </form>
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

  {{-- moderator --}}
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark">MODERATOR</h6>
        </div>
        @if (count($trainingModerator) > 0)
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
              <table class="table align-items-center table-flush" id="" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Institusi</th>
                    <th>Kode Sertifikat</th>
                    <th>Kode SK</th>
                    <th>Kehadiran</th>
                    <th>aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($trainingModerator as $Tm)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td style="font-weight: bold">{{ $Tm->moderator->nameWithTitle }}</td>
                      <td>{{ $Tm->moderator->position }}</td>
                      <td>{{ $Tm->moderator->institution }}</td>
                      <td>{{ $Tm->certificate_code }}</td>
                      <td>{{ $Tm->invitation_code }}</td>
                      <td>
                        @if ($Tm->certificate_code == 0)
                          <form action="{{ route('admin.training.moderator.presence', ['id' => $Tm->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success btn-check mt-1" type="submit">
                              <i class="fas fa-check" data-toggle="tooltip"
                                data-original-title="Absenkan Moderator {{ $Tm->moderator->nameWithTitle }}"></i>
                            </button>
                          </form>
                        @else
                          <a class="btn btn-sm btn-success mb-1 disabled" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#"><i class="fas fa-check "></i></a>
                        @endif
                      </td>
                      <td>
                        @if ($Tm->invitation_code)
                          <form action="{{ route('admin.training.moderator.invitation', ['id' => $Tm->id]) }}"
                            method="POST">
                            @csrf
                            <input name='certificate_code' type="text" value="{{ $Tm->invitation_code }}" hidden>
                            <input class="btn btn-sm btn-warning btn-check mt-1" type="submit"
                              value="Unduh Surat Undangan ">
                          </form>
                        @endif
                        @if ($Tm->certificate_code == 0)
                          <a class="btn btn-sm btn-success mt-1 disabled" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#">Unduh Sertifikat</a>
                        @else
                          <form
                            action="{{ route('admin.training.moderator.certificate', ['certificate_code' => $Tm->certificate_code]) }}"
                            method="POST">
                            @csrf
                            <input name='certificate_code' type="text" value="{{ $Tm->certificate_code }}" hidden>
                            <input class="btn btn-sm btn-success btn-check mt-1" type="submit"
                              value="Unduh Sertifikat">
                            {{-- <button class="btn btn-sm btn-success btn-check mt-1" type="submit">
                              <i class="fas fa-check" data-toggle="tooltip"
                                data-original-title="Absenkan Pemateri {{ $Ts->speaker->nameWithTitle }}"></i>
                            </button> --}}
                          </form>
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

  {{-- peserta --}}
  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-green-dark">{{ $active }}</h6>
        </div>
        @if (count($Trainingparticipant) > 0)
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
              <table class="table align-items-center table-bordered" id="dataTable" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Institusi</th>
                    <th>Jabatan</th>
                    <th>Telepon</th>
                    <th>Sosial Media</th>
                    <th>Absensi</th>
                    <th>Kode Registrasi</th>
                    <th>Kode Sertifikat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($Trainingparticipant as $Tp)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $Tp->participants->name }}</td>
                      <td>{{ $Tp->participants->email }}</td>
                      <td>{{ $Tp->participants->institution }}</td>
                      <td>{{ $Tp->participants->position }}</td>                      
                      <td>{{ $Tp->participants->participant_phone }}</td>
                      <td>{{ $Tp->participants->social_media }}</td>
                      <td>
                        @if ($Tp->presence == 0)
                          <span class="badge badge-pill badge-danger">Belum</span>
                        @elseif($Tp->presence == 1)
                          <span class="badge badge-pill badge-success">Sudah</span>
                        @else
                          -
                        @endif
                      </td>
                      <td>{{ $Tp->register_code }}</td>
                      <td>{{ $Tp->certificate_code }}</td>
                      <td>
                        @if ($Tp->presence == 0)
                          <form action="{{ route($route . '.presence', ['id' => $Tp->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success btn-check mt-1" type="submit">
                              <i class="fas fa-check" data-toggle="tooltip"
                                data-original-title="Absenkan Peserta {{ $Tp->participants->name }}"></i>
                            </button>
                          </form>
                          {{-- <a class="btn btn-sm btn-success mb-1" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#"
                            onclick="editModal('{{ route($route . '.edit') }}','{{ $Tp->participants->id }}')"><i
                              class="fas fa-check" data-toggle="tooltip" data-original-title="Absenkan Peserta"></i></a> --}}
                        @elseif($Tp->presence == 1)
                          <a class="btn btn-sm btn-success mb-1 disabled" data-toggle="modal" data-target="#edit-form"
                            data-toggle="modal" href="#"
                            onclick="editModal('{{ route($route . '.edit') }}','{{ $Tp->participants->id }}')"><i
                              class="fas fa-check "></i></a>
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
@endsection

@section('footjs')
  <!-- DataTables -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom script -->
  @include('template.footjs.global.datatables')

  <script>
    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
@endsection
