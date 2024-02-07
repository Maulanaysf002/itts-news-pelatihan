@extends('template.login.master')

@section('title')
  Lupa Sandi
@endsection

@section('content')
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                  @endif
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Lupa Sandi?</h1>
                    <p class="mb-4">Kami tahu, sesuatu terjadi. Cukup masukkan alamat email Anda dan kami akan
                      mengirimkan tautan untuk mereset sandi Anda!</p>
                  </div>
                  <form class="user" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                      <input class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                        name="email" type="email" value="{{ old('email') }}" aria-describedby="emailHelp" required
                        autocomplete="email" autofocus placeholder="Masukkan alamat email...">
                      @error('email')
                        <span class="invalid-feedback text-center" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <button class="btn  btn-brand-green-dark btn-user btn-block" type="submit">
                      Kirim Tautan Reset Sandi
                    </button>
                  </form>
                  <hr>
                  @if (Route::has('register'))
                    @if ($users < 1)
                      <div class="text-center">
                        <a class="text-brand-green-dark small" href="{{ route('register') }}">Buat Akun!</a>
                      </div>
                    @endif
                  @endif
                  @if (Route::has('login'))
                    <div class="text-center">
                      <a class="text-brand-green-dark small" href="{{ route('login') }}">Sudah punya akun? Masuk!</a>
                    </div>
                  @endif
                  <div class="text-center">
                    <h1 class="h6 mt-4 text-gray-900 mb-4">Powered by <a href="https://digiyok.com"
                        target="_blank">Digiyok</a></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  </div>
@endsection
