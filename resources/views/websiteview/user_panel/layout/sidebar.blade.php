<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">City Post</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Helper::getProfileImage()}}" alt="" id="sidebarimage" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="" class="d-block">{{Auth::user()->name ?? '' }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
     
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('user/dashboard')}}" class="nav-link {{ request()->is('user/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/user/post') }}" class="nav-link {{ request()->is('user/post') || request()->is('user/create-post') ||  request()->segment(2)=='edit-post' ? 'active' : '' }}">
              <i class="nav-icon fas fa-clone"></i>
              <p>
               My Posts
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/user/my-favourite') }}" class="nav-link {{ request()->is('user/my-favourite') ? 'active' : '' }}">
              <i class="nav-icon fas fa-heart"></i>
              <p>
               My Favourite
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/user/change-password') }}" class="nav-link {{ request()->is('user/change-password') ? 'active' : '' }}">
              <i class="nav-icon fas fa-unlock-alt"></i>
              <p>
               Change Password
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('user/profile') }}" class="nav-link {{ request()->is('user/profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Profile Setting
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('user/my-lead') }}" class="nav-link {{ request()->is('user/my-lead') ? 'active' : '' }}">
              <i class="nav-icon fas fa-thumbtack"></i>
              <p>
               My Lead
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
               Logout
                
              </p>
            </a>
          </li>
          

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>