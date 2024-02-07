@extends('template.form.master')


@section('content')
  <section class="second-forms" id="second-forms">
    <div class="row content">
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <img class="img-fluid img-icon" src={{ asset('assets/img/icon/success.png') }} alt="" height="50">
      </div>
      <div class="col-lg-6 d-flex justify-content-center flex-column align-items-center main-content">
        <div class="header">
          <img class="img-fluid img-logo" src={{ asset('img/logo/ITTS-logo.png') }} alt="">
          <h3 class="heading">Absensi Pelatihan Berhasil</h3>
          <p class="detail">Selamat <strong>{{ $data->participants->name }}</strong> Anda berhasil melakukan
            <span>verifikasi absensi</span> untuk pelatihan <span class="text-warning">{{ $getTraining->title }}</span>
          </p>
          <p>Code registrasi : <strong>{{ $data->register_code }}</strong></p>
          <p>Code sertificate : <strong>{{ $data->certificate_code }}</strong></p>
          <p>silahkan klik tombol dibawah untuk donwload sertifikatmu!</p>

          <form id="addItemForm"
            action="{{ route('home.user.certificate.create', ['certificate_code' => $data->certificate_code]) }}"
            method="post" enctype="multipart/form-data" accept-charset="utf-8">
            {{ csrf_field() }}
            <input name='register_code' type="text" value="{{ $data->certificate_code }}" hidden>
            <input class="btn-submit mt-3" type="submit" value="download sertifikat">
          </form>

          <a class="btn-submit mt-3" href="{{ route('home.user.presence') }}">kembali</a>

          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
              <strong>Sukses!</strong> {{ Session::get('success') }}
              <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
            </div>
          @endif

        </div>

      </div>
    </div>
    @include('template.form.footer')
  </section>
@endsection

{{-- bootstrap 5 --}}
<script src="{{ asset('vendor/bootstrap/5/js/bootstrap.bundle.min.js') }}"></script>
