@extends('admin.layout.app')
@section('title','Profile Overview')
@section('wrapper')
@component('component.heading',[

'page_title' => 'Overview',

])

@endcomponent
@endsection
@section('content')
<div class="container-fluid">
        <div class="row">
       

            <!-- Profile Image -->
             @include('admin.profile.card-profile')
            <!-- /.card -->

            <!-- About Me Box -->
           
            <!-- /.card -->
          
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="{{ route('admin.overview.index')}}">Overview</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.profile.index')}}">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.change-password.index')}}" >Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
               
                  <div class="tab-content">
                    <div class="card-body box-profile">


              
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item" style="border: none;">
                          <b>Name :</b> <a class="ml-2"> {{ $adminlogin->name }}</a>
                        </li>
                        <li class="list-group-item" style="border: none;">
                          <b>Email :</b> <a class="ml-2"> {{ $adminlogin->email }}</a>
                        </li>
                        
                      </ul>

                
              </div>
                    
                  </div>
               

                 
                  <!-- /.tab-pane -->
             
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection
