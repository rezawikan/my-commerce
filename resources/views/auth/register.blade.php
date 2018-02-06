@extends('layouts.app') @section('content')
<!-- Page Title-->
<div class="page-title">
  <div class="container">
    <div class="column">
      <h1>Register</h1>
    </div>
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="/">Home</a></li>
        <li class="separator">&nbsp;</li>
        <li>Register</li>
      </ul>
    </div>
  </div>
</div>
<!-- Page Content-->
<div class="container padding-bottom-3x mb-2">
  <div class="row justify-content-md-center">
    <div class="col-md-10 col-xl-10">
      <form class="login-box" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="row margin-bottom-1x">
          <div class="col-xl-6 col-md-6 col-sm-6"><a class="btn btn-sm btn-block facebook-btn" href="auth/facebook"><i class="socicon-facebook"></i>&nbsp;Facebook</a></div>
          <div class="col-xl-6 col-md-6 col-sm-6"><a class="btn btn-sm btn-block google-btn" href="auth/google"><i class="socicon-googleplus"></i>&nbsp;Google+</a></div>
        </div>
        <h3 class="margin-bottom-1x">No Account? Register</h3>
        <p>Registration takes less than a minute but gives you full control over your orders.</p>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
              <label for="name">Name</label>
              <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
              @if ($errors->has('name'))
                <div class="form-control-feedback">{{ $errors->first('name') }}</div>
              @endif
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
              <label for="email">Email</label>
              <input class="form-control" type="text" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
              @endif
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" type="password" name="password" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
              <label for="password-confirm">Confirm Password</label>
              <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
              @if ($errors->has('password'))
                <div class="form-control-feedback">{{ $errors->first('password') }}</div>
              @endif
            </div>
          </div>
        </div>
        <div class="text-center text-sm-right">
          <button class="btn btn-primary margin-bottom-none" type="submit">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
