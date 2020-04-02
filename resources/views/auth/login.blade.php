@extends('layouts.app')

@section('title','Login')

@section('content')

  <div id="site-description" class="col">
    @include ('pages/description')
  </div>

  <div id="login-wrapper" class="col">
    <div id="login-box">
      <img class="content-center" id="logo" src="{{ asset('image/JILOGO.png') }}" alt="">
      <form method="POST" action="{{ route('login') }}">
      @csrf
        <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>
          <div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
              name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error ('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

          </div>
        </div>

        <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
          <div>
            <input id="password" type="password"
              class="form-control @error('password') is-invalid @enderror" name="password"
              required autocomplete="current-password">

          @error ('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
        </div>

        <div class="form-group" id="toolbar">
          <div class="row align-items-center">
            <div class="col-md-5">
              <button type="submit" id="submit" class="btn btn-primary">
                {{ __('Login') }}
              </button>
            </div>

            <div id="remember-me" class="form-check col">
              <div>
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                  {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
                </label>
              </div>

              @if (Route::has('password.request'))
                <div>
                  <a href="{{ route('password.request') }}">
                    {{ __('Reset password') }}
                  </a>
                </div>
              @endif
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
