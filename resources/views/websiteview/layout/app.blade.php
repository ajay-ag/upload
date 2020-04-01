<!--
////////////////////////////////////////////////////////////////

Author: Free-Template.co
Author URL: http://free-template.co.
License: https://creativecommons.org/licenses/by/3.0/
License URL: https://creativecommons.org/licenses/by/3.0/
Site License URL: https://free-template.co/template-license/

Website:  https://free-template.co
Facebook: https://www.facebook.com/FreeDashTemplate.co
Twitter:  https://twitter.com/Free_Templateco
RSS Feed: https://feeds.feedburner.com/Free-templateco

////////////////////////////////////////////////////////////////
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title') | City Post</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />

    <link rel="shortcut icon" href="ftco-32x32.png">

    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/website/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/website/fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/website/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/rangeslider.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/product_slider.css') }}">
    <link href="{{asset('assets/website/js/tost/build/toastr.css')}}" rel="stylesheet" type="text/css"/>
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <link href="https://fonts.googleapis.com/css?family=Mukta+Vaani:400,500&amp;subset=gujarati" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900">


    @yield('css')
   <style type="text/css">
   .site-footer {
         padding: 3em 0;
      }
   </style>

  </head>
  <body>
  <!-- Menu -->
    @include('websiteview.layout.header')
  <!-- End -->

  <!-- site-blocks -->

  <!-- end -->
            @yield('site-block')


     <!-- Popular Catgeory -->
            @yield('category')


            @yield('how_it_work')


     <!-- end -->
            @yield('content')







    <div class="py-5 bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mr-auto mb-4 mb-lg-0">
            <h2 class="mb-3 mt-0 text-white">Let's get started. @if(!Auth::user()) Create your account @endif</h2>
            <p class="mb-0 text-white">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
          @if(!Auth::user())
          <div class="col-lg-4">
            <p class="mb-0"><a href="{{ url('register')}}" class="btn btn-outline-white text-white btn-md px-5 font-weight-bold btn-md-block">Sign Up</a></p>
          </div>
          @endif
        </div>
      </div>
    </div>

    @include('websiteview.layout.footer')
  </div>

  <script src="{{ asset('assets/website/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/jquery-ui.js')}}"></script>
  <script src="{{ asset('assets/website/js/popper.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/jquery.stellar.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/jquery.countdown.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/aos.js')}}"></script>
  <script src="{{ asset('assets/website/js/rangeslider.min.js')}}"></script>
  <script src="{{ asset('assets/website/js/typed.js')}}"></script>
  <script src="{{ asset('assets/website/js/main.js')}}"></script>
  <script type="text/javascript" src="{{ asset('assets/website/js/tost/build/toastr.min.js')}}"></script>

@yield('js')
  @if (session('success'))
    <script type="text/javascript">
        toastr.success('{{ Session::get('success') }}', 'Success');
    </script>
@endif

@if (session('danger'))
    <script type="text/javascript">
        toastr.error('{{ Session::get('danger') }}', 'Error');
    </script>
@endif

  </body>
</html>
