@extends('layouts.app')

@section('content')
<!-- Page Title-->
<div class="page-title">
  <div class="container">
    <div class="column">
      <h1>Login</h1>
    </div>
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="/">Home</a></li>
        <li class="separator">&nbsp;</li>
        <li>Login</li>
      </ul>
    </div>
  </div>
</div>
<!-- Page Content-->
<div class="container padding-bottom-3x mb-2">
  <div class="row justify-content-md-center">
    <div class="col-md-7 col-xl-6">
      <form class="login-box" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="row margin-bottom-1x">
          <div class="col-xl-6 col-md-6 col-sm-6"><a class="btn btn-sm btn-block facebook-btn" href="auth/facebook"><i class="socicon-facebook"></i>&nbsp;Facebook login</a></div>
          <div class="col-xl-6 col-md-6 col-sm-6"><a class="btn btn-sm btn-block google-btn" href="auth/google"><i class="socicon-googleplus"></i>&nbsp;Google+ login</a></div>
        </div>
        <h4 class="margin-bottom-1x">Or using form below</h4>
        <div class="form-group input-group">
          <input class="form-control form-control-danger" type="email" name="email" placeholder="Email" required><span class="input-group-addon"><i class="icon-mail"></i></span>
        </div>
        <div class="form-group input-group">
          <input class="form-control" type="password" name="password" placeholder="Password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
        </div>
        @if ($errors->has('email'))
        <div class="form-group input-group {{ $errors->has('email') ? ' has-danger' : '' }}">
          <div class="form-control-feedback">{{ $errors->first('email') }}</div>
        </div>
        @endif
        <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
          <label class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><span class="custom-control-indicator"></span><span class="custom-control-description">Remember me</span>
            </label><a class="navi-link" href="{{ route('password.request') }}">Forgot password?</a>
        </div>
        <div class="text-center text-sm-right">
          <button class="btn btn-primary margin-bottom-none" type="submit">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
