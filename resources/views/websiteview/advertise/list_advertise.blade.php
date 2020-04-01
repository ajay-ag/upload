@extends('websiteview.layout.app')
@section('title',@$title)
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/website/css/list-common.css') }}">
    <style>
        .ps-gridList__priceRange .ui-state-default, .ps-gridList__priceRange .ui-widget-content .ui-state-default {
            outline: none !important;
        }
    </style>
@endsection

@section('site-block')
    <div class="site-blocks-cover inner-page-cover overlay"
         style="background-image: url({{asset('storage/staticpages/banner_image/'.$categories_list->banner_image)}});"
         data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


                    <div class="row justify-content-center">
                        <div class="col-md-8 text-center">
                            <h1>{{$categories_list->title ?? ''}}</h1>
                            <!--  <p data-aos="fade-up" data-aos-delay="100">Handcrafted free templates by</p> -->
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
            <div class="row">

                <div class="col-md-3">
                    <form class="ps-form ps-main-form ps-side-mainForm" action="{{ route('advertise-filter')}}"
                          method="get">
                        <div class="mb-3">

                            <div class="ps-gridList__searchArea">
                                <input type="hidden" name="sort" value="{{Request::get('sort')}}">
                                <input type="hidden" name="user_id" value="{{Request::get('user_id')}}">
                                <h6>Search</h6>

                                <div class="input-group">
                                    <input value="{{ Request::get('keyword')}}" type="text" name="keyword" id="keyword"
                                           class="form-control" placeholder="Enter Keyword" aria-label="Enter Keyword"
                                           aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" id="button-addon1"><span
                                                class="icon-search"></span>
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="ps-gridList__searchArea ps-gridList__categories">
                                <h6>Categories</h6>


                                <div class="ps-gridList__checkbox">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input all_view" id="all"
                                               name="all" {{Request::get('all')=="on" ? 'checked':''}}>
                                        <label class="custom-control-label" for="all">Show All <span></span></label>
                                    </div>

                                    @foreach($category as $c_key => $item_category)
                                        @php  $selected_category=""; @endphp

                                        @if(isset($search_category))
                                            @if(in_array($item_category['id'],$search_category))
                                                @php $selected_category="checked='checked'"; @endphp


                                            @endif
                                        @endif

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input chk"
                                                   id="category_{{$item_category['id']}}"
                                                   {{$selected_category}}  value="{{$item_category['id']}}"
                                                   name="category_id[]">
                                            <label class="custom-control-label"
                                                   for="category_{{$item_category['id']}}">{{$item_category['name']}}
                                                <span>
                                    ({{$item_category['post_count']}})
                                   </span>
                                            </label>

                                            @if(!empty($selected_category))
                                                @if(Request::segment(2) =="sub-category")

                                                    @php
                                                        $cats=DB::table('category')
                                                        ->where('parent_id',$item_category['id'])
                                                        ->where('is_active','Yes')
                                                        ->get();
                                                    @endphp

                                                    <ul class="label_subcategory">
                                                        @foreach($cats as $c)

                                                            <li class="{{$c->slug==Request::segment(3) ? 'color_menu_left_side' : ''}}">
                                                                <a href="{{url('advertise/sub-category').'/'.$c->slug}}">
                                                                    {{ $c->name ?? ''}}
                                                                </a>
                                                            </li>



                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endif


                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="ps-gridList__searchArea ps-gridList__priceRange">
                                <input type="hidden" name="cu" id="cu" value="{{Helper::commonCurrency() }}">
                                <h6>Price Range</h6>
                                <input type="text" id="amount" name="amount" readonly="">
                                <div id="slider-range"></div>
                            </div>

                            @if(count($brand))
                                <div class="ps-gridList__searchArea ps-gridList__categories mt-3">
                                    <h6>Brands</h6>


                                    <div class="ps-gridList__checkbox">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input all_view_brand"
                                                   id="all_brand"
                                                   name="all_brand" {{Request::get('all_brand')=="on" ? 'checked':''}}>
                                            <label class="custom-control-label" for="all_brand">Show All
                                                <span></span></label>
                                        </div>

                                        @foreach($brand as $c_key => $item_brand)
                                            @php  $selected_brand=""; @endphp

                                            @if(isset($search_brand))
                                                @if(in_array($item_brand['id'],$search_brand))
                                                    @php $selected_brand="checked='checked'";
                                                    @endphp
                                                @endif
                                            @endif

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input chk_brand"
                                                       id="brand_{{$item_brand['id']}}"
                                                       {{$selected_brand}}  value="{{$item_brand['id']}}"
                                                       name="brand_id[]">
                                                <label class="custom-control-label"
                                                       for="brand_{{$item_brand['id']}}">{{$item_brand['name']}}
                                                    <span>

                                   </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="ps-gridList__searchArea ps-gridList__filter" style="text-align: center;">
                                <input type="hidden" name="search_post" id="search_post" value="1">

                                <button class="btn text-white btn-primary" onclick="return submit();">Apply Filter
                                </button>
                                <a href="{{url('/advertise')}}" class="ps-filter__h"><span><i class="fa fa-refresh"
                                                                                              aria-hidden="true"></i></span>&nbsp;&nbsp;Reset
                                    Filter</a>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-9">

                    <div class="ps-uniqueGadgets">
                        <div class="ps-uniqueGadgets__heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Results in {{$category_name}}</h4>
                                </div>
                                <div
                                    class="col-sm-6 col-md-6 d-flex align-items-center justify-content-start justify-content-sm-start justify-content-md-end ">
                                    @if(request()->get('view') == 'grid')
                                        @php
                                            $stylegrid= "color: #f38181";
                                        @endphp
                                    @elseif(request()->get('view') == 'list')
                                        @php
                                            $stylelist= "color: #f38181";
                                        @endphp


                                    @endif
                                    <div class="layout-switcher mb-0">
                                        <ul>
                                            <li class="active">
                                                <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"
                                                   class="grid" style="{{$stylegrid ?? 'color:black'}}"><i
                                                        class="fa fa-th"></i></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="layout-switcher mb-0 ml-2">
                                        <ul>

                                            <li>
                                                <a href="{{ request()->fullUrlWithQuery(['view' => 'list'])  }}"
                                                   class="list" style="{{$stylelist ?? 'color:black' }}"><i
                                                        class="fa fa-align-justify"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ps-uniqueGadgets__content">
                        <!--     <p>Showing 1 - 30 of  {{count($totalData)}} results</p>  -->
                            <p>Showing {{ $totalData->firstItem() }} - {{ $totalData->lastItem() }}
                                of {{ $totalData->total() }} results</p>
                            <div class="d-flex flex-wrap">
                                <label class="ps-sort">
                                    <select onchange="filtersort(this.value)" class="form-control" name="sort"
                                            id="sort">
                                        {{-- <option selected="" hidden="">Sort By:</option> --}}
                                        <option value="all">All</option>
                                        <option
                                            {{Request::get('sort') =="low"  ? 'selected' : ''}} value="low">Low - High
                                        </option>

                                        <option
                                            {{Request::get('sort') =="high"  ? 'selected' : ''}}
                                            value="high">High - Low
                                        </option>
                                    </select>
                                </label>
                                {{--  <button class="btn ps-btn ps-outline-btn"><i class="ti-map"></i></button>
                                 <button class="btn ps-btn ps-outline-btn"><i class="ti-view-list"></i></button>
                                 <button class="btn ps-btn ps-active"><i class="ti-layout-grid2"></i></button> --}}
                            </div>
                        </div>
                    </div>
                    @if(count($totalData))
                        <div class="row mb-3">
                            @foreach($totalData as $item_value)
                                @if(request('view') == 'list')


                                    <div class="col-lg-12">

                                        <div class="d-block d-md-flex listing-horizontal">


                                            <a href="javascript:void(0)"
                                               onclick="location.href='{{route('advertise-detail')}}/{{$item_value->slug}}'"
                                               class="img d-block mt-2"
                                               style="background-image: url({{$item_value->image_path}});margin-top:0px !important;">
                                                <span class="category">{{$item_value->category}}</span>
                                            </a>
                                            @if($item_value->is_sold=="Yes")
                                                <div class="ribbon"><span>Sold</span></div>
                                            @endif

                                            <div class="lh-content">
                                                {{--<a href="javascript:void(0);" class="bookmark"><span class="icon-heart-o"></span></a>--}}
                                                @if($item_value->is_sold=="No")
                                                    <a href="javascript:void(0);"
                                                       data-post_id="{{$item_value->id}}"
                                                       data-url="{{ route('set-favourit', ['id'=>$item_value->id]) }}"
                                                       class="{{$item_value->is_fav=="No" ? 'fa fa-heart-o':'fa fa-heart'}} ps-favorite-href float-right">
                                                    </a>
                                                @endif

                                                <h5>
                                                    <a href="javascript:void(0);">{!! str_limit($item_value->title,$limit =25, $end = '...') !!}


                                                        {{-- Helper::commonCurrency() --}} {{-- Helper::moneyFormatIndiaCommon($item_value->price) --}}</a>
                                                </h5>
                                                <p>{!! Helper::commonMoneyFormat($item_value->price) !!}</p>
                                                <p>

                                                    <span><i class="fa fa-clock-o"></i> {{ date('M d, Y ',strtotime($item_value->publish_date))}}</span>
                                                </p>

                                                <span>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                     <a href="javascript:void(0);"> &nbsp;{{$item_value->city_name.' , '.$item_value->state_name}}</a>


                                               </span>


                                            </div>

                                        </div>
                                    </div>
                                @else

                                    <div class="col-md-4 col-lg-4 col-sm-6  mb-4 mb-lg-4">


                                        <div class="card" style="width:100%">
                                            @if($item_value->is_sold=="Yes")
                                                <div class="ribbon"><span>Sold</span></div>
                                            @endif

                                            <img class="card-img-top" style="cursor: pointer;"
                                                 src="{{$item_value->image_path}}" alt=""
                                                 onclick="location.href='{{route('advertise-detail')}}/{{$item_value->slug}}'">

                                            <div class="card-body">

                                                <h6>{!! str_limit($item_value->title,$limit =25, $end = '...') !!}
                                                    {{-- Helper::commonCurrency() --}} {{-- Helper::moneyFormatIndiaCommon($item_value->price) --}}</h6>
                                                <p class="card-text">{!! Helper::commonMoneyFormat(($item_value->price)) !!}</p>
                                                <span class="d-block"><i class="fa fa-cube" aria-hidden="true"></i>
                                            <a onclick="location.href='{{url('advertise/category')}}/{{$item_value->parent_slug}}'"
                                               style="font: 400 0.8125rem 'Open Sans', sans-serif;color: #55acee;cursor: pointer;">{{$item_value->category}}
                                           </a>
                                            </span>
                                                <span>
                                              <i class="fa fa-clock-o" aria-hidden="true"></i> <span
                                                        style="font: 400 0.8125rem 'Open Sans', sans-serif;">
                                             {{ date('M d, Y ',strtotime($item_value->publish_date))}}</span></span>


                                            </div>
                                            <ul class="list-group">
                                                <li class="list-group-item"
                                                    style="font: 400 0.8125rem 'Open Sans', sans-serif;">
                                                    <span>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                     <a href="javascript:void(0);"
                                                        style="color:#55acee;">{{$item_value->city_name.' , '.$item_value->state_name}}</a>


                                               </span>
                                                    @if($item_value->is_sold=="No")
                                                        <a href="javascript:void(0);"
                                                           data-post_id="{{$item_value->id}}"
                                                           data-url="{{ route('set-favourit', ['id'=>$item_value->id]) }}"
                                                           class="{{$item_value->is_fav=="No" ? 'fa fa-heart-o':'fa fa-heart'}} ps-favorite-href float-right">
                                                        </a>
                                                    @endif
                                                </li>
                                            </ul>


                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <div class="col-12">
                                <br>
                                <br>

                                <div class="d-flex justify-content-lg-center">

                                    {{ $totalData->appends($_GET)->links() }}
                                </div>

                            </div>

                        </div>


                    @else


                        <div style="margin-top: 200px;" class="d-flex justify-content-lg-center">
                            <h5>No Results Found Yet :(</h5><br/>
                            {{-- <h6>Click “Search Again”</h6> --}}
                            {{-- <button class="btn pas-btn">Search Again</button> --}}
                        </div>

                    @endif


                </div>

            </div>
        </div>

    </div>

    <script src="">
        var amount = "";
    </script>
    @php
        /*  $endAmuntDb = DB::table('advertisement_posts')->where('status','approved')->max('price'); */
        $endAmuntDb=$maxPrice;
        $endAmuntDb=  $endAmuntDb ? $endAmuntDb:0;
        $currSy = Helper::commonCurrency();



      if(Request::get('amount')){
                  $replace = str_replace($currSy, '',Request::get('amount'));

                  $replace = explode('-', $replace);

          $startAmunt = str_replace(' ', '',$replace[0]);
          $endAmunt = str_replace(' ', '',$replace[1]);
       }else{
        $startAmunt =0;
        $endAmunt =$endAmuntDb;
       }

      if($endAmuntDb==0){
           $endAmuntDb=100000;

      }


    @endphp

@endsection
@section('js')
    <script>
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

                    $(el).removeClass('fa fa-heart-o');
                    $(el).addClass('fa fa-heart');


                    toastr.remove();
                    toastr.success('Favourite add successfully.', 'Success');
                } else if (res.process == "remove") {

                    $(el).removeClass('fa fa-heart');
                    $(el).addClass('fa fa-heart-o');
                    toastr.remove();
                    toastr.success('Favourite remove successfully.', 'Success');
                }

                // alert(res.process);
                // $('#load-modal').html(res.html);
                // $(target).modal('toggle');
            });

        });

        function filtersort(id) {
            if (document.location.search.length) {
                var url = document.location.href + "&sort=" + id;

            } else {
                var url = document.location.href + "?sort=" + id;

            }

            // window.location.href = "/my-listing?status="+id;

            document.location = url;
        }

        $(".all_view").click(function () {
            if ($(this).is(':checked')) {
                var $view = $('.chk').prop("checked", true);
            } else {
                var $view = $('.chk').prop("checked", false);
            }
        });

        $(".chk").click(function () {
            var numberOfChecked = $('.chk').filter(':checked').length;
            var totalCheckboxes = $('.chk').length;
            if (numberOfChecked == totalCheckboxes) {
                var $view = $('.all_view').prop("checked", true);
            }
            if ($(this).is(':checked')) {
                // var $view = $('.all_view').prop("checked" , true);
            } else {
                var $view = $('.all_view').prop("checked", false);
            }
        });

        $(".all_view_brand").click(function () {
            if ($(this).is(':checked')) {
                var $view = $('.chk_brand').prop("checked", true);
            } else {
                var $view = $('.chk_brand').prop("checked", false);
            }
        });

        $(".chk_brand").click(function () {
            var numberOfChecked = $('.chk_brand').filter(':checked').length;
            var totalCheckboxes = $('.chk_brand').length;
            if (numberOfChecked == totalCheckboxes) {
                var $view = $('.all_view_brand').prop("checked", true);
            }
            if ($(this).is(':checked')) {
                // var $view = $('.all_view').prop("checked" , true);
            } else {
                var $view = $('.all_view_brand').prop("checked", false);
            }
        });
    </script>
    <script>
        var cu = $('#cu').val();

        //alert(cu)

        $(function () {

            $("#slider-range").slider({
                range: true,
                min: 0,
                max:{{$endAmuntDb}},
                values: [{{$startAmunt}},{{$endAmunt}}],
                slide: function (event, ui) {
                    $("#amount").val(cu + ui.values[0] + " - " + cu + ui.values[1]);
                }
            });
            $("#amount").val(cu + $("#slider-range").slider("values", 0) +
                " - " + cu + $("#slider-range").slider("values", 1));
        });
        $(".card").hover(
            function () {
                $(this).addClass('shadow-lg').css('cursor', 'pointer');
            }, function () {
                $(this).removeClass('shadow-lg');
            }
        );
    </script>
@endsection
