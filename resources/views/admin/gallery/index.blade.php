@extends('admin.layout.app')
@section('title','Gallery')
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

'page_title' => 'Gallery',
'icon' => 'ik ik-disc' ,
'tagline' =>'This is gallery table.' ,
])
<button type="buttom" class="btn btn-outline-dark call-model" data-url="{{ route('admin.gallery.create') }}"  data-target-modal="#addcategory">
    <i class="ik ik-plus"></i>Add Gallery
</button>
@endcomponent

<div class="row" id="dd">
     @include('component.error')
  

    <div class="col-sm-12">
        <div class="card p-3">
       
                <div class="dt-responsive">
                       <table class="table w-100" id="galleryDataTable" data-url="{{ route('admin.gallery.list') }}">
                        <thead>
                            <tr>
                                <td style="width:5%">No</td>
                                <td style="width:80%" class="text-center" data-orderable="false">Image</td>
                                <th style="width:5%" data-orderable="false" class="status">Status</th>
                                <td style="width:5%" data-orderable="false" class="text-center">Actoin</td>
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
   
   <!--  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css"/>
@endpush

@push('js')
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
   
    <script src="{{ asset('js/category.js') }}"></script>
@endpush



@push('scripts')
<script>
        var table2 = $('#galleryDataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
             "bFilter": false,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#galleryDataTable').attr('data-url'),
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
                    "data": "gal_image"
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
