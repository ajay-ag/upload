@extends('admin.layout.auth')
@section('title','Login')
@section('content')

<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><img src="{{ $setting->logo_image }}"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your work</p>

      <form method="POST" role="form" action="{{ url('/admin/login') }}" name="loginForm" id="loginForm" data-email-url="{{ url('admin/email/check') }}">
        {{ csrf_field() }}
        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }} mb-3">
          <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>    
        </div>
            <div class="form-group">
          @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
          @endif
          </div>
        
        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }} mb-3">
          <input  id="password" type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            
        </div>
        <div class="form-group">
        @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
         @endif
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
       
      
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ url('/admin/password/reset') }}">I forgot my password</a>
      </p>
     {{--  <p class="mb-0">
        <a href="{{ url('/admin/register') }}" class="text-center">Register a new membership</a>
      </p>--}}
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection
@push('js')
<script src="{{asset('assets/admin/js/admin_auth/login-validation.js')}}" type="text/javascript"></script>
@endpush
