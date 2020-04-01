@extends('admin.layout.app')
@section('title','Dashboard')
@section('page_title','Dashboard')

@section('breadcrumbs')
@include('admin.layout.breadcrumb', ['breadcrumbs' => [
                 'Dashboard' => route('admin.dashboard'),
                
                ]])
@endsection
@section('content')
<div class="container-fluid">
        <div class="row">
        
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Dashboard</h5>
              </div>
              <div class="card-body">
               

                <p class="card-text">Welcome to dashboard</p>
               
              </div>
            </div>

            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
@endsection
