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
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                {{ session('status') }}
                            </div>
                        @endif
                          <form class="m-t" role="form" method="POST" action="{{ route('admin.password.email') }}">
                            {{ csrf_field() }}
                              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                  <input type="email" name="email" class="form-control" placeholder="Email address" required>
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
@endsection
