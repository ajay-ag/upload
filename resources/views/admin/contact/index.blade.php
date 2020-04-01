@extends('admin.layout.app')
@section('title' , $title)

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">
<link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">
@endpush
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Contact Us',
   
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
                        <div class="col-md-2 form-group">
                            <label for="date_from">From Date :</label>
                            <input type="text" class="form-control dateFrom" id="date_from" autocomplete="off"
                                   readonly="">
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="date_to">To Date :</label>

                            <input type="text" class="form-control dateTo" id="date_to" autocomplete="off" readonly="">
                        </div>
                        <div class="col-md-2 form-group">
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
              <table  class="table" id="contactTable" data-url="{{ route('admin.contactus.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                    <th style="width:1%">No</th>
                    <th style="width:15%" data-orderable="true">Date</th>
                    <th style="width:25%" data-orderable="true">Name</th>
                    <th style="width:25%" data-orderable="true">Email</th>
                    <th style="width:20%" data-orderable="true">Mobile</th>
                    <th style="width:15%" data-orderable="false">Subject</th>
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
<script src="{{ asset('assets/admin/js/contact/contact-datatable.js') }}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

@endpush

