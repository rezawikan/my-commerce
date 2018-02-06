@extends('admin.layouts.auth')

@section('content')
  <div class="passwordBox animated fadeInDown">
      <div class="row">

          <div class="col-md-12">
              <div class="ibox-content">

                  <h2 class="font-bold">Forgot password</h2>
                  <p>
                      Enter your email address and your password will be reset and emailed to you.
                  </p>
                  <div class="row">

                      <div class="col-lg-12">
                          <form class="m-t" role="form" method="POST" action="{{ route('admin.password.request') }}">
                            {{ csrf_field() }}

                              <input type="hidden" name="token" value="{{ $token }}">
                              
                              <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                  <input  name="email" class="form-control" placeholder="Email address" required>
                              </div>
                              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                  <input type="password" name="password" class="form-control" placeholder="Password" required>
                              </div>
                              <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                  <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                              </div>
                              @if ($errors->has('email'))
                              <div class="form-group has-error">
                                  <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                              </div>
                              @endif
                              <button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <hr/>
      <div class="row">
          <div class="col-md-6">
              Copyright Example Company
          </div>
          <div class="col-md-6 text-right">
             <small>© 2014-2015</small>
          </div>
      </div>
  </div>


{{--
      <form class="card mt-4" method="POST" action="{{ route('admin.password.request') }}">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
            <label for="email-for-pass">Email Address</label>
            <input class="form-control" type="email" id="email-for-pass" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <div class="form-group input-group {{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="form-control-feedback">{{ $errors->first('email') }}</div>
            </div>
            @endif
        </div>
        <div class="form-group">
          <label for="email-for-pass">Password</label>
          <input class="form-control" type="password" id="password" name="password" value="{{ old('password') }}" required>
      </div>

      <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
        <label for="email-for-pass">Confirm Password</label>
        <input id="password-confirm" class="form-control" type="password" id="email-for-pass" name="password_confirmation" required>
        @if ($errors->has('email'))
        <div class="form-group input-group {{ $errors->has('email') ? ' has-danger' : '' }}">
          <div class="form-control-feedback">{{ $errors->first('email') }}</div>
        </div>
        @endif --}}

{{-- </div> --}}
@endsection
