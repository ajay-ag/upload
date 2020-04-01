<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- SEARCH FORM -->
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
  
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img  class="user-image img-circle elevation-2" src="{{ $adminlogin->profile_image ?? ''}}" alt="" id="imgname">
          <span class="d-none d-md-inline">{{ $adminlogin->name ?? '' }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img  class="img-circle elevation-2" src="{{ $adminlogin->profile_image ?? '' }}" alt="" id="imgname">

            <p>
              {{ $adminlogin->name ?? '' }}
             
            </p>
          </li>
          <!-- Menu Body -->
         
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('admin.overview.index') }}" class="btn btn-default btn-flat">Profile</a>
            <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat float-right"> Logout
            </a>
            
          </li>

        </ul>
      </li>
     
    </ul>
  </nav>