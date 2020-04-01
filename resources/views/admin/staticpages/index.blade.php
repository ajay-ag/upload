@extends('admin.layout.app')
@section('title',$title)
@push('style')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">
@endpush
@section('wrapper')
@component('component.heading',[

'page_title' => 'Static Pages',

])

@endcomponent
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-md-12">
                @include('component.error')
            <div class="card card-primary card-outline">
          

            <!-- /.card-header -->
            <div class="card-body">
              <table  class="table" id="staticpagesTable" data-url="{{ route('admin.staticpages.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                                <th style="width:5%">No</th>
                                <th style="width:5%" class="text-center" data-orderable="false">Image</th>
                                <th style="width:25%">Name</th>
                                
                                <th style="width:15%" data-orderable="false" class="text-center">Action</th>
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



<!-- Sub Category -->

<div id="load-modal"></div>
@endsection


@push('js')
   
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
   

<script src="{{ asset('assets/admin/js/setting/staticpage-datatable.js') }}"></script>
@endpush

