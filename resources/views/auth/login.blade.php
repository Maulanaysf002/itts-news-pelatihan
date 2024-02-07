@extends('template.login.master')

@section('title')
  Masuk
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
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ Session::get('success') }}
                      <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  @if (Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ Session::get('danger') }}
                      <button class="close" data-dismiss="alert" type="button" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                      <input class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                        name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                        autofocusaria-describedby="emailHelp" placeholder="Masukkan Alamat Email...">
                      @error('email')
                        <span class="invalid-feedback text-center" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user @error('password') is-invalid @enderror" id="password"
                        name="password" type="password" placeholder="Sandi" required autocomplete="current-password">
                      @error('password')
                        <span class="invalid-feedback text-center" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input class="custom-control-input" id="remember" name="remember" type="checkbox"
                          {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Ingat Saya</label>
                      </div>
                    </div>
                    <button class="btn btn-brand-green-dark btn-user btn-block" type="submit">
                      Masuk
                    </button>
                  </form>
                  <hr>
                  @if (Route::has('password.request'))
                    <div class="text-center">
                      <a class="text-brand-green-dark small" href="{{ route('password.request') }}">Lupa Sandi?</a>
                    </div>
                  @endif
                  @if (Route::has('register'))
                    @if ($users < 1)
                      <div class="text-center">
                        <a class="text-brand-green-dark small" href="{{ route('register') }}">Buat Akun!</a>
                      </div>
                    @endif
                  @endif
                  {{-- <div class="text-center">
                    <a class="text-brand-green-dark small" href="{{ route('home') }}">Kembali</a>
                  </div> --}}
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
@endsection
