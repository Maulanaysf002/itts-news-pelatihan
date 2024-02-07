@extends('template.login.master')

@section('title')
  Daftar Akun
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
                  <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                </div>
                <form class="user" method="POST" action="{{ route('register') }}">
                  @csrf

                  <div class="form-group">
                    <input class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                      name="name" type="text" value="{{ old('name') }}" required autocomplete="name" autofocus
                      placeholder="Nama Anda">
                    @error('name')
                      <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                      name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                      placeholder="Email Address">
                    @error('email')
                      <span class="invalid-feedback text-center" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input class="form-control form-control-user @error('password') is-invalid @enderror" id="password"
                        name="password" type="password" required autocomplete="new-password" minlength="8"
                        placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <input class="form-control form-control-user" id="password-confirm" name="password_confirmation"
                        type="password" required autocomplete="new-password" minlength="8" placeholder="Ulangi Sandi">
                    </div>
                    @error('password')
                      <div class="col-12">
                        <span class="invalid-feedback text-center" role="alert" style="display:block">
                          <strong>{{ $message }}</strong>
                        </span>
                      </div>
                    @enderror
                  </div>
                  <button class="btn btn-brand-green-dark btn-user btn-block" type="submit">
                    Daftar Akun
                  </button>
                </form>
                <hr>
                @if (Route::has('password.request'))
                  <div class="text-center">
                    <a class="text-brand-green-dark small" href="{{ route('password.request') }}">Lupa Sandi?</a>
                  </div>
                @endif
                @if (Route::has('login'))
                  <div class="text-center">
                    <a class="text-brand-green-dark small" href="{{ route('login') }}">Sudah punya akun? Masuk!</a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
