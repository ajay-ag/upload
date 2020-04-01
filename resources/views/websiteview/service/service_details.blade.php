@extends('website.layout.app')
@section('title' , 'High Security - Service Details')
@section('content')
    <!-- Page Heading Section Start --> 
    <div class="pagehding-sec">
        <div class="pagehding-overlay"></div>       
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-heading">
                        <h1>Service Details</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">Service Details</a></li>
                        </ul>                       
                    </div>                  
                </div>              
            </div>
        </div>
    </div>
    <!-- Page Heading Section End -->
        
    <!-- Service Details Section Start -->  
    <div class="about-us-sec pt-100 pb-100">                
        <div class="container">                     
            <div class="row">           
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="abt-img">
                        <img src="{{ $service->detail_image}}" alt=""/>
                    </div>
                </div>              
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="abt-lft">
                        <h2>{{ $service->service_name ?? '' }}</h2>
                        <p>{!! $service->description !!}</p>                            
                                                
                    </div>
                </div>                  
            </div>  
        </div>  
    </div>          
    <!-- Service Details Section End -->
    <!-- Service Start -->  
    <div class="service2-sec pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sec-title">
                        <h1><span>Related</span> Service</h1>
                        <!-- <p>Lorem ipsum dolor sit amet, pellentesque enim lorem quis vivamus amet.</p> -->
                    </div>
                </div>
            </div>      
            <div class="row">           
                <div class="service2-item">
                    @foreach($relatedService->chunk(3) as $s)
                    @foreach($s as $ser)
                    <div class="col-md-4 col-sm-6">
                        <div class="service2-inner">
                            <div class="media">
                                <div class="media-left">
                                    <div class="service2-icon">
                                        <img src="{{ $ser->icon_image }}" alt=""/>
                                    </div>                  
                                </div>                  
                                <div class="media-body">                
                                    <div class="service2-details">                      
                                        <h2><a href="{{ route('service.show',[$ser->slug]) }}">{{ $ser->service_name }}</a></h2>
                                        <p>{!! str_limit($ser->description,$limit = 140, $end = '...') !!}</p>
                                        <a href="{{ route('service.show',[$ser->slug]) }}">Continue Reading...</a>
                                    </div>                          
                                </div>                          
                            </div>                          
                        </div>                          
                    </div>
                    @endforeach   
                    @endforeach                                                                                      
                  
                </div>                          
            </div>
        </div>      
    </div>      
    <!-- Service End -->        

  @if($ourclient->count()>0)
        <div class="all-patner-sec">
        <div class="container">
         
            <div class="row">               
                <div class="all-patner">
                     @foreach($ourclient as $key=> $our) 
                    <div class="single-patner">
                        <img src="{{ $our->our_image }}" alt=""/>
                    </div>  
                    @endforeach                   
                    
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Blog Section End --> 

        
@endsection
