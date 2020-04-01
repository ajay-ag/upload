@extends('websiteview.layout.app')

@section('title',$advertise_detail->title)
@section('site-block')

<div class="site-blocks-cover inner-page-cover" style="background-image: url();" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <!-- <h1>Categories Details</h1> -->
               <!--  <p data-aos="fade-up" data-aos-delay="100">Handcrafted free templates by</p> -->
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<link href="{{asset('assets/website/css/js/swiper.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{asset('assets/website/css/list-detail-common.css') }}" type="text/css" rel="stylesheet" />




@endsection

@php  $user_detail=Helper::getUserDetail($advertise_detail->user_id); @endphp
    @php  $static_page=Helper::getStaticpage(7); @endphp


    @php
        $related_scroll=0;
    @endphp
@section('content')

   <div class="py-4 bg-gray">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mr-auto mb-4 mb-lg-0">
            <h5 class="mb-3 mt-0 text-dark">{{ $advertise_detail->title }}</h5>
            <div class="classi-single_info">
             <span class="date"><i class="far fa-clock"></i> {{ date('M d, Y',strtotime($advertise_detail->publish_date))}}</span> <span class="item-location ml-2"><i class="fa fa-map-marker"></i> {{$advertise_detail->city_name}}, {{$advertise_detail->state_name}} </span>
            </div>
          </div>

        </div>
      </div>
    </div>
<div class="site-section bg-white adsDetails">
  <div class="container">


    <div class="row">

      <div class="col-lg-8 col-md-8 col-sm-8 page-details bg-gray">

        <div class="sinbanner-image">
          <div class="singleban">
            <div class="singleban_main">
              <div id="owl-1" class="owl-carousel owl-theme">

                @if($advertise_images->isEmpty())
               <img src="{{asset('storage/default/no-image-post.png')}}" alt="" class="image">
                @endif
                @foreach($advertise_images as $adkey => $advertise_images_val_large)

                <div class="item">
                  <img src="{{ $advertise_images_val_large->post_image_name }}" alt="" class="image">
                </div>

                @endforeach


              </div>
              <div id="owl-2" class="owl-carousel owl-theme">
                @foreach($advertise_images as $adkey => $advertise_images_val)
                <div class="item">
                  <img src="{{$advertise_images_val->post_image_name}}" alt="" class="image" width="138" height="74">
                </div>
                @endforeach

              </div>
            </div>
          </div>
        </div>

        <div class="single-page-details">
          <h5 class="Detsils-title"><strong>Description</strong></h5>
          <div class="row">
            <div class="sindetails-info col-md-12">
              <p style="white-space: pre-line;">{{ $advertise_detail->description }} </p>
            </div>

          </div>
          @if(isset($advertise_attribute) && count($advertise_attribute))
              <div class="widget" id="pills-profile" >
                <h6 class="tab-title">Features</h6>
                <table class="table table-bordered product-table">
                  <tbody>
                    @foreach($advertise_attribute as $att_key =>$attribute_value)

                    <tr>
                      <td><b>{{$attribute_value->field_name}}</b></td>
                      <td>{{$attribute_value->field_value}}</td>
                    </tr>

                    @endforeach

                  </tbody>
                </table>
              </div>
              @endif

        </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12">

            <div class=" mb-3 bg-gray">
              <div class="shot-info">
                <ul>
                  <li> <i class="far fa-money-bill-alt"></i>

                    <strong>Price:</strong>
                    <br><h4> {!! Helper::commonMoneyFormat($advertise_detail->price) !!} </h4>
                  </li>
                  {{-- <li> <i class="fa fa-toggle-off" aria-hidden="true"></i> <strong>Categories:</strong> {{ $advertise_detail->category }} </li> --}}
                </ul>
              </div>
            </div>


            <div class="p-4 mb-3 bg-gray">
                <div class="seller-heading text-capitalize">About Seller</div>
               <div class="contact-seller">
                <div class="seller-details ">
                  <div class="text-center">
                    <img src="{{$user_image ?? ''}}" height="50" width="50" class="mb-3 mx-auto">
                  </div>
                  <p><i class="fas fa-user"></i> {{$user_detail->name ? $user_detail->name:'City Post User'}}</p>
                 {{--  <p><i class="fa fa-map-marker" aria-hidden="true"></i> Location:  </p>--}}
                  <p><i class="fas fa-microphone"></i> Member Since: {{date('M d, Y',strtotime($user_detail->created_at))}}</p>
                </div>

                <div class="seller_message">
                  <a class="btn  btn-info btn-block">Mobile No.</i>  {{substr($user_detail->mobile,0,5)}}XXXX</a>
                  <a  href="{{route('advertise-filter')}}?user_id={{$user_detail->user_id}}" class="btn  btn-info btn-block">View All Posts</a>

                  @if(!$hisPost)
                    <a href="{{ route('messages.create' ,  $user_detail->user_id) }}" class="btn  btn-info btn-block">Chat</a>
                  @endif

                </div>
              </div>
            </div>

           @if(Auth::check())
                            @if(Auth::user()->id != $user_detail->user_id)

            <div class="p-4 mb-3 bg-gray">
              <div class="seller-heading mb-2">Contact Seller</div>
               <form id="contactsellerForm" name="contactsellerForm"
                                      action="{{ route('contact-seller') }}"
                                      method="post">
                                    @csrf
                                    <div class="ps-gridList__searchArea ps-contact-seller">


                                            <div class="form-group">
                                                <input type="text" name="txt_name" id="txt_name" class="form-control"
                                                      placeholder="Your Name *" required="">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="txt_email" id="txt_email"
                                                       class="form-control" required="" placeholder="Your Email *">
                                            </div>
                                            <div class="form-group">
                                        <textarea class="form-control" required="" id="description" name="description"
                                                  placeholder="Enter Comment *"></textarea>
                                            </div>
                                            <!-- <button class="btn ps-btn">Send Now</button> -->
                                            <input type="hidden" id="user_email" name="user_email"
                                                   value="{{$user_detail->user_email}}">

                                            <input type="hidden" name="advertise_name" id="advertise_name"
                                                   value="{{$advertise_detail->title}}">
                                            <input type="hidden" name="post_id" id="post_id"
                                                   value="{{$advertise_detail->id}}">
                                            <input value="Send Now" id="btn_submit" class="btn btn-primary c-button" style="color: white;padding: 8px;" name="btn_submit"
                                                   type="submit">
                                            <input type="hidden" name="redirect_url"
                                                   value="{{ route('advertise-detail').'/'.$advertise_detail->slug}}">

                                    </div>
                                </form>
            </div>

          @endif

          @else

            <div class="p-4 mb-3 bg-gray">
              <div class="seller-heading mb-2">Contact Seller</div>
               <form id="contactsellerForm" name="contactsellerForm"
                                  action="{{ route('contact-seller') }}"
                                  method="post">
                                @csrf
                                <div class="ps-gridList__searchArea ps-contact-seller">


                                        <div class="form-group">
                                            <input type="text" name="txt_name" id="txt_name" class="form-control"  placeholder="Your Name *" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="txt_email" id="txt_email"
                                                   class="form-control" required="" placeholder="Your Email *">
                                        </div>
                                        <div class="form-group">
                                        <textarea class="form-control" required="" id="description" name="description"  placeholder="Enter Comment *"></textarea>
                                        </div>
                                        <!-- <button class="btn ps-btn">Send Now</button> -->
                                        <input type="hidden" id="user_email" name="user_email"
                                               value="{{$user_detail->user_email}}">

                                        <input type="hidden" name="advertise_name" id="advertise_name"
                                               value="{{$advertise_detail->title}}">
                                        <input type="hidden" name="post_id" id="post_id"
                                               value="{{$advertise_detail->id}}">
                                        <input value="Send Now" id="btn_submit" class="btn btn-primary c-button" name="btn_submit"
                                               type="submit" style="color: white;padding: 8px;">
                                        <input type="hidden" name="redirect_url"
                                               value="{{ route('advertise-detail').'/'.$advertise_detail->slug}}">


                                </div>
                            </form>
            </div>



          @endif

            <div class="p-4 mb-3 bg-gray">
              <div class="widget">
                <h5 class="widget-header">{{$static_page->title ?? ''}}</h5>
                 {!!$static_page->description ?? '' !!}
              </div>
            </div>


      </div>
    </div>



  </div>
</div>
 @if($related_advertise->count() > 4)
<div class="site-section p-0">
  <div class="container">
        <h4 class="mb-4 mt-0 text-primary text-center">Related Post</h4>
     <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-carousel">
            <div class="owl-carousel carousel-main">

      @foreach($related_advertise as $rel_key => $related_advertise_related)
              <div class="Classidied-box h-auto px-2">
                  <div class="card card-event info-overlay">
                    @if($related_advertise_related->is_sold=="Yes")
                    <div class="ribbon"><span>Sold</span></div>
                    @endif
                    <div class="img has-background" style="background-image: url({{$related_advertise_related->image_path}}); background-size:cover;cursor: pointer " onclick="location.href='{{route('advertise-detail')}}/{{$related_advertise_related->slug}}'">

                       <a onclick="location.href='{{route('advertise-detail')}}/{{$related_advertise_related->slug}}'"> <img alt="340x230" class="card-img-top img-responsive" data-holder-rendered="true" src="{{$related_advertise_related->image_path}}"> </a> </div>
                    <div class="card-body">
                      <h6 class="card-title"> <a href="">{{$related_advertise_related->title??''}}</a> </h6>

                      <div class="card-event-info">
                        <p class="event-location"><i class="far fa-compass"></i> <a class="location" onclick="location.href='{{url('advertise/category')}}/{{$related_advertise_related->parent_slug}}'" style="cursor: pointer;">{{$related_advertise_related->category}}</a></p>
                        <p class="event-time"><i class="far fa-clock"></i> {{ date('M d, Y',strtotime($related_advertise_related->publish_date))}} </p>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="pull-left left">
                        <div class=""> <a href="javascript:void(0);">{!! Helper::commonMoneyFormat($related_advertise_related->price) !!} </a></div>
                      </div>
                      <div class="pull-right right social-link">

                        <a href="javascript:void(0);"
                                                   data-post_id="{{$related_advertise_related->id}}"
                                                   data-url="{{ route('set-favourit', ['id'=>$related_advertise_related->id]) }}"
                                                   class="{{$related_advertise_related->is_fav=='No' ? 'far fa-heart':'fas fa-heart'}} ps-favorite-href float-right">
                                                    </a>


                      </div>
                    </div>
                  </div>
                </div>
             @endforeach


            </div>
      </div>
  </div>
  </div>
</div>
@else
@if($related_advertise->count())
<div class="site-section p-0">
  <div class="container">
        <h4 class="mb-4 mt-0 text-primary text-center">Related Post</h4>
     <div class="row">


      @foreach($related_advertise as $rel_key => $related_advertise_related)
          <div class="col-lg-3 col-md-3 col-sm-6">
              <div class="Classidied-box h-auto px-2">

                  <div class="card card-event info-overlay">
                    @if($related_advertise_related->is_sold=="Yes")
                    <div class="ribbon"><span>Sold</span></div>
                    @endif

                    <div class="img has-background" style="background-image: url({{$related_advertise_related->image_path}}); background-size:cover;cursor: pointer " onclick="location.href='{{route('advertise-detail')}}/{{$related_advertise_related->slug}}'">

                       <a onclick="location.href='{{route('advertise-detail')}}/{{$related_advertise_related->slug}}'"> <img alt="340x230" class="card-img-top img-responsive" data-holder-rendered="true" src="{{$related_advertise_related->image_path}}"> </a> </div>
                    <div class="card-body">
                        
                      <h6 class="card-text mb-0"> {{$related_advertise_related->title??''}} </h6>
                      <div class="card-text">
                        <div class=""> {!! Helper::commonMoneyFormat($related_advertise_related->price) !!}</div>
                      </div><br>
                      <div class="card-event-info">
                        <p class="event-location"><i class="far fa-compass"></i> <a class="location" onclick="location.href='{{url('advertise/category')}}/{{$related_advertise_related->parent_slug}}'" style="cursor: pointer;">{{$related_advertise_related->category}}</a></p>
                        <p class="event-time"><i class="far fa-clock"></i> {{ date('M d, Y',strtotime($related_advertise_related->publish_date))}} </p>
                      </div>
                    </div>
                    
                    <div class="card-footer">
                      <div class="pull-left left">
                        <div class="" style="font: 400 0.8125rem 'Open Sans', sans-serif;"> 
                            <span>

                                <i class="fa fa-map-marker-alt "  aria-hidden="true"></i>
                            </span>
                            <a href="javascript:void(0);" style="color:#55acee;">Barh , Bihar</a>

                        </div>
                      </div>
                      
                      <div class="pull-right right social-link">

                        <a href="javascript:void(0);"
                        data-post_id="{{$related_advertise_related->id}}"
                        data-url="{{ route('set-favourit', ['id'=>$related_advertise_related->id]) }}"
                        class="{{$related_advertise_related->is_fav=='No' ? 'far fa-heart':'fas fa-heart'}} ps-favorite-href float-right">
                        </a>

                      </div>
                    </div>

                  </div>
                </div>
      </div>
             @endforeach



  </div>
  </div>
</div>

@endif
@endif








@endsection
@section('js')
<script src="{{ asset('assets/website/css/js/functions.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/website/css/js/swiper.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/website/css/js/main.js')}}" type="text/javascript"></script>
 <script>
$('.carousel-main').owlCarousel({
  items: 4,
  loop: true,
  autoplay: false,
  autoplayTimeout: 3000,
  margin: 10,
  responsiveClass: true,
  responsive: {
    0: {
      items: 2
    },

    600: {
      items: 3
    },

    1024: {
      items: 4
    },

    1366: {
      items: 4
    }
  },
  nav: true,
  dots: false,
  navText: ['<span class="fa fa-arrow-circle-left fa-2x mt-5 ml-1 mb-5 pt-4"></span>','<span class="fa fa-arrow-circle-right fa-2x mt-4 mt-5 mr-1 mb-5 pt-4"></span>'],
})
$(document).on('click', '.ps-favorite-href', function () {

            var auth = '{{Auth::check()}}';

            if (!auth) {
                // alert("Please Login.");
                // toastr.remove();
                // toastr.error('Please Login first.','Error');
                window.location.href = "{{url('login')}}"
                return false
            }


            var postId = $(this).attr('data-post_id');
            var url = $(this).attr('data-url');
            var el = $(this);
            //alert(el);

            $.ajax({
                type: "GET",
                url: url,

            }).always(function () {
                // $('#load-modal').html(' ')
            }).done(function (res) {
                // alert(res.process);
                if (res.process == "add") {

                    $(el).removeClass('far fa-heart');
                    $(el).addClass('fas fa-heart');


                    toastr.remove();
                    toastr.success('Favourite add successfully.', 'Success');
                } else if (res.process == "remove") {

                   $(el).removeClass('fas fa-heart');
                    $(el).addClass('far fa-heart');
                    toastr.remove();
                    toastr.success('Favourite remove successfully.', 'Success');
                }

                // alert(res.process);
                // $('#load-modal').html(res.html);
                // $(target).modal('toggle');
            });

        });
        </script>

@endsection

