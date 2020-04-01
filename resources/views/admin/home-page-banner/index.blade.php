@extends('admin.layout.app')

@section('title' , $title)

@push('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/mohithg-switchery/dist/switchery.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
@endpush


@section('content')

@component('component.heading',[
    'page_title' => 'Banner',
    'icon' => 'ik ik-image' ,
    'tagline' =>'This is home page banner table.' ,
    'action' => route('admin.homepagebanners.create') ,
    'action_icon' => 'ik ik-plus' ,
    'text' => 'Add Slider',
])
{{--  <a href="{{ route('admin.homepagebanners.index') }}" class="btn btn-outline-dark btn-rounded ml-3">
    <i class="ik ik-arrow-left "></i> Back
</a>--}}
@endcomponent
<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <table class="table w-100" id="bannderTable" data-url="{{ route('admin.bannder.list') }}">
                <thead>
                    <tr>
                        <td style="width:5%">#</td>
                        <td style="width:25%" class="text-center" data-orderable="false">Image</td>
                        <td style="width:40%">Title</td>
                        <td style="width:15%" data-orderable="false">Status</td>
                        <td style="width:15%" data-orderable="false" class="text-center">Actoin</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
@push('css')
   
@endpush

@push('scripts')

    <script type="text/javascript">

        
        var table = $('#bannderTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#bannderTable').attr('data-url'),
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
                    "data": "image"
                },
                {
                    "data": "title"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                }
            ]
        });

        $(document).ready(function () {


            $(document).on('click' ,'.delete-confrim', function (e) {
                
                e.preventDefault();

                var el = $(this);
                var url = el.attr('href');
                var id = el.data('id'); 
                var refresh = el.closest('table'); 
                console.log(refresh);

                message.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    customClass: {
                        confirmButton: 'btn btn-success shadow-sm mr-2',
                        cancelButton: 'btn btn-danger shadow-sm' 
                    },
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',                    
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                id : id ,
                                _method : 'DELETE'
                            }
                        }).always(function(respons){

                            table.ajax.reload();

                        }).done(function(respons){

                            message.fire({
                                type: 'success',
                                title: 'Success' ,
                                text: respons.message
                            });

                        }).fail(function(respons){

                            message.fire({
                                type: 'error',
                                title: 'Error',
                                text: 'something went wrong please try again !'
                            });

                        });
                    }
                });
            });

        });

    </script>

@endpush
