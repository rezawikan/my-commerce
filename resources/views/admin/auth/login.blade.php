@extends('admin.layouts.auth')

@section('content')
  <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
          <div>

              <h1 class="logo-name">IN+</h1>

          </div>
          <h3>Welcome to IN+</h3>
          <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
              <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
          </p>
          <p>Login in. To see it in action.</p>
          <form class="m-t" role="form" method="POST" action="{{ route('admin.login') }}">
            {{ csrf_field() }}
              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
              @if ($errors->has('email'))
              <div class="form-group has-error">
                  <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
              </div>
              @endif
              {{-- @if ($errors->has('email')) --}}
              <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
              <a href="{{ route('admin.password.request') }}"><small>Forgot password?</small></a>
          </form>
          <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
      </div>
  </div>
@endsection
