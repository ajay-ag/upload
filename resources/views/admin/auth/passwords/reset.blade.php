@extends('admin.layout.auth')
@section('title','Reset Password')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><img src="{{ $setting->logo_image }}"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form role="form" method="POST" action="{{ url('/admin/password/reset') }}" id="resetForm" name="resetForm" data-email-url="{{ url('admin/email/check') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
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
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}  mb-3">
          <input id="password" type="password" class="form-control" name="password" placeholder="Password">
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

        <div class="input-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} mb-3">
          <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="form-group">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ url('/admin') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection

@push('js')
<script src="{{asset('assets/admin/js/admin_auth/reset-validation.js')}}" type="text/javascript"></script>
@endpush
