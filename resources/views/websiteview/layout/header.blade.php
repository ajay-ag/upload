
<div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-11 col-xl-2">
            <h1 class="mb-0 site-logo">
              <a href="{{ url('/') }}" class="text-white h2 mb-0"><img src="{{ asset('websiteview/assets/images/logo.png')}}"></a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">

                <li class="{{ (Request::route()->getName() == 'home_auth') ? 'active' : '' }}"><a href="{{ url('/') }}"><span>Home</span></a></li>
                <li class=" {{ request()->segment(1)=='category' || request()->segment(1)=='advertise' || request()->segment(1)=='advertise_detail'  ? 'active' : '' }}"><a href="{{ url('category') }}"><span>Categories</span></a></li>
                 @if(!Auth::user())
                <li class=""><a href="{{ url('login') }}"><span>Post Add</span></a></li>
                @endif
                @if(Auth::check())
                <li class="has-children">
               {{--    <a href="javascript:void(0);" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        <figure class="d-inline-block">
                                            <img src="{{ Helper::getProfileImage()}}" alt="Image Description">
                                        </figure>
                                      
                                    </a>--}}
                  <a href="javascript:void(0);"><span>Welcome</span></a>
                  <ul class="dropdown arrow-top">
                    <li><a href="{{ url('user/dashboard')}}" target="_blank">Dashboard</a></li>
                    <li><a href="{{ url('/user/post') }}" target="_blank">My Posts</a></li>
                    <li><a href="{{ url('/user/change-password') }}" target="_blank">Change Password</a></li>
                    <li><a href="{{ url('user/my-lead') }}" target="_blank">My Lead</a></li>
                    <li><a href="{{ route('messages.create') }}" target="_blank">Message</a></li>
                    <li><a href="{{ route('users.logout') }}">Logout</a></li>

                    
                  </ul>
                </li>
                @endif

               {{-- <li class="has-children">
                  <a href="about.html"><span>Dropdown</span></a>
                  <ul class="dropdown arrow-top">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                    <li class="has-children">
                      <a href="#">Dropdown</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                        <li><a href="#">Menu Four</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href=""><span>Listings</span></a></li>
                <li><a href=""><span>About</span></a></li>
                <li><a href=""><span>Blog</span></a></li>
                <li><a href=""><span>Contact</span></a></li>--}}
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>
      
    </header>