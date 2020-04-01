@extends('admin.layout.app')
@section('title','Dashboard')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Dashboard',
    
])
@endcomponent
@endsection
@section('content')
 <div class="container-fluid">
      
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total user</span>
                <span class="info-box-number">{{ $user_count ?? '' }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ad pending</span>
                <span class="info-box-number">{{$pending_count ?? ''}}</</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ad Approved</span>
                <span class="info-box-number">{{$approved_count ?? ''}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-times-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ad cancel</span>
                <span class="info-box-number">{{$canceled_count ?? ''}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
@endsection
