@extends('admin.layout.app')
@section('title','Package')


@section('wrapper')
@component('component.heading',[

'page_title' => 'Package',
'action' =>  route('admin.plan.create'),
'text' => 'Add Package',
])

@endcomponent
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} ">
@endpush

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
       <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
    </div>
    <div class="col-md-9">
      <div class="card">
        <!--Begin :: Body -->
        <div class="card-body">
          <table  class="table" id="planDatatable" data-url="{{ route('admin.plan.list') }}" style="width: 100%;">
            <thead class="thead-dark">
              <tr>
                <th style="width:10%">No</th>
                <th style="width:30%">Package Name</th>
                <!-- <th style="width:30%">Package listing count</th> -->
                <th style="width:30%">Price</th>
                <th style="width:10%" data-orderable="false" class="text-center">Status</th>
                <th style="width:10%" data-orderable="false" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>     
        </div>
        <!--end :: Body -->
      </div>

    </div>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/js/plan/plan-datatable.js') }}"></script>
@endpush
