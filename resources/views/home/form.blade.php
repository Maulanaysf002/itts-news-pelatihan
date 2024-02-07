@extends('template.form.master')

@section('content')
  <div class="d-flex justify-content-center">
    <section class="forms" id="form">
      <div class="option">
        <p>Seek Additional Training? <a href="/">Click Here</a></p>
      </div>
      <div class="header d-flex flex-column justify-content-center align-items-center">
        <img class="img-fluid img-logo" src={{ asset('assets/img/logo/logoitts_Logo.png') }} alt="">
        <h3 class="heading">Form Pendaftaran Pelatihan <br>Institut Teknologi Tangerang Selatan</h3>
        <p class="description">Ayok Dapatkan Sertifikat Pelatihan Dari Kami</p>
      </div>
      <div class="form" id="form">
        <p class="detail">Jenis Pelatihan</p>

        <form id="addItemForm" action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data"
          accept-charset="utf-8">
          {{ csrf_field() }}

          <div class="input-column d-flex flex-column ">
            <label for="trainingId">Pelatihan</label>
            <select name="trainingId">
              <option value="" style="font-style: italic" {{ old('training') ? '' : 'selected' }}
                disabled="disabled">
                Pilih Pelatihan yang Tersedia</option>
              @foreach ($data as $d)
                <option value="{{ $d->id }}" {{ old('training') == $d->id ? 'selected' : '' }}>
                  {{ $d->title }}</option>
              @endforeach
            </select>
          </div>


          <p class="detail">Bio Data Peserta</p>
          <div class="input-column d-flex flex-column">
            <label for="name">Nama Lengkap + Gelar</label>
            <input class="@error('name') is-invalid @enderror" id="name" name="name" type="text"
              value="{{ old('name') }}" placeholder="Nama Yang Akan Tercetak di Sertifikat">
            @error('name')
              <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="name">Email</label>
            <input class="@error('email') is-invalid @enderror" id="email" name="email" type="email"
              value="{{ old('email') }}" placeholder=" mis. contoh@gmail.com">
            @error('email')
              <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="instituion">Institusi</label>
            <input class="@error('institution') is-invalid @enderror" id="institution" name="institution"
              type="institution" value="{{ old('institution') }}" placeholder=" masukan nama institusi Anda">
            @error('institution')
              <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="instituion">Jabatan/Posisi</label>
            <input class="@error('position') is-invalid @enderror" id="position" name="position" type="position"
              value="{{ old('position') }}" placeholder="masukan jabatan anda, mis. guru, mahasiswa, pelajar">
            @error('position')
              <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="participantPhone">No Handphone</label>
            <input class="@error('participantPhone') is-invalid @enderror" id="participantPhone" name="participantPhone"
              type="number" value="{{ old('participantPhone') }}" maxlength="12" placeholder=" mis. 08xxxxxxxxx">
            @error('participantPhone')
              <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="socialMedia">Instagram</label>
            <input class="@error('socialMedia') is-invalid @enderror" id="socialMedia" name="socialMedia"
              type="socialMedia" value="{{ old('socialMedia') }}" placeholder=" mis. @digiyok">
            @error('socialMedia')
              <span class="text-danger">{{ $message }}</span>
            @enderror

          </div>

          <div class="d-flex flex-column align-items-center">
            <input type="submit" value="submit" onsubmit="return validateForm() "class="btn-submit">
          </div>
        </form>
      </div>


      @if (count($data) > 0)
        <div class="card-body">
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Sukses!</strong> {{ Session::get('success') }}
              <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
            </div>
          @endif
          @if (Session::has('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Gagal!</strong> {{ Session::get('danger') }}
              <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
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
      @endif


      @include('template.form.footer')
    </section>
  </div>
@endsection

{{-- bootstrap 5 --}}
<script src="{{ asset('vendor/bootstrap/5/js/bootstrap.bundle.min.js') }}"></script>
