@extends('template.form.master')

@section('heademta')
@endsection

@section('content')
  <section class="second-forms" id="second-forms">
    <div class="row content">
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <img class="img-fluid img-icon" src={{ asset('assets/img/icon/agenda.png') }} alt="">
      </div>
      <div class="col-lg-6 d-flex justify-content-center flex-column align-items-center main-content">
        <div class="header">
          <img class="img-fluid img-logo" src={{ asset('img/logo/ITTS-logo.png') }} alt="">
          <h3 class="heading">Absensi Pelatihan</h3>
          <p class="detail">Setelah Digifren Mendaftar, Digifren harus mengisi absensi sesuai dengan kode
            <span>verifikasi absensi</span> yang
            telah diberikan didalam webbinar
            temen-temen Digifren
          </p>
        </div>

        <form id="addItemForm" action="{{ route('home.user.presence.submit') }}" method="post"
          enctype="multipart/form-data" accept-charset="utf-8">
          {{ csrf_field() }}
          <input name='register_code' type="text" placeholder="Masukkan Kode registrasi" class="form-control">
          <input class="mt-3 form-control" name='training_code' type="text" placeholder="Masukkan Kode pelatihan">

          <div class="d-flex justify-content-center">
            <input class="btn-submit mt-3" type="submit" value="submit">
          </div>
        </form>

        @if (Session::has('danger'))
          <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <strong>Gagal!</strong> {{ Session::get('danger') }}
            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
          </div>
        @endif

      </div>
    </div>
    @include('template.form.footer')
  </section>
@endsection

{{-- bootstrap 5 --}}
<script src="{{ asset('vendor/bootstrap/5/js/bootstrap.bundle.min.js') }}"></script>
