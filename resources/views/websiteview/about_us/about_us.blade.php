@extends('websiteview.layout.app')
@section('title' , 'About US')
@section('site-block')
  
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('assets/website/images/hero_1.jpg')}});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>{!! $about->title ?? '' !!}</h1>
               <!--  <p data-aos="fade-up" data-aos-delay="100">Handcrafted free templates by</p> -->
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div> 

@endsection
@section('content')
    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <img src="{{asset('storage/staticpages/banner_image/'.$about->banner_image) }}" alt="" class="img-fluid rounded">
          </div>

          <div class="col-md-5 ml-auto">
           {{--  <h2 class="text-primary mb-3">{!! $about->title ?? '' !!}</h2>--}}
            <p>{!! $about->description ?? '' !!}</p>
            
          </div>
        </div>
      </div>
    </div>

 @endsection
