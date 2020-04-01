@extends('websiteview.user_panel.layout.app')
@section('title' , 'My Favourite')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'My Favourite',
   
    
    
])
@endcomponent
@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <link href="https://fonts.googleapis.com/css?family=Mukta+Vaani:400,500&amp;subset=gujarati" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800,900">
    <link rel="stylesheet" href="{{ asset('assets/website/css/common.css') }}">
<style type="text/css">
  /*card line*/
.list-group-item {
    position: relative;
    display: block;
    padding: 0.75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #fff;
    border-top: 1px solid rgba(0, 0, 0, 0.125);
    border-left: none;
    border-bottom: none;
    border-right: none;
}
/**/
.card-body span a {
  
    color: #55acee;
}
a:hover {
    color: inherit;
    text-decoration: none;
}

.list-group .list-group-item .myheart {
    color: #ff5851;
    font-weight: 900;
}
.card-body span a:hover {
color: #ff5851;
    font-weight: 900;
}

</style>
@endpush
@section('content')

    <!-- BANNER END -->
    <!-- MAIN START -->

<div class="container-fluid">
      <div class="row">
                    <!-- SIDEBAR START -->
                              
                    <!-- SIDEBAR END -->





                @if(count($totalData))

         


                    @foreach($totalData as $item_value)


                        <div style="cursor: pointer;" class="col-lg-3 col-xl-3 cardhide">
                            <div class="card" style="width:100%">
                                       <img class="card-img-top" style="cursor: pointer;" src="{{$item_value->image_path}}" alt=""  onclick="location.href='{{route('advertise-detail')}}/{{$item_value->slug}}'">

                                        <div class="card-body">

                                            <h6 style="font-weight: bold;font-size: 1.2rem;" class="text-secondary">{!! Helper::commonMoneyFormat($item_value->price) !!} {{-- Helper::commonCurrency() --}} {{--Helper::moneyFormatIndiaCommon($item_value->price)--}}</h6>
                                            <p class="card-text">{!! str_limit($item_value->title,$limit = 25, $end = '...') !!}</p>
                                            <span class="d-block"><i class="fa fa-cube text-secondary" aria-hidden="true"></i>
                                            <a onclick="location.href='{{url('advertise/category')}}/{{$item_value->parent_slug}}'" style="font: 400 0.8125rem 'Open Sans', sans-serif;color: #55acee;cursor: pointer;">{{$item_value->category}}
                                           </a>
                                            </span>
                                            <span>
                                              <i class="fa fa-clock-o text-secondary" aria-hidden="true"></i> <span style="font: 400 0.8125rem 'Open Sans', sans-serif;">
                                             {{ date('M d, Y ',strtotime($item_value->publish_date))}}</span></span>

                                           
                                        </div>
                                          <ul class="list-group">
                                            <li class="list-group-item" style="font: 400 0.8125rem 'Open Sans', sans-serif;">
                                                <span>
                                                    <i class="fa fa-map-marker text-secondary" aria-hidden="true"></i>
                                                     <a href="javascript:void(0);" style="color:#55acee;">{{$item_value->city_name.' , '.$item_value->state_name}}</a>
                                  

                                               </span>
                                               
                                                <a href="javascript:void(0);"
                                                   data-post_id="{{$item_value->id}}"
                                                   data-url="{{ route('set-favourit', ['id'=>$item_value->id]) }}"
                                                   class="float-right {{$item_value->is_fav=="No" ? '':'ps-favorite'}} ps-favorite-href">
                                                    <i class="fa fa-heart myheart" aria-hidden="true"></i>
                                                </a>
                                               

                                            </li>
                                        </ul>


                                  
                                    </div>
                        </div>

                        @endforeach
                          <div class="col-12">
                                    <br>
                                    <br>
                    
                                 <div class="d-flex justify-content-lg-center">
                        

                                   {{ $totalData->appends($_GET)->links() }}
                                   </div>
                         
                         </div>


              


                        @else


                        <div class="col-md-12 mt-5 text-center">
                            <h5>No Favourite Found :(</h5><br/>
                        
                        </div>

                    @endif
        

  </div>
</div>

@endsection
@push('js')
<script type="text/javascript">

          $(document).on('click','.ps-favorite-href',function(){

  var auth='{{Auth::check()}}';

  if(!auth){
  // alert("Please Login.");
          // toastr.remove();
          // toastr.error('Please Login first.','Error');
               window.location.href = "{{url('login')}}"
  return false
  }

        $(this).closest('.cardhide').remove();



           var postId = $(this).attr('data-post_id');
           var url = $(this).attr('data-url');
            var el = $(this);

            $.ajax({
                type: "GET",
                url: url,

            }).always(function(){

            }).done(function(res){

              if(res.process=="add"){
               $(el).addClass('ps-favorite');
                 toastr.remove();
          toastr.success('Favourite add successfully.','Success');

              }else if(res.process=="remove"){

               $(el).removeClass('ps-favorite');
                 toastr.remove();
          toastr.success('Favourite remove successfully.','Success');
           $(this).closest('.cardhide').remove();
              }



              // alert(res.process);
                // $('#load-modal').html(res.html);
                // $(target).modal('toggle');
            });

    });







</script>
@endpush
