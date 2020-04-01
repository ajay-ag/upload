@extends('websiteview.user_panel.layout.app')
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
<div class="col-md-12">

    <div class="row">
            <!-- Info Boxes Style 2 -->
           
        
            <!-- /.info-box -->
            <div class="col-md-3">
                <div class="info-box mb-3 bg-success">
                  <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Posts</span>
                    <span class="info-box-number">{{ $total_approve }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
          </div>
          <div class="col-md-3">
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pending Post</span>
                <span class="info-box-number">{{ $total_panding }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          <div class="col-md-3">
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-ban"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Cancelled Post</span>
                <span class="info-box-number">{{ $total_canceled }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          
            <!-- /.info-box -->

          

            <!-- PRODUCT LIST -->

            <!-- /.card -->
          </div>
          </div>
      </div>
  </div>
@endsection