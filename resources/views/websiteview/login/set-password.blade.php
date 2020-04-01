@extends('websiteview.layout.app')
@section('title' , 'Set Password')
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
                <h1>Set Password</h1>
                
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

            

            <form method="post" name="verify" id="verify" action="{{ route('set.reset.password.save') }}" class="p-5 bg-white" style="margin-top: -150px;">
              @csrf
             

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="password">Password<i class="text-danger">*</i></label> 
                  <input type="password" id="password" name="password" class="form-control">
                </div>
              </div>
              
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="password_confirmation">Confirm Password<i class="text-danger">*</i></label> 
                  <input type="password"  id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
              </div>
              

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Submit" class="btn btn-primary btn-md text-white" style="padding: 10px 30px;">
                    
                </div>
              </div>

  
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
         $.validator.addMethod("pwcheck", function(value) {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
        });



    $('#verify').validate({
        debug: false,
        // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {

           password:{
                        required: true,
                        pwcheck: true,
                        minlength: 8
                    },
                    password_confirmation:{
                        required: true,
                        minlength: 8,
                    equalTo: "#password"
                    },
            },
        messages: {

           password: {
                        required: "Password is required.",
                        pwcheck: 'Password must be minimum 8 characters.password must contain at least 1 lowercase, 1 Uppercase, 1 numeric and 1 special character.',
                        minlength: "Please enter atleast 8 digit."
                    },
                    password_confirmation: {
                        required: "Confirm Password is password.",
                        minlength: "Password must be at least 8 characters long.",
                        equalTo: "Confirm password does not match to password."

                    },

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
