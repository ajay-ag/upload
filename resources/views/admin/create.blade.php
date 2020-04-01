@extends('admin.layout.app')
@section('title','Page')
@section('page_title','Page')

@section('breadcrumbs')
@include('admin.layout.breadcrumb', ['breadcrumbs' => [

                 'Pages' => route('admin.dashboard'),
                 'Add page' => '',
                
                ]])

@endsection
@section('content')
<div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Example</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Address</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                
              
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <div class="float-right">
                  <button type="button" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>

                </div>
                </div>
              </form>
            </div>
    </div>
  </div>
</div>


@endsection
