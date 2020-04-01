@extends('admin.layout.app')
@section('title','Service')
@push('style')
<style type="text/css">
  
.table thead th {
    vertical-align: bottom !important;
    border-bottom: 0px !important;
    color: #212121;
    font-size: .8rem;
    font-weight: 400;
}

</style>
@endpush
@section('content')
@component('component.heading',[

'page_title' => 'Service',
'icon' => 'ik ik-layers' ,
'tagline' =>'This is service table.' ,
])
<a href="{{ route('admin.services.create') }}" class="btn btn-outline-dark">
    <i class="ik ik-plus"></i>Add Service</a>
@endcomponent

<div class="row" id="dd">
     @include('component.error')
  

    <div class="col-sm-12">
        <div class="card p-3">
       
                <div class="dt-responsive">
                       <table class="table w-100" id="serviceDataTable" data-url="{{ route('admin.services.list') }}">
                        <thead>
                            <tr>
                                <td style="width:5%">No</td>
                                <td style="width:25%">Name</td>
                                <td style="width:25%" class="text-center" data-orderable="false">Image</td>
                                <th style="width:15%" data-orderable="false" class="status">Status</th>
                                <td style="width:15%" data-orderable="false" class="text-center">Actoin</td>
                            </tr>
                        </thead>
                    </table>
                </div>
  
        </div>
    </div>
</div>

<!-- Sub Category -->

<div id="load-modal"></div>
@endsection


@push('css')
   
   <link rel="stylesheet" href="{{ asset('css/all.css') }}"/> 
    <link rel="stylesheet" href="{{ asset('css/bootstrap-iconpicker.min.css') }}"/>
@endpush

@push('js')
   
    <script src="{{ asset('js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}" ></script>
   
    <script src="{{ asset('js/category.js') }}"></script>
@endpush



@push('scripts')
<script>
        var table2 = $('#serviceDataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#serviceDataTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    return $.extend({}, d, {});
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "service_name"
                },
                {
                    "data": "image"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                }
            ]
        });
    </script>

@endpush
