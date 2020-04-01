@extends('admin.layout.app')
@section('title','Post Attribute')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">
@endpush

@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Post Attribute',
    'action' =>  route('admin.post-attribute.create'),
    'text' => 'Add Post Attribute',
])
@endcomponent
@endsection
@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-md-3">
            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
            

            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table" id="serviceDataTable" data-url="{{ route('admin.post-attribute.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                     <th style="width:5%">No</th>
                    <th style="width:25%">Category</th>
                    <th style="width:25%">Sub Category</th>
                    <th style="width:15%" data-orderable="false" class="text-center">Actoin</th>
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

@endsection
<!-- DataTables -->
@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/js/setting/post-attribute-datatable.js') }}"></script>
@endpush
