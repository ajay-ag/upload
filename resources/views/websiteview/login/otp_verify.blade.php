@extends('websiteview.layout.app')
@section('title' , 'OTP Verify')
@section('css')

@endsection
@section('site-block')
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('assets/website/images/hero_1.jpg')}});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>OTP Verify</h1>
                
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



            <form  method="post"  class="p-5 bg-white" n name="verify" id="verify"
            action="{{ route('users.otp.verify.now') }}" style="margin-top: -150px;">
            @csrf

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">OTP Verify</label> 
                  <input type="text" id="otp" name="otp" class="form-control">
                </div>
              </div>

             
              
              

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Verify" class="btn btn-primary btn-md text-white" style="padding: 10px 30px;">
                  <label class="text-black ml-4" for="pass1"><a class="resend-otp-click" href="#">Resend OTP?</a></label>
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

        function ajaxindicatorstart(text) {
            if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
                jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src=""><div>' + text + '</div></div><div class="bg"></div></div>');
            }
            jQuery('#resultLoading').css({
                'width': '100%',
                'height': '100%',
                'position': 'fixed',
                'z-index': '10000000',
                'top': '0',
                'left': '0',
                'right': '0',
                'bottom': '0',
                'margin': 'auto'
            });

            jQuery('#resultLoading .bg').css({
                'background': '#000000',
                'opacity': '0.7',
                'width': '100%',
                'height': '100%',
                'position': 'absolute',
                'top': '0'
            });

            jQuery('#resultLoading>div:first').css({
                'width': '250px',
                'height': '75px',
                'text-align': 'center',
                'position': 'fixed',
                'top': '0',
                'left': '0',
                'right': '0',
                'bottom': '0',
                'margin': 'auto',
                'font-size': '16px',
                'z-index': '10',
                'color': '#ffffff'

            });

            jQuery('#resultLoading .bg').height('100%');
            jQuery('#resultLoading').fadeIn(300);
            jQuery('body').css('cursor', 'wait');
        }


        function ajaxindicatorstop() {
            jQuery('#resultLoading .bg').height('100%');
            jQuery('#resultLoading').fadeOut(300);
            jQuery('body').css('cursor', 'default');
        }


        $('.resend-otp-click').on('click', function (e) {
            ajaxindicatorstart('loading please wait..');
            e.preventDefault();
            var el = $(this);
            $.ajax({
                url: "{{ route('users.otp.resend') }}",
                method: 'GET',
            })
                .done(function (res) {

                    ajaxindicatorstop();
                    toastr.remove();
                    toastr.success(res.message, 'Success');

                    // $('#show_message').html(' ');
                    // $('#show_message').html('<div class="alert mb-3 alert-success alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button><strong>Sucecss</strong><p class="m-0">' + res.message + '</div>')

                })
                .fail(function (res) {

                    ajaxindicatorstop();

                    if (res.status == 429) {
                        // alert("Wait for a few minims");
                        toastr.remove();
                        toastr.error("Wait for a few minims", 'Error');

                        // $('#show_message').html(' ');
                        // $('#show_message').html('<div class="alert mb-3 alert-warning alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button><strong>Warning</strong><p class="m-0">' + res.responseJSON.message + ' Wait for a few minims </div>')
                    }

                });


        });


        $('#verify').validate({
            debug: false,
            // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {

                otp: {
                    required: true,
                }
            },
            messages: {

                otp: {
                    required: "OTP is required.",
                }

            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger');
                if (element.parent('.input-group').length) {
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
