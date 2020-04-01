@extends('websiteview.layout.app')
@section('title' , 'Login')
@section('css')
<style type="text/css">
.error{
  margin: 0px 0px 0px 0px;
} 
 
</style>
@endsection
@section('site-block')
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('assets/website/images/hero_1.jpg')}});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>Login</h1>
                
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  


@endsection
@section('content')
     <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-md-center">
         
          <div class="col-md-6 mb-5">

            

            <form  method="post"  class="p-5 bg-white" name="login" id="login" action="{{ route('users.login') }}" style="margin-top: -150px;">
             @csrf

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Mobile No.<i class="text-danger">*</i></label> 
                  <input type="text" id="mobile" name="mobile" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="pass1">Password<i class="text-danger">*</i></label> 
                  <input type="password" id="password"
                                               
                                                name="password" class="form-control">
                </div>
              </div>
              
              

              <div class="row form-group">
                <div class="col-md-6">
                  <input type="submit" value="Log In" class="btn btn-primary btn-md text-white" style="padding: 10px 30px;">
                    <!-- <i class="login_btn" aria-hidden="true"></i> -->
                </div>
                <div class="col-md-6">
                  <label class="text-black mt-3" for="pass1"><a href="{{ url('reset-password') }}"> Forgot Your Password ?</a></label>

                </div>
              </div>

           {{--     <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fa fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fa fa-facebook-f mr-2"></i> Sign in with Facebook</button>--}} 
            </form>
          </div>
        </div>
      </div>
    </div>


@endsection
@section('css')
<style type="text/css">
.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}
</style>
@endsection
@section('js')
<script src="{{ asset('assets/website/js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('assets/website/js/jquery-validation/dist/additional-methods.js')}}"></script>


    <script type="text/javascript">


        $('#login').validate({
            debug: false,
            // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {
                mobile: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {

                // mobile: {
                //     required: "Mobile no is required.",
                // },
                // password: {
                //     required: "Password is required.",
                // }

            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger');
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                }
            },
            submitHandler: function (e) {
                $(".login_btn").addClass('fa fa-spinner fa-spin');
                return true;
            }
        })

    </script>

@endsection
