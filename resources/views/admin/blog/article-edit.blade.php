@extends('template.admin.master')

@section('sidebar')
  @include('template.sidebarMenu.admin.home')
@endsection

@section('title')
  Ubah {{ $active }}
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
    <h1 class="h3 mb-0 text-gray-800">Ubah {{ $active }}</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Beranda</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.news-activities.index') }}">Berita & Aktivitas</a></li>
      <li class="breadcrumb-item"><a href="{{ route($route . '.index') }}">{{ $active }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route($route . '.show', ['id' => $data->id]) }}">{{ $data->id }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Ubah</li>
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
            <a class="btn btn-sm btn-brand-blue mr-2"
              href="{{ route($route . '.show', ['id' => $data->id]) }}">Pratinjau</a>
            @if ($data->is_draft == 1 || !$data->published_at)
              <button class="btn btn-sm btn-success" type="button"
                onclick="publishModal('publish-confirm', '{!! addslashes(htmlspecialchars($data->title)) !!}', '{{ $active }}', '{{ route($route . '.publish') }}','{{ $data->id }}','edit')">Publikasi</button>
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
          <h6 class="m-0 font-weight-bold text-brand-blue-dark">Ubah</h6>
        </div>
        <div class="card-body px-4 py-3">
          <form id="edit-data-form" action="{{ route($route . '.update') }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input id="id" name="id" type="hidden" value="{{ $data->id }}" required="required">
            <div class="row">
              <div class="col-lg-10 col-md-12">
                <div class="form-group">
                  <div class="row mb-3">
                    <div class="col-lg-3 col-md-4 col-12">
                      <label class="form-control-label" for="select2Author">Penulis</label>
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                      <select class="select2 form-control form-control-sm @error('editAuthor') is-invalid @enderror"
                        id="select2Author" name="editAuthor" required="required">
                        @foreach ($authors as $a)
                          <option value="{{ $a->id }}"
                            {{ old('editAuthor', $data->author_id) == $a->id ? 'selected' : '' }}>{{ $a->name }}
                          </option>
                        @endforeach
                      </select>
                      @error('editAuthor')
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
                      <input class="form-control form-control-sm @error('editTitle') is-invalid @enderror"
                        id="editTitle" name="editTitle" type="text" value="{{ old('editTitle', $data->title) }}"
                        placeholder="Tuliskan judul di sini" maxlength="255">
                      @error('editTitle')
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
                      <textarea class="form-control form-control-sm @error('editText') is-invalid @enderror ckeditor" id="editText"
                        name="editText" rows="15" required="required">{!! old('editText', $data->text) !!}</textarea>
                      @error('editText')
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
                        $inputImageName = 'editThumbnail';
                      @endphp
                      <img class="img-thumbnail article-thumbnail-preview" id="preview{{ ucwords($inputImageName) }}"
                        src="{{ asset($data->showThumbnailSm) }}">
                      <input class="file image-input d-none" name="{{ $inputImageName }}" type="file"
                        accept="image/jpg,image/jpeg,image/png,image/webp">
                      <div class="input-group mt-3">
                        <input class="form-control form-control-sm @error($inputImageName) is-invalid @enderror"
                          id="file{{ ucwords($inputImageName) }}" type="text" disabled
                          placeholder="Unggah gambar...">
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
                        <select class="select2-multiple form-control" id="select2Categories" name="editCategories[]"
                          multiple="multiple">
                          @foreach ($categories as $c)
                            <option value="{{ $c->id }}"
                              {{ old('editCategories', $data->categories()->count() > 0 ? $data->categories->pluck('id')->toArray() : []) ? (in_array($c->id, old('editCategories', $data->categories()->count() > 0 ? $data->categories->pluck('id')->toArray() : [])) ? 'selected' : '') : '' }}>
                              {{ $c->name }}</option>
                          @endforeach
                        </select>
                        @error('editCategories')
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
                      <input id="editKeywords" name="editKeywords" data-role="tagsinput" type="text"
                        value="{{ old('editKeywords', $data->keywords) }}">
                      @error('editKeywords')
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
                      <input class="edit-active-toggle" id="editUnlisted" name="editUnlisted" data-toggle="toggle"
                        data-on="Ya" data-off="Tidak" data-onstyle="success" data-offstyle="danger"
                        data-size="small" type="checkbox"
                        {{ old('editUnlisted', $data->is_listed == 0) ? 'checked' : null }}>
                      @error('editUnlisted')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @if ($data->is_draft == 0 && $data->published_at)
              <div class="row">
                <div class="col-lg-10 col-md-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3 col-md-4 col-12">
                        <label class="form-control-label" for="normal-input">Tampil</label>
                      </div>
                      <div class="col-lg-4 col-md-6 col-12">
                        <input class="edit-active-toggle" id="editActive" name="editActive" data-toggle="toggle"
                          data-on="Ya" data-off="Tidak" data-onstyle="success" data-offstyle="danger"
                          data-size="small" type="checkbox"
                          {{ old('editActive', $data->is_active) ? 'checked' : null }}>
                        @error('editActive')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            <div class="row mt-1">
              <div class="col-lg-10 col-md-12">
                <div class="row">
                  <div class="col-lg-9 offset-lg-3 col-md-8 offset-md-4 col-12 text-left">
                    <input class="btn btn-sm btn-brand-blue" type="submit" value="Simpan">
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

  @include('template.modal.publish-confirm')

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
  @include('template.footjs.modal.put_publish')
@endsection
