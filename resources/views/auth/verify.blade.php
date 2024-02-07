@extends('template.login.master')

@section('title')
  Verifikasi Email Anda
@endsection

@section('content')
  <div class="container">

    <div class="container">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Verifikasi Email Anda</h1>
                </div>
                @if (session('resent'))
                  <div class="alert alert-success" role="alert">
                    Tautan verifikasi baru sudah dikirim ke alamat email Anda
                  </div>
                @endif

                Sebelum lanjut, mohon periksa tautan verifikasi di email Anda
                Jika tidak ada email masuk,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                  @csrf
                  <button class="btn btn-link btn-brand-green-dark p-0 m-0 align-baseline" type="submit">Klik di sini
                    untuk kirim ulang</button>.
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
