@extends('website.layout.app')
@section('title' , 'High Security - Service')
@push('css')
<style type="text/css">
    .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #fab909;
    border-color: #fab909;
}
</style>
@endpush
@section('content')
    <!-- Page Heading Section Start --> 
    <div class="pagehding-sec">
        <div class="pagehding-overlay"></div>       
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-heading">
                        <h1>Service</h1>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">Service</a></li>
                        </ul>                       
                    </div>                  
                </div>              
            </div>
        </div>
    </div>
    <!-- Page Heading Section End -->
    
    <!-- Service Start -->  
    <div class="service-sec pt-100 pb-100">
        <div class="container">     
            <div class="row">           
                <div class="service-item">
                    @foreach($service->chunk(3) as $s)
                    @foreach($s as $ser)
                    <div class="col-md-4 col-sm-6">
                        <div class="service-inner">
                            <div class="service-img" style="background-image: url({{ $ser->small_image }}); background-size: cover; background-position: center center;">
                            </div>                      
                            <div class="service-details">                       
                                <h2><a href="{{ route('service.show',[$ser->slug]) }}">{{ $ser->service_name }}</a></h2>
                                <p>{!! str_limit($ser->description,$limit = 140, $end = '...') !!}</p>
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
        
@endsection
