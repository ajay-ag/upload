@extends('websiteview.layout.app')
@section('title' , 'Reset Password')
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
                <h1>Reset Password</h1>
                
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

            

            <form method="post" name="verify" id="verify" action="{{ route('users.reset.forgotUser') }}" class="p-5 bg-white" style="margin-top: -150px;">
             @csrf

              

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="mobile">Mobile No.<i class="text-danger">*</i></label> 
                  <input type="text" id="mobile" name="mobile" class="form-control">
                </div>
              </div>

          
              
              

              <div class="row form-group">
                <div class="col-md-6">
                  <input type="submit" value="Submit" class="btn btn-primary btn-md text-white" style="padding: 10px 30px;">
                  <label class="text-black ml-3" for="pass1"><a href="{{ url('login') }}">Sign In</a></label>

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
@section('js')
<script src="{{ asset('assets/website/js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('assets/website/js/jquery-validation/dist/additional-methods.js')}}"></script>


      <script type="text/javascript">


    $('#verify').validate({
        debug: false,
        // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {

           mobile: {
                required: true,
                }
            },
        messages: {

          mobile: {
                 required: "Mobile no is required.",
                }

        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent()).addClass('text-danger');
            if(element.parent('.input-group').length)
                {
                    error.insertAfter(element.parent());
                }
        },
        submitHandler: function (e) {
          $(".verify_btn").addClass('fa fa-spinner fa-spin');
            return true;
        }
    })

    </script>

     @endsection
