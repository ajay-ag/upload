@extends('admin.layout.auth')
@section('title','Forgot Password')
<!-- Main Content -->
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><img src="{{ $setting->logo_image }}"></a>
  </div>
  <!-- /.login-logo -->
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
  <div class="card">
                        
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form role="form" method="POST" action="{{ url('/admin/password/email') }}" id="forgotForm" name="forgotForm"  data-email-url="{{ url('admin/email/check') }}">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
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
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
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
<script src="{{asset('assets/admin/js/admin_auth/forgot-validation.js')}}" type="text/javascript"></script>
@endpush
