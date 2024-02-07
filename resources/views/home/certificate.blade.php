@extends('template.form.master')


@section('content')
  <section class="second-forms" id="second-forms">
    <div class="row content">
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <img class="img-fluid img-icon" src={{ asset('assets/img/icon/badges.png') }} alt="">
      </div>
      <div class="col-lg-6 d-flex justify-content-center flex-column align-items-center main-content">
        <div class="header">
          <img class="img-fluid img-logo" src={{ asset('img/logo/ITTS-logo.png') }} alt="">
          <h3 class="heading">Penerimaan Sertifikat</h3>
          <p class="detail">Masukan <span>Kode Sertifikat</span> yang Didapatkan Setelah Melakukan Absensi
          </p>
        </div>

        <form id="addItemForm" action="{{ route('home.user.certificate.submit') }}" method="post"
          enctype="multipart/form-data" accept-charset="utf-8">
          {{ csrf_field() }}
          <input class="form-control" name='certificate_code' type="text" placeholder="Masukkan Kode Sertifikat">

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
