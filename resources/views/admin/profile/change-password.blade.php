@extends('admin.layout.app')
@section('title','Change Password')
@section('wrapper')
@component('component.heading',[

'page_title' => 'Change Password',

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
                  <li class="nav-item"><a class="nav-link " href="{{ route('admin.overview.index')}}">Overview</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('admin.profile.index')}}">Profile</a></li>
                  <li class="nav-item"><a class="nav-link active" href="{{ route('admin.change-password.index')}}" >Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                  @if(count($errors) > 0)
                  <div class="col-12">
                   <div class="form-group">
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <i class="ik ik-x"></i>
                    </button>
                       
                           @foreach ($errors->all() as $error)
                           <p class="mb-1">{{ $error }}</p>
                           @endforeach

                       </div>
                   </div>
                  </div>
                  @endif
                <div class="tab-content">
 
                    <form class="form-horizontal" action="{{ route('admin.password.change') }}" method="post" id="passwordForm" name="passwordForm">
                      <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                      @csrf
                      <div class="form-group">
                        <label for="old_password">Current Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" name="old_password" id="old_password">
                      </div>
                      <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" name="password" id="password">    
                      </div>
                       <div class="form-group ">
                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                     
                          <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"> 
                      </div>
                      <div class="form-group">
                        
                          <button type="submit" name="save" class="btn btn-success" id="m_login_reset_pwd_submit"><span id="sid" role="status" aria-hidden="true"></span> Update</button>
                      
                      </div>
                    </form>
               
                  <!-- /.tab-pane -->
                </div>
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
@push('js')
<script src="{{asset('assets/admin/js/profile.js')}}" type="text/javascript"></script>
@endpush

