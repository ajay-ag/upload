@extends('websiteview.layout.app')
@section('title',$title)
@section('site-block')
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('storage/staticpages/banner_image/'.$static_page->banner_image) }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>{!!$static_page->title ?? '' !!}</h1>
                
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  


@endsection
@section('content')

    <div class="site-section "  data-aos="fade">
      <div class="container">
      {{--   <div class="row mb-5">
          <div class="col-md-12" >
            <h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
          </div>
        </div>--}}
        
        <div class="row mb-5">
          <div class="col-md-12 ml-auto">
            <p>{!!$static_page->description ?? '' !!}</p>
          </div>
         
        </div>

       

      </div>
    </div>


@endsection
