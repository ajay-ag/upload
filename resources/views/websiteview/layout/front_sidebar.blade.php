
<div class="col-md-4 col-lg-4  col-sm-12">
                <div class="sidebar">
                    <!-- User Widget -->
                   <div class="widget user-dashboard-profile">
                        <!-- User Image -->
                        <div class="profile-thumb">
                            <img src="{{ asset('storage/user-thumb.jpg')}}" alt="" class="rounded-circle">
                        </div>
                        <!-- User Name -->
                        <h5 class="text-center">Samanta Doe</h5>
                        <p class="user-p">Joined February 06, 2017</p>
                    
                    </div>
                    <!-- Dashboard Links -->
                    <div class="widget user-dashboard-menu">
                        <ul>
                            <li class="{{ request()->is('post','create-post') ? 'active' : '' }}    {{ (request()->segment(1) == 'edit-post') ? 'active' : '' }}">
                                <a href="{{ url('/post') }}"><i class="fa fa-user"></i>   My Posts</a></li>
                            <li>
                                <a href="{{ url('/my-favourite') }}" class="{{ request()->is('my-favourite') ? 'active' : '' }}"><i class="fa fa-heart"></i>My Favourite </a>
                            </li>
                            <li>
                                <a href="{{ url('/messages') }}" class="{{ request()->is('messages') ? 'active' : '' }}"><i class="fa fa-location-arrow"></i> Chat </a>
                            </li>
                            <li>
                                <a href="{{ url('/change-password') }}" class="{{ request()->is('change-password') ? 'active' : '' }}"><i class="fa fa-key"></i>Privacy</a>
                            </li>
                            <li>
                                <a href="{{ url('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}"><i class="fa fa-user"></i>   Profile Setting</a>
                            </li>
                            <li>
                                <a href="{{ url('my-lead') }}" class="{{ request()->is('my-lead') ? 'active' : '' }}"><i class="fa fa-location-arrow"></i>   My Lead</a>
                            </li>
                          
                            <li>
                                <a href="logout.html"><i class="fa fa-cog"></i>   Logout</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
