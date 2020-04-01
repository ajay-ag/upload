    @extends('websiteview.layout.app')
    @section('content')
    <div class="ps-main-banner">
        <div class="ps-banner-img3">
            <div class="ps-dark-overlay2">
                <div class="container">
                    <div class="ps-banner-contentv3">
                        <h4>Search Results</h4>
                        <p><a href="index-2.html">Home</a> <span><i class="ti-angle-right"></i></span> Listings Grid</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BANNER END -->
    <!-- MAIN START -->
    <main class="ps-main">
        <section class="container">
            <div class="row ps-uniqueGadgets ps-gridList ps-main-section">
                <!-- SIDEBAR START -->
                <div class="col-md-5 col-lg-4 col-xl-3">
                    <div class="ps-gridList__searchArea">
                        <h6>Search Again</h6>
                        <form class="ps-form ps-main-form ps-side-mainForm">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Keyword" aria-label="Enter Keyword" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn" type="button" id="button-addon1"><i class="ti-search"></i></button>
                                </div>
                            </div>
                            <div class="ps-geo-location ps-location input-group">
                                <input type="text" class="form-control" placeholder="Location*">
                                <a href="javascript:void(0);" class="ps-location-icon ps-index-icon"><i class="ti-target"></i></a>
                                <a href="javascript:void(0);" class="ps-arrow-icon ps-index-icon"><i class="ti-angle-down"></i></a>
                                <div class="ps-distance">
                                    <div class="ps-distance__description">
                                        <label for="amountfive">Distance:</label>
                                        <input type="text" id="amountfive" readonly>
                                    </div>
                                    <div id="slider-range-minTwo"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__categories">
                        <h6>Categories</h6>
                        <div class="ps-gridList__checkbox">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check1">
                                <label class="form-check-label" for="check1">Show All <span>(256)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check2">
                                <label class="form-check-label" for="check2">Mobiles/Tablets <span>(53,165)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check3">
                                <label class="form-check-label" for="check3">Vehicles <span>(7562)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check4">
                                <label class="form-check-label" for="check4">Houses <span>(35)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check5">
                                <label class="form-check-label" for="check5">Land & Plots <span>(845)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check6">
                                <label class="form-check-label" for="check6">Entertainment <span>(4223)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check7">
                                <label class="form-check-label" for="check7">Animals & Pets <span>(5624)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check8">
                                <label class="form-check-label" for="check8">Kids Zone <span>(1245)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check9">
                                <label class="form-check-label" for="check9">Beauty & Fashion <span>(06)</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__priceRange">
                        <h6>Price Range</h6>
                            <input type="text" id="amount" disabled>
                        <div id="slider-range"></div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__categories">
                        <h6>Condition</h6>
                        <div class="ps-gridList__checkbox">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check10">
                                <label class="form-check-label" for="check10">Show All <span>(256)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check11">
                                <label class="form-check-label" for="check11">Brand New <span>(53,165)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check12">
                                <label class="form-check-label" for="check12">Almost Like New <span>(7562)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check13">
                                <label class="form-check-label" for="check13">Gently Used <span>(35)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check14">
                                <label class="form-check-label" for="check14">Heavily Used <span>(845)</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__categories">
                        <h6>Ad Type</h6>
                        <div class="ps-gridList__checkbox">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check15">
                                <label class="form-check-label" for="check15">Show All <span>(256)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check16">
                                <label class="form-check-label" for="check16">Featured Ads <span>(53,165)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check17">
                                <label class="form-check-label" for="check17">Regular Ads <span>(7562)</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__priceRange ps-gridList__areaUnit">
                        <h6>Area Unit</h6>
                        <form class="ps-form">
                            <div class="ps-select ps-sort">
                                <select class="chosen-select locations form-control" data-placeholder="Country" name="locations">
                                    <option value="Location">Area Unit</option>
                                    <option value="United State">United State</option>
                                    <option value="Canada">Canada</option>
                                    <option value="England">England</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="New Zealand">New Zealand</option>
                                </select>
                            </div>
                            <div class="ps-select ps-sort">
                                <select class="chosen-select locations form-control" data-placeholder="Country" name="locations">
                                    <option value="Location">No. of Rooms</option>
                                    <option value="United State">United State</option>
                                    <option value="Canada">Canada</option>
                                    <option value="England">England</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="New Zealand">New Zealand</option>
                                </select>
                            </div>
                            <div class="ps-select ps-sort">
                                <select class="chosen-select locations form-control" data-placeholder="Country" name="locations">
                                    <option value="Location">No. of Washrooms</option>
                                    <option value="United State">United State</option>
                                    <option value="Canada">Canada</option>
                                    <option value="England">England</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="New Zealand">New Zealand</option>
                                </select>
                            </div>
                        </form>
                            <input type="text" id="amount2" disabled>
                        <div id="slider-rangeTwo"></div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__date">
                        <h6>By Year</h6>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Starting Date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" placeholder="Ending Date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__priceRange">
                        <h6>Mileage</h6>
                            <input type="text" id="amountThree" disabled>
                        <div id="slider-rangeThree"></div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__priceRange ps-gridList__areaUnit">
                        <h6>Misc</h6>
                        <form class="ps-form">
                            <div class="ps-select ps-sort">
                                <select class="chosen-select locations form-control" data-placeholder="Country" name="locations">
                                    <option value="Location">Registered Location</option>
                                    <option value="United State">United State</option>
                                    <option value="Canada">Canada</option>
                                    <option value="England">England</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="New Zealand">New Zealand</option>
                                </select>
                            </div>
                            <div class="ps-select ps-sort">
                                <select class="chosen-select locations form-control" data-placeholder="Country" name="locations">
                                    <option value="Location">Fuel Type</option>
                                    <option value="United State">United State</option>
                                    <option value="Canada">Canada</option>
                                    <option value="England">England</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="New Zealand">New Zealand</option>
                                </select>
                            </div>
                        </form>
                        <div class="ps-gridList__checkbox">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check18">
                                <label class="form-check-label" for="check18">Show All <span>(256)</span></label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="check19">
                                <label class="form-check-label" for="check19">Ads With Photos <span>(53,165)</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__filter">
                        <h6><span class="d-block">Click “Apply Filter” to</span>get your desired search result</h6>
                        <button class="btn ps-btn">Apply Filter</button>
                        <a href="javascript:void(0);" class="ps-filter__h"><span><i class="ti-reload"></i></span>Reset Filter</a>
                    </div>
                    <div class="ps-gridList__searchArea ps-gridList__ad">
                        <a href="javascript:void(0);"><figure><img src="{{asset('websiteview/assets/images/ad-img.jpg') }}" alt="Image Description"></figure></a>
                        <span>Advertisement  255px X 255px</span>
                    </div>
                </div>
                 <!-- SIDEBAR END -->
                 <!-- UNIQUE GADGETS START -->
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="ps-uniqueGadgets">
                        <div class="ps-uniqueGadgets__heading">
                            <p>12,076 Record Found</p>
                            <h4>Results in “Unique Gadgets”</h4>
                        </div>
                        <div class="ps-uniqueGadgets__content">
                            <p>Showing 1 - 30 of 12,076 results</p>
                            <div class="d-flex flex-wrap">
                                <label class="ps-sort">
                                    <select class="form-control">
                                        <option selected="" hidden="">Sort By:</option>
                                        <option>All</option>
                                        <option>Half</option>
                                    </select>
                                </label>
                                <button class="btn ps-btn ps-outline-btn"><i class="ti-map"></i></button>
                                <button class="btn ps-btn ps-outline-btn"><i class="ti-view-list"></i></button>
                                <button class="btn ps-btn ps-active"><i class="ti-layout-grid2"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-featured--cards ps-gridList__cards">
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/featured/img-01.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
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
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);" class="ps-favorite"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/featured/img-02.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
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
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);" class="ps-favorite"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/featured/img-03.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
                                </figure>
                                <span class="ps-tag">Featured</span>
                                <span class="ps-tag--arrow"></span>
                                <div class="card-body">
                                    <h6>$1,200</h6>
                                    <p class="card-text">Mac Air Book Pro, Slightly Used</p>
                                    <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                    <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>
                                    <figure><img src="{{asset('websiteview/assets/images/user-icon/img-03.jpg') }}" alt="Image Description"></figure>

                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/featured/img-04.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
                                </figure>
                                <span class="ps-tag">Featured</span>
                                <span class="ps-tag--arrow"></span>
                                <div class="card-body">
                                    <h6>$1,149</h6>
                                    <p class="card-text">Brand New Touch Book For Sale</p>
                                    <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                    <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>

                                    <figure><img src="{{asset('websiteview/assets/images/user-icon/img-04.jpg') }}" alt="Image Description"></figure>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/grid-list/img-01.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
                                </figure>
                                <div class="card-body">
                                    <h6>$1,200</h6>
                                    <p class="card-text">Mac Air Book Pro, Slightly Used</p>
                                    <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                    <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>
                                    <figure><img src="{{asset('websiteview/assets/images/user-icon/img-05.jpg') }}" alt="Image Description"></figure>

                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/grid-list/img-02.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
                                </figure>
                                <div class="card-body">
                                    <h6>$1,149</h6>
                                    <p class="card-text">Brand New Touch Book For Sale</p>
                                    <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                    <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>
                                    <figure><img src="{{asset('websiteview/assets/images/user-icon/img-06.jpg') }}" alt="Image Description"></figure>

                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="ps-grid--card">
                                <div class="card">
                                    <figure>
                                        <img src="{{asset('websiteview/assets/images/grid-list/img-03.png') }}" class="card-img-top" alt="Image Description">
                                        <div></div>
                                    </figure>
                                    <div class="card-body">
                                        <h6>Want To See Your<span class="d-block"> Add Here?</span></h6>
                                        <p class="card-text">Click “Singup” button below to post your free ad here</p>
                                        <button class="btn ps-btn">Signup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                                <div class="card">
                                    <figure>

                                        <img src="{{asset('websiteview/assets/images/grid-list/img-04.jpg') }}" class="card-img-top" alt="Image Description">
                                        <div></div>
                                    </figure>
                                    <div class="card-body">
                                        <h6>$1,149</h6>
                                        <p class="card-text">Brand New Touch Book For Sale</p>
                                        <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                        <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>
                                        <figure><img src="{{asset('websiteview/assets/images/user-icon/img-07.jpg') }}" alt="Image Description"></figure>

                                    </div>
                                    <ul class="list-group">
                                        <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                    </ul>
                                </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="card">
                                <figure>
                                    <img src="{{asset('websiteview/assets/images/grid-list/img-05.jpg') }}" class="card-img-top" alt="Image Description">
                                    <div></div>
                                </figure>
                                <div class="card-body">
                                    <h6>$1,200</h6>
                                    <p class="card-text">Mac Air Book Pro, Slightly Used</p>
                                    <span class="d-block"><i class="ti-layers"></i> <a href="javascript:void(0);">Electronics</a></span>
                                    <span><i class="ti-time"></i> <span>Jun 27, 2019</span></span>
                                    <figure><img src="{{asset('websiteview/assets/images/user-icon/img-08.jpg') }}" alt="Image Description"></figure>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item"><span><i class="ti-map"></i> <a href="javascript:void(0);">Rajkot, India</a></span><a href="javascript:void(0);"><i class="far fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="ps-page">
                                <div class="ps-button-left">
                                    <button class="btn ps-btn"><span class="lnr lnr-chevron-left"></span></button>
                                </div>
                                <div class="ps-button-num">
                                    <button class="btn ps-btn"><span>1</span></button>
                                    <button class="btn ps-btn ps-active"><span>2</span></button>
                                    <button class="btn ps-btn"><span>3</span></button>
                                    <button class="btn ps-btn"><span>4</span></button>
                                    <button class="btn ps-btn"><span>...</span></button>
                                    <button class="btn ps-btn"><span>50</span></button>
                                </div>
                                <div class="ps-button-right">
                                    <button class="btn ps-btn"><span class="lnr lnr-chevron-right"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ps-no-ads">
                        <div>
                            <h5>No Results Found Yet :(</h5>
                            <h6>Click “Search Again” button below to search result</h6>
                            <button class="btn ps-btn">Search Again</button>
                        </div>
                    </div>
                </div>
                <!-- UNIQUE GADGETS END -->
            </div>
        </section>
    </main>

    @endsection
