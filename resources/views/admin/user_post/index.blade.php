@extends('admin.layout.app')

@section('title' , $title)
@push('css')
  
    <link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">



@endpush
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Posts',
  
])
@endcomponent
@endsection
@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
               <div class="card-body">
      
                    <div class="row">

                        <div class="col-md-3 form-group">
                            <label for="date_from">From Date :</label>

                            <input type="text" class="form-control dateFrom" id="date_from" autocomplete="off"
                                   readonly="">

                        </div>

                        <div class="col-md-3 form-group">
                            <label for="date_to">To Date :</label>

                            <input type="text" class="form-control dateTo" id="date_to" autocomplete="off" readonly="">


                        </div>

                        <div class="col-md-3 form-group">
                            <label for="date_to">Status :</label>

                            <select name="status" id="status" class="form-control" style="width: 100%;">
                                <option value="">Select Status</option>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="canceled">Canceled</option>
                                <option value="expired">Expired</option>

                            </select>


                        </div>

                        <div class="col-md-3 form-group">
                            <div style="margin-top: 24px;"></div>
                            <button class="btn btn-danger mt-2" type="button" id="btn_clear" name="btn_clear" >Clear
                            </button>
                            <button type="submit" id="search" class="btn btn-success mt-2"><i
                                    class="fa fa-search"></i>&nbsp;Search
                                    
                            </button>


                        </div>


            
     

            </div>
        </div>

        </div>
</div>
</div>
<div class="row">
        <div class="col-md-12">
            @include('component.error')
            <div class="card card-primary card-outline">
          

            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table" id="userTable" data-url="{{ route('admin.post_user.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                            <th style="width:1%">No</th>
                            <th style="width:10%" data-orderable="false">Image</th>
                            <th style="width:25%" data-orderable="true">Title</th>
                            <th style="width:20%" data-orderable="true">Date</th>
                            <th style="width:20%" data-orderable="true">Category</th>
                            <th style="width:25%" data-orderable="true">Sub Category</th>
                            <th style="width:30%" data-orderable="true">Published By</th>
                            <th style="width:20%" data-orderable="false">Status</th>
                       
                            <th style="width:10%" data-orderable="false">Action</th>
                </tr>
                </thead>
                <tbody>
                
     
                
                </tbody>
              
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
</div>
</div>
<div id="load-modal"></div>

@endsection
@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/js/user_post/user-post-datatable.js') }}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
@endpush
