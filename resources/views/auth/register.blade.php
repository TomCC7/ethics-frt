<div class="modal fade" id="register-dialog" tabindex="-1" role="dialog" aria-labelledby="register-dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">{{ __('Register') }}
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="modal-body">

          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

            <div class="col-md-6">
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

            <div class="col-md-6">
                <input id="first_name" type="text"
                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                    value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
              <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

              <div class="col-md-6">
                  <input id="last_name" type="text"
                      class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                      value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                  @error('last_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="section_number" class="col-md-4 col-form-label text-md-right">
                  Section Number</label>

              <div class="col-md-6">
                  <input id="section_number" type="number" min="1"
                      class="form-control @error('section_number') is-invalid @enderror"
                      name="section_number" value="{{ old('section_number') }}" required
                      autocomplete="section_number" autofocus>

                  @error('section_number')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="semester" class="col-md-4 col-form-label text-md-right">Semester</label>

              <div class="col-md-6">
                  <select id="semester" class="form-control" name="semester">
                      <option value="19FA">19FA</option>
                      <option value="20SU">20SU</option>
                  </select>
              </div>
          </div>

          <div class="form-group row">
              <label for="student_id" class="col-md-4 col-form-label text-md-right">Student ID</label>

              <div class="col-md-6">
                  <input id="student_id" type="text"
                      class="form-control @error('student_id') is-invalid @enderror" name="student_id"
                      value="{{ old('student_id') }}" required autocomplete="student_id" autofocus>

                  @error('student_id')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="email"
                  class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                      name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="password"
                  class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                  <input id="password" type="password"
                      class="form-control @error('password') is-invalid @enderror" name="password"
                      required autocomplete="new-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control"
                      name="password_confirmation" required autocomplete="new-password">
              </div>
          </div>

          {{-- Captcha --}}
          <div class="form-group row">
              <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>

              <div class="col-md-6">
                  <input id="captcha" name="captcha"
                      class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" required>

                  <img class="thumbnail captcha mt-3 mb-2" src="/captcha/flat?'+Math.random()"
                      onclick="this.src='/captcha/flat?'+Math.random()"
                      title="Click to change the captcha">

                  @if ($errors->has('captcha'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('captcha') }}</strong>
                  </span>
                  @endif
              </div>
          </div>
        </div>

        <div class="modal-footer">
          <div class="form-group row mb-0">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
