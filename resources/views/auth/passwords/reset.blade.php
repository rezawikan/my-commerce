@extends('layouts.app')

@section('content')
<!-- Page Title-->
<div class="page-title">
  <div class="container">
    <div class="column">
      <h1>Password Reset</h1>
    </div>
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="/">Home</a>
        </li>
        <li class="separator">&nbsp;</li>
        <li>Password Reset</li>
      </ul>
    </div>
  </div>
</div>

<!-- Page Content-->
<div class="container padding-bottom-3x mb-2">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <h2>Forgot your password?</h2>
      <p>Change your password in three easy steps. This helps to keep your new password secure.</p>
      <ol class="list-unstyled">
        <li><span class="text-primary text-medium">1. </span>Fill in your email address below.</li>
        <li><span class="text-primary text-medium">2. </span>We'll email you a temporary code.</li>
        <li><span class="text-primary text-medium">3. </span>Use the code to change your password on our secure website.</li>
      </ol>
      @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Success alert:</strong> {{ session('status') }}</div>
      @endif

      <form class="card mt-4" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
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
        @if ($errors->has('password'))
        <div class="form-group input-group {{ $errors->has('password') ? ' has-danger' : '' }}">
          <div class="form-control-feedback">{{ $errors->first('password') }}</div>
        </div>
        @endif
    </div>
      </div>
        <div class="card-footer">
          <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
