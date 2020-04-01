@extends('websiteview.layout.app')
@section('title',@$title)
@section('site-block')
  
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('storage/staticpages/banner_image/'.$categories_main->banner_image)}});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>{{ $categories_main->title ?? ''}}</h1>
               <!--  <p data-aos="fade-up" data-aos-delay="100">Handcrafted free templates by</p> -->
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div> 

@endsection
@section('content')
     <div class="site-section bg-white">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Popular Categories</h2>
           <!--  <p class="color-black-opacity-5">Start Exploring With Our.</p> -->
          </div>
        </div>
        <div class="row justify-content-center">

          

          <div class="col-md-8">
            <div class="mb-5">
           
              <form method="get" action="{{route('advertise')}}">
                <div class="input-group mb-3">
                <input type="text"  id="tilte" name="title" required class="form-control bg-transparent" placeholder="What are you looking for ?" aria-label="What are you looking for ?" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="submit" id="button-addon2">Search Now</button>
                </div>
              </div>
              </form>
            </div>

           

          </div>
        
          
        </div>
        <div class="row justify-content-center">
          @foreach($category as $cat_key =>$item_category)
            @foreach($item_category as $item_key =>$cat_item_value)
                @if ($cat_item_value->post_cat_count_count > 0)
                    
                  <div class="col-lg-2 col-md-6 col-sm-6  mb-lg-0 mb-5"> 
                <!-- Icon Block --> 
                    <a class="d-block card-frame bg-white text-center rounded py-7 px-5" href="{{route('advertise')}}/category/{{$cat_item_value['slug']}}"><i class="d-block max-width-12 mx-auto mb-4 {{$cat_item_value->icon_name}} fa-3x"></i>
                    <h6 class="h6 text-dark mb-0" style="font-size: 0.80rem;">{{ Str::limit($cat_item_value->name,15,'')}}</h6>
                    </a> 
                    <!-- End Icon Block --> 
                    <br/>
                </div>  
                
                @endif
              @endforeach
          @endforeach
       </div>
          
         
         
         {{--  <div class="row justify-content-center">
          @foreach($category as $cat_key =>$item_category)
                        <div class="col-md-6 col-xl-4">
                            @foreach($item_category as $item_key =>$cat_item_value)
                                <div class="ps-categories-details__content">

                                    <!-- <figure><img src="{{$cat_item_value->category_thumb}}" alt="Image Description">
                                    </figure> -->
                                    <h6 style="width:300px">{{$cat_item_value->name}}</h6>
                                </div>
                                <ul class="ps-categories-details__content_ul">
                                    @if(isset($sub_category[$cat_item_value->id]))
                                        @foreach($sub_category[$cat_item_value->id] as $subc_key =>$subcat_item)
                                            <li>
                                                <a href="{{route('advertise')}}/sub-category/{{$subcat_item['slug']}}">{{$subcat_item['name']}}
                                                    <span>({{$subcat_item['post_count']}})</span></a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            @endforeach
                        </div>
                    @endforeach
                    </div> --}}
        


      </div>
    </div>   
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani:400,500&amp;subset=gujarati" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/website/css/common.css') }}">
<style type="text/css">
/*.ps-categories-details__content {
    display: flex;
    text-align: start;
}
.ps-categories-details__content h6 {
    align-self: center;
    margin: -19px 50px 0 20px;
}
.ps-categories-details__content_ul li a:before {
    content: "";
    height: 4px;
    width: 4px;
    position: absolute;
    background: #eee;
    left: -14px;
    bottom: 0;
    top: 9px;
    border-radius: 50%;
}

h6 {
    color: #333333;
    margin: 0;
    font-weight: 600;
    font-family: "Mukta Vaani", sans-serif;
}
.ps-categories-details__content_ul  {
    text-align: start;
    border-left: 1px solid #eee;
    margin-left: 33px;
    padding: 13px 0 28px 12px;
}

ul {
    margin: 0;
    list-style-type: none;
    padding: 0;
}
.ps-categories-details__content_ul  li a {
    display: flex;
    justify-content: space-between;
    color: #767676;
    font: 400 1rem/1.5em "Mukta Vaani", sans-serif;
}
.ps-categories-details__content_ul li a:hover {
    color: #f38181!important;
}*/

/* Card Frame */

</style>
@endsection
