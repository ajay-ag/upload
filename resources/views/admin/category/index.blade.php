@extends('admin.layout.app')
@section('title','Category')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">
@endpush
@section('wrapper')
@component('component.heading',[

'page_title' => 'Category',
'action' =>  route('admin.category.create'),
'text' => 'Add Category',
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
              <table  class="table " id="categoryTable" data-url="{{ route('admin.category.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                      <th style="width:5%">No</th>
                      <th style="width:25%" class="text-center" data-orderable="false">Image</th>
                      <th style="width:25%">Name</th>
                      <th style="width:10%" data-orderable="false">No of Post</th>
                      <th style="width:5%" data-orderable="false" class="status">Status</th>
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
<script type="text/javascript" src="{{ asset('assets/admin/js/jquery-ui.js') }}" ></script>
<script src="{{ asset('assets/admin/js/category.js') }}"></script>
<script src="{{ asset('assets/admin/js/setting/category-datatable.js') }}"></script>
@endpush

