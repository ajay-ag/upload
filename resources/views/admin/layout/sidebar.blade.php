<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard')}}" class="brand-link">
      <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">City Post</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ $adminlogin->profile_image ?? '' }}" alt="" id="sidebarimage" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="{{ route('admin.dashboard')}}" class="d-block">{{ $adminlogin->name ?? ''}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
     
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard')}}" class="nav-link {{ (Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.site-user.index') }}" class="nav-link {{ (Request::route()->getName() == 'admin.site-user.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-friends"></i>
           
              <p>
               Users
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.plan.index') }}" class="nav-link @if(Request::fullUrl() === route('admin.plan.index')) active @endif">
              <i class="nav-icon fas fa-cube"></i>
           
              <p>
               Package
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.post.index') }}" class="nav-link {{ (Request::route()->getName() == 'admin.post.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tag"></i>
              <p>
               Posts
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.newsletter.index') }}" class="nav-link  {{ (Request::route()->getName() == 'admin.newsletter.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
               Newsletter
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.contact.index') }}" class="nav-link  {{ (Request::route()->getName() == 'admin.contact.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-phone-square-alt"></i>

              <p>
               Contact Us
                
              </p>
            </a>
          </li>
         {{--  <li class="nav-item">
            <a href="{{ route('admin.about.index') }}" class="nav-link  {{ (Request::route()->getName() == 'admin.about.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-info-circle"></i>

              <p>
               About Us
                
              </p>
            </a>
          </li>--}}
          <!-- menu-open -->
   

           <li class="nav-item has-treeview  @if(Request::segment(2)=='settings' || Request::segment(2)=='mailsetup' || Request::segment(2)=='post-attribute' || Request::segment(2)=='category' || Request::segment(2)=='subcategory' || Request::segment(2)=='brand' || Request::segment(2)=='homepagebanners' || Request::segment(2)=='staticpages') menu-open @else @endif">
            <a href="#" class="nav-link @if(Request::segment(2)=='settings' || Request::segment(2)=='mailsetup' || Request::segment(2)=='post-attribute' || Request::segment(2)=='category' || Request::segment(2)=='subcategory' || Request::segment(2)=='brand' || Request::segment(2)=='homepagebanners' || Request::segment(2)=='staticpages') active @else @endif"">
              <i class="nav-icon fas fa-cog"></i>
              <p>
               Settings
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.settings.index') }}" class="nav-link @if(Request::segment(2)=='settings') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>

                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.mailsetup.index') }}" class="nav-link @if(Request::segment(2)=='mailsetup') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Mail Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.post-attribute.index') }}" class="nav-link @if(Request::segment(2)=='post-attribute') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Post Attribute</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.category.index')}}" class="nav-link @if(Request::segment(2)=='category') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.subcategory.index')}}" class="nav-link @if(Request::segment(2)=='subcategory') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Subcategory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.brand.index') }}" class="nav-link @if(Request::segment(2)=='brand') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.homepagebanners.create') }}" class="nav-link @if(Request::segment(2)=='homepagebanners') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Home Banner</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.staticpages.index') }}" class="nav-link @if(Request::segment(2)=='staticpages') active @else @endif">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>Static Pages</p>
                </a>
              </li>

           
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>