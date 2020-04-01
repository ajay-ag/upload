    @extends('websiteview.layout.app')
 @section('js')
    <script type="text/javascript" src="{{assets('websiteview/assets/js/jquery.1.5.1.js')}}"></script>

<script type="text/javascript" src="{{assets('websiteview/assets/js/featuredimagezoomer.js')}}"></script>
<script type="text/javascript" src="{{assets('websiteview/assets/js/jcarousel.min.js')}}"></script>
@endsection('js')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('websiteview/assets/css/skin.css') }}" media="screen, projection" />
  
<style type="text/css">
    

.product-view { border:none; position: relative;}

.product-view .product-img-box { float:left; width:545px; text-align:center; margin-left: 65px; }
.col3-layout .product-view .product-img-box { float:none; margin:0 auto; }
.product-view .product-img-box .product-image { margin: 20px 0 50px 0; }
.product-view .product-img-box .product-image img { /*height: 495px; width: 306px;*/ width:75%; height:auto; max-height:670px; }
.product-view .product-img-box .product-image-zoom { position:relative; width:265px; height:265px; overflow:hidden; z-index:9; }
.product-view .product-img-box .product-image-zoom img { position:absolute; left:0; top:0; cursor:move; }
.product-view .product-img-box .zoom-notice { font-size:11px; margin:0 0 5px; text-align:center; display:none;}
.product-view .product-img-box .zoom { position:relative; z-index:9; height:18px; margin:0 auto 13px; padding:0 28px; background:url(https://www.lilyboutique.com/skin/frontend/default/default/images/slider_bg.gif) 50% 50% no-repeat; cursor:pointer; }
.product-view .product-img-box .zoom.disabled { -moz-opacity:.3; -webkit-opacity:.3; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";/*IE8*/ opacity:.3; }
.product-view .product-img-box .zoom #track { position:relative; height:18px; }
.product-view .product-img-box .zoom #handle { position:absolute; left:0; top:-1px; width:9px; height:22px; background:url({{asset('websiteview/assets/images/magnifier_handle.gif') }}) 0 0 no-repeat;  }
.product-view .product-img-box .zoom .btn-zoom-out { position:absolute; left:2px; top:0; }
.product-view .product-img-box .zoom .btn-zoom-in { position:absolute; right:2px; top:0; }
.product-view .product-img-box .more-views h2 {font-size:11px; border-bottom:1px solid #ccc; margin:0 0 8px; text-transform:uppercase; display:none;}
.product-view .product-img-box .more-views ul {margin:auto; display:inline-block;}
.product-view .product-img-box .more-views li {float:left; margin:0 8px 8px 0px; width:97px;  text-align:center; background:url({{asset('websiteview/assets/images/pro_small_bg.jpg') }}) no-repeat left top; background-size: contain; padding: 0;}
.product-view .product-img-box .more-views li a {padding: 20px 5px 5px 5px; display: block;}
.product-view .product-img-box .more-views li img {max-width: 100%; height: auto;}

.product-image-popup { margin:0 auto; }
.product-image-popup .buttons-set { float:right; clear:none; border:0; margin:0; padding:0; }
.product-image-popup .nav { font-weight:bold; margin:0 100px; text-align:center; }
.product-image-popup .image { display:block; margin:10px 0;  }
.product-image-popup .image-label { font-size:13px; font-weight:bold; margin:0 0 10px; color:#2f2f2f; }

.jcarousel-skin-tango .jcarousel-container-horizontal {
    padding: 10px 70px !important;
    width: auto !important;
}

.jcarousel-item.jcarousel-item-horizontal {border: none !important; cursor: pointer !important;}

.jcarousel-skin-tango .jcarousel-prev-horizontal {
    background: url({{asset('websiteview/assets/images/arrow-left.png') }}) no-repeat !important;
    cursor: pointer;
    height: 71px !important;
    position: absolute;
    left: 0;
    top: 44px !important;
    width: 35px !important;
}

.jcarousel-skin-tango .jcarousel-next-horizontal {
    background: url({{asset('websiteview/assets/images/arrow-right.png') }}) no-repeat !important;
    cursor: pointer;
    height: 71px !important;
    position: absolute;
    right: 10px !important;
    top: 44px !important;
    width: 35px !important;
}
.active
{
    border:solid 1px #ccc !important;
}
.magnifyarea{ /* CSS to add shadow to magnified image. Optional */
    box-shadow: 5px 5px 7px #818181;
    -webkit-box-shadow: 5px 5px 7px #818181;
    -moz-box-shadow: 5px 5px 7px #818181;
    filter: progid:DXImageTransform.Microsoft.dropShadow(color=#818181, offX=5, offY=5, positive=true);
    background: white;
}


</style>
 

    @endsection('css')
    @section('content') 

    <div class="product-view">


   
 <div class="product-img-box"  style="display:block;" >

           
<!-- <script type="text/javascript" src="https://www.lilyboutique.com/skin/frontend/default/default/js/lib/jquery-1.4.2.min.js"></script> -->

<script type="text/javascript">


</script>
<style type="text/css">
.active
{
    border:solid 1px #ccc !important;
}
</style>

<p class="product-image">
    <img id="image1" src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_29_.jpg" alt="Cute Olive Green A-Line Midi Skirt" title="Cute Olive Green A-Line Midi Skirt"   /></p>
<p class="zoom-notice" id="track_hint">Mouse over the image for zoom</p>
<div id="wrap" class="more-views">
    <h2>More Views</h2>
 <ul id="mycarousel" class="jcarousel-skin-tango">
                            <li style="border:solid 1px #ccc">
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_29_.jpg',this);" title="Cute Olive Green A-Line Midi Skirt" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_29_.jpg"  alt="Cute Olive Green A-Line Midi Skirt" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_30_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_30_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_27_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_27_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_31_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_31_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_32_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_32_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_33_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_33_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_34_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_34_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_35_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_35_.jpg"  alt="" /></a>
        </li>
                            <li >
            <a  onclick="imageswitcher('https://www.lilyboutique.com/media/catalog/product/cache/1/image/410x670/9df78eab33525d08d6e5fb8d27136e95/1/4/146_36_.jpg',this);" title="" ><img src="https://www.lilyboutique.com/media/catalog/product/cache/1/image/92x/9df78eab33525d08d6e5fb8d27136e95/1/4/146_36_.jpg"  alt="" /></a>
        </li>
        </ul>
</div>

     </div>
        

    <div>
     </div>
    
  </div>

    
    <div class="ps-main-banner">
        <div id="owl-four" class="ps-bannerSingle owl-carousel owl-theme">
            <div class="item">
                <figure>
                    <a class="ps-bannerSingle_overlay ps-img1" rel="prettyPhoto[pp_gal]" href="{{asset('websiteview/assets/images/listing-single/img-01.jpg') }}">

                        <span class="lnr lnr-frame-expand"></span>
                    </a>           

                    <img src="{{asset('websiteview/assets/images/listing-single/img-01.jpg') }}" alt="Image Description">
                </figure>
            </div>
            <div class="item">
                <figure>
                    <a class="ps-bannerSingle_overlay ps-img1" rel="prettyPhoto[pp_gal]" href="{{asset('websiteview/assets/images/listing-single/img-02.jpg') }}">

                        <span class="lnr lnr-frame-expand"></span>
                    </a> 

                    <img src="{{asset('websiteview/assets/images/listing-single/img-02.jpg') }}" alt="Image Description">
                </figure>
            </div>
            <div class="item">
                <figure>
                    <a class="ps-bannerSingle_overlay ps-img1" rel="prettyPhoto[pp_gal]" href="{{asset('websiteview/assets/images/listing-single/img-03.jpg') }}">

                        <span class="lnr lnr-frame-expand"></span>
                    </a> 
                    <img src="{{asset('websiteview/assets/images/listing-single/img-03.jpg') }}" alt="Image Description">
                </figure>
            </div>
            <div class="item">
                <figure>

                    <a class="ps-bannerSingle_overlay ps-img1" rel="prettyPhoto[pp_gal]" href="{{asset('websiteview/assets/images/listing-single/img-04.jpg') }}">
                        <span class="lnr lnr-frame-expand"></span>
                    </a> 
                    <img src="{{asset('websiteview/assets/images/listing-single/img-04.jpg') }}" alt="Image Description">
                </figure>
            </div>
        </div>
    </div>
    <!-- BANNER END -->
    <!-- MAIN START -->
    <main class="ps-main2">
        <!-- VISIT START -->
        <div class="ps-visit">
            <div class="container">
                <span class="ps-tag">Featured</span>
                <span class="ps-tag--arrow"></span>

                <figure><img src="{{asset('websiteview/assets/images/listing-single/icon/img-01.jpg') }}" alt="Image Description"></figure>
                <div class="ps-visit_description">
                    <p>Lorina Statham</p>
                    <h4>Tourist Multiple Visit Visa For<span class="d-block">Families & Bachelors</span></h4>
                    <ul>
                        <li><span><i class="ti-eye"></i></span>12,064</li>
                        <li><span><i class="ti-calendar"></i></span>Jun 27, 2019</li>
                        <li class="ps-red"><span><i class="ti-alert"></i></span>Report Ad</li>
                        <li><span><i class="ti-flag"></i></span>ID:4Duzcn9s</li>
                    </ul>
                </div>
                <div class="ps-visit_btn">
                    <button class="btn ps-dollar ps-btn">$1,149</button>
                    <button class="btn ps-heart ps-btn"><span><i class="ti-heart"></i></span></button>
                    <button class="btn ps-share ps-btn"><span><i class="ti-share"></i></span></button>
                </div>
            </div>
        </div>
        <!-- VISIT END -->
        <div class="ps-visit-maincontent ps-main-section">
            <div class="container">
                <div class="row">
                    <!-- MAIN CONTENT START -->
                    <div class="col-lg-8">
                        <!-- DESCRIPTION START -->
                        <div class="ps-visit-description">
                            <h5>Description</h5>
                            <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquaei Ut enim aden minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea coeido consequat. Duis autem irure dolor in reprehenderit in voluptate velit esse cillum dolore excepteur sint occaecat cupidatat non proente sunt in culpa qui officia deserunt mollit anim id estan laboum Sed ut perspiciatis unde omnis iste natus erroru sit voluptatem accusantium doloremque laudium aie totam rem aperiam eaque ipsa quae ab illo inventore veritatis.</p>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia coquuntuir magniem dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, quistani dolorem ipsum quia dolorn sit amet consectetur, adipisci velit, sed quia magnam aliquam quaerat voluptatem elit, sed do eiusmod tempor incididunt.</p>
                            <p class="pb-0">Lenabore et dolore magna aliqua enim ad minim veniamaisi nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprerit in voluptate velit essem cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proidentam sunt inen culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natustea error sit voluptatem accusantium doloremque laudantium totam rem aperiam.</p>
                        </div>
                        <!-- DESCRIPTION END -->
                        <!-- FEATURE START -->
                        <div class="ps-visit-feature">
                            <h5>Featured</h5>
                            <ul>
                                <li><span><i class="ti-printer"></i>Printable:<span class="ps-bold">Yes</span></span> <span><i class="ti-paint-bucket"></i>Color/ B&W:<span class="ps-bold">Color Double Sided</span></span></li>
                                <li><span><i class="ti-star"></i> Paper Quality:<span class="ps-bold">Best Paper</span></span> <span><i class="ti-layers-alt"></i>Spring Bind:<span class="ps-bold">No</span></span></li>
                                <li><span><i class="ti-spray"></i>Paper Color:<span class="ps-bold">White</span></span> <span><i class="ti-bell"></i>Door Step Delivery:<span class="ps-bold">Yes</span></span></li>
                                <li><span><i class="ti-blackboard"></i>Soft Copy:<span class="ps-bold">Available</span></span> <span><i class="ti-brush-alt"></i>Color:<span class="ps-bold">CMYK</span></span></li>
                                <li><span><i class="ti-bag"></i>Leminated:<span class="ps-bold">No</span></span></li>
                            </ul>
                        </div>
                        <!-- FEATURE END -->
                        <!-- VIDEO START -->
                       <!--  <div class="ps-visit-video">
                            <h5>Promo Video</h5>
                            <div class="embed-responsive embed-responsive-21by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/XxxIEGzhIG8" allowfullscreen></iframe>
                            </div>
                        </div> -->
                        <!-- VIDEO END -->
                        <!-- VISIT ADS START -->
                        <div class="ps-visit-ads">
                            <h5>Related Ads</h5>
                            <div id="owl-five" class="ps-featured--cards owl-carousel owl-theme">
                                <div class="item">
                                    <div class="card">
                                        <figure>

                                            <img src="{{asset('websiteview/assets/images/featured/img-01.jpg') }}" class="card-img-top" alt="Image Description">
                                        </figure>
                                        <span class="ps-tag">Featured</span>
                                        <span class="ps-tag--arrow"></span>
                                        <div class="card-body">
                                            <h6>$1,149</h6>
                                            <p class="card-text">Brand New Iphone X For Sale</p>
                                            <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                            <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>

                                            <figure><img src="{{asset('websiteview/assets/images/user-icon/img-01.jpg') }}" alt="Image Description"></figure>
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);" class="ps-favorite"><i class="fas fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card">
                                        <figure>

                                            <img src="{{asset('websiteview/assets/images/featured/img-02.jpg') }}" class="card-img-top" alt="Image Description">
                                        </figure>
                                        <span class="ps-tag">Featured</span>
                                        <span class="ps-tag--arrow"></span>
                                        <div class="card-body">
                                            <h6>$650</h6>
                                            <p class="card-text">Galaxy Note 8 Urgent Sale</p>
                                            <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                            <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>

                                            <figure><img src="{{asset('websiteview/assets/images/user-icon/img-02.png') }}" alt="Image Description"></figure>
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);" class="ps-favorite"><i class="fas fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                 
                         
                       
                            </div>
                        </div>
                        <!-- VISIT ADS END -->
                    </div>
                    <!-- MAIN CONTENT END -->
                    <!-- SIDEBAR START -->
                    <div class="col-lg-4">
                        <div class="ps-gridList__searchArea ps-seller">
                            <h6>About Seller</h6>
                            <div class="ps-seller__detail">
                                <div class="ps-seller__user">

                                    <figure><img src="{{asset('websiteview/assets/images/listing-single/icon/img-02.jpg') }}" alt="Image Description"></figure>
                                    <div class="ps-seller__description">
                                        <h6>Lorina Statham</h6>
                                        <div class="ps-h5">Status: 
                                            <a>
                                                <span><em class="ps-online"></em></span><em>Online</em> 
                                            </a>
                                        </div>
                                        <p>Member Since:  Jun 27, 2019</p>
                                    </div>
                                </div>
                                <div class="ps-seller__btn">
                                    <a href="javascript:void(0);" class="ps-btngreen ps-btn"><span><span class="ps-seller__hidden">(+1) 234 XXX XXXX</span><span class="ps-seller__visible">(+1) 234 677 8899</span><span class="d-block">Click to Reveal Phone No.</span></span><span><i class="ti-lock"></i></span></a>
                                    <a href="javascript:void(0);" class="ps-btnorange ps-btn"><span><span class="ps-seller__hidden">Rajkot, India </span><span class="ps-seller__visible">Rajkot, India Street 4</span><span class="d-block">Click to Get Directions</span></span><span><i class="ti-location-arrow"></i></span></a>
                                    <a class="btn ps-btn"><span>View All Ads</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="ps-gridList__searchArea ps-contact-seller">
                            <h6>Contact Seller</h6>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Enter Keyword"></textarea>
                                </div>
                                <button class="btn ps-btn">Send Now</button>
                            </form>
                        </div>
                        <div class="ps-gridList__searchArea ps-safety-seller">
                            <h6>Safety Tips</h6>
                            <ul>
                                <li>Adipisicing elit sed do eiusmod tempor incide dunt ut labore et dolore.</li>
                                <li>Ut enim ad minim veniamnostrud exercitation ullamco laboris nisi ut aliquip como.</li>
                                <li>Duis aute irure dolor in reprehenderit.</li>
                                <li>Voluptate velit esse cillum dolore eu fugiat.</li>
                            </ul>
                        </div>
                       <!--  <div class="ps-gridList__searchArea ps-reportAd-seller">
                            <h6>Report Ad</h6>
                            <form class="ps-form">
                                <div class="ps-select ps-sort">
                                    <select class="chosen-select locations form-control" data-placeholder="Country" name="reason">
                                        <option value="Location">Select Reason</option>
                                        <option value="United State">United State</option>
                                        <option value="Canada">Canada</option>
                                        <option value="England">England</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="New Zealand">New Zealand</option>
                                    </select>
                                </div>
                                <textarea class="form-control" placeholder="Description"></textarea>
                                <button class="btn ps-btn">Report Now</button>
                            </form>
                        </div> -->
                    </div>
                    <!-- SIDEBAR END -->
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};
  jQuery=jQuery.noConflict();
    jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
       visible: 4,
         auto: 3,
         wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});

    
var marked;
function imageswitcher(imagename,obj){  
    //var newImg    =   imagename.src;
    jQuery(obj).parent().css('border','1px solid #ccc');
    if(marked)jQuery(marked).parent().css('border','');
    marked=obj;
    jQuery('#image1').attr('src',imagename);
    var options =   {
        zoomrange: [4, 4],
        magnifiersize: [730,600],
        magnifierpos: 'right',
        cursorshade: true,
        
        largeimage: imagename
         //<-- No comma after last option!
    }
        jQuery('#image1').addimagezoom(options);
}
</script>
<script type="text/javascript">
//<![CDATA[
    Event.observe(window, 'load', function() {
        jQuery('#image1').addimagezoom({    
        zoomrange: [4, 4],
        magnifiersize: [730,600],
        magnifierpos: 'right',
        cursorshade: true,      
        largeimage: 'https://www.lilyboutique.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/1/4/146_29_.jpg' //<-- No comma after last option!
    })
    });
//]]>
</script>

    @endsection