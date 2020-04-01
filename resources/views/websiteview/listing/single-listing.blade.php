    @extends('websiteview.layout.app')
    @section('content')

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
    @endsection
