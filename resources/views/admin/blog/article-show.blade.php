@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  Lihat {{ $active }}
@endsection

@section('headmeta')
  <style>
    .section-headline h1 {
      margin: 40px 0 10px;
      text-align: center;
      font-weight: 600;
      font-size: 40px;
      color: #000;
    }

    .containers .image {
      display: flex;
      overflow: hidden;
      justify-content: center;
    }

    .containers .image img {
      max-height: 400px;
      border-radius: 20px;
      padding: 30px;
    }
  </style>
@endsection

@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">Lihat {{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Berita & Aktivitas</a></li>
      <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">{{ $active }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $data->id }}</li>
    </ol>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body px-4 py-3">
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
          <div class="row mb-md-0 mb-3">
            <div class="col-lg-8 col-md-10 col-12">
              <div class="form-group mb-0">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label class="form-control-label font-weight-light">ID</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    {{ $data->id }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-md-0 mb-3">
            <div class="col-lg-8 col-md-10 col-12">
              <div class="form-group mb-0">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label class="form-control-label font-weight-light">Kategori</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    @if ($data->categories()->count() > 0)
                      @foreach ($data->categories as $c)
                        <span class="badge badge-light font-weight-normal">{{ $c->name }}</span>
                      @endforeach
                    @else
                      -
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-md-0 mb-3">
            <div class="col-lg-8 col-md-10 col-12">
              <div class="form-group mb-0">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label class="form-control-label font-weight-light">Status</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    @if ($data->is_draft == 0 && $data->published_at)
                      <span class="badge badge-success font-weight-normal">Terpublikasi</span>
                    @else
                      <span class="badge badge-light font-weight-normal">Draf</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-md-0 mb-3">
            <div class="col-lg-8 col-md-10 col-12">
              <div class="form-group mb-0">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                    <label class="form-control-label font-weight-light">Dibuat</label>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                    {{ $data->createdAtId }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          @if ($data->is_draft == 0 && $data->published_at)
            <div class="row mb-md-0 mb-3">
              <div class="col-lg-8 col-md-10 col-12">
                <div class="form-group mb-0">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label font-weight-light">Dipublikasi</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      {{ $data->publishedAtId }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endif
          <div class="d-flex justify-content-end">
            <a class="btn btn-sm btn-light mr-2" href="{{ route($route . '.index') }}">Kembali</a>
            <a class="btn btn-sm btn-warning mr-2" href="{{ route($route . '.edit', ['id' => $data->id]) }}">Ubah</a>
            @if ($data->is_draft == 1 || !$data->published_at)
              <button class="btn btn-sm btn-success" type="button"
                onclick="publishModal('publish-confirm', '{!! addslashes(htmlspecialchars($data->title)) !!}', '{{ $active }}', '{{ route($route . '.publish') }}','{{ $data->id }}','show')">Publikasi</button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-brand-blue-dark">Pratinjau</h6>
        </div>
        <div class="card-body px-4 py-3">
          <div class="container">
            <div class="section-headline">
              <h1>{{ $data->title }}</h1>
            </div>
            <div class="detail d-flex justify-content-center">
              @if ($data->reading_time)
                <div class="time mr-3"><i class="bi bi-clock mr-2"></i>{{ $data->reading_time }}</div>
              @endif
              @if ($data->author)
                <div class="author mr-3"><i class="bi bi-person-circle mr-2"></i><span>{{ $data->author->name }}</span>
                </div>
              @endif
              <div class="date"><i
                  class="bi bi-calendar-check mr-2"></i>{{ $data->published_at ? $data->publishedAtIdFull : $data->createdAtId }}
              </div>
            </div>

            <div class="containers mb-5">
              <div class="image">
                <img class="img-fluid" src="{{ asset($data->thumbnailPath) }}" alt="thumbnail-{{ $data->id }}">
              </div>
              {!! $data->text !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Row-->

  @include('template.modal.publish-confirm')

@endsection

@section('footjs')
  <!-- Plugins and scripts required by this view-->

  <!-- Page level custom scripts -->
  @include('template.footjs.modal.put_publish')
@endsection
