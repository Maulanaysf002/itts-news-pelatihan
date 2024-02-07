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
          <h3 class="heading">Pendaftaran Berhasil</h3>
          @foreach ($data as $d)
            <p class="detail">Selamat <strong>{{ $d->participants->name }}</strong> Anda berhasil melakukan pendaftaran
          @endforeach
          pada
          pelatihan
          @foreach ($training as $t)
            <span class="text-warning">{{ $t->training->title }}</span>
          @endforeach yang akan diselenggarakan pada tanggal
          <strong>{{ date('d-m-Y', strtotime($t->training->t_date)) }}</strong>
          </p>
          @foreach ($training as $t)
            <p>Kode Registrasi : <strong>{{ $t->register_code }}</strong></p>
            <p>Link Zoom : <strong>{{ $t->training->meet_link }}</strong></p>
          @endforeach

          {{-- <p>{{ $training }}</p> --}}

          <p class="detail text-danger"><strong>SIMPAN ATAU SCREENNSHOT HALAMAN INI UNTUK MENDAPATKAN
              SERTIFIKAT</strong></p>

          <a class="btn-submit mt-3" href="{{ route('home.user.register.index') }}">Kembali ke Halaman Awal</a>

        </div>

      </div>
    </div>
    @include('template.form.footer')
  </section>
@endsection

{{-- bootstrap 5 --}}
<script src="{{ asset('vendor/bootstrap/5/js/bootstrap.bundle.min.js') }}"></script>
