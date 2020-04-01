@extends('admin.layout.app')
@section('title','Post Remarks')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">
@endpush
@section('wrapper')
@component('component.heading',[

'page_title' => 'Post Remarks',
'action' =>  route('admin.post-remark.create'),
'text' => 'Add Post Remarks',
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
            <div class="card-body table-responsive">
              <table  class="table" id="serviceDataTable" data-url="{{ route('admin.post-remark.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                    <th style="width:5%">No</th>
                    <th style="">Name</th>
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

<!-- Sub Category -->

<div id="load-modal"></div>
@endsection




@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/js/setting/postremark-datatable.js') }}"></script>

@endpush

