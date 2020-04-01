@extends('websiteview.user_panel.layout.app')
@section('title' , 'Post')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Post',
    'action'     => route('add.post'),
    'text'       => 'Add Post',
    
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
            <div class="card card-primary card-outline">
           

            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table " id="postTable" data-url="{{ route('user.post.list') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                      <th style="width:5%">No</th>
                      <th style="width:25%" class="text-left" data-orderable="false">Image</th>
                      <th style="width:25%">Title</th>
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








@endsection

@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script src="{{ asset('assets/website/js/post/post-datatable.js') }}"></script>


    <script>

        $(document).on('keyup', '#price', function () {

            this.value = this.value
                .replace(/[^\d.]/g, '')             // numbers and decimals only
                .replace(/(^[\d]{10})[\d]/g, '$1')   // not more than 2 digits at the beginning
                .replace(/(\..*)\./g, '$1')         // decimal can't exist more than once
                .replace(/(\.[\d]{2})./g, '$1');    // not more than 4 digits after decimal
        });


        $("#category").select2({
            allowClear: true,
            placeholder: 'Select Category',
            multiple: false
        });
        $("#subcategory").select2({
            allowClear: true,
            placeholder: 'Select Sub Category',
            multiple: false
        });


        function getSub(id) {

            if (id == "") {
                $('#subcategory').html('');
                $('#attribute').html('');
            } else {
                $('#subcategory').html('');
                $('#attribute').html('');
                $('#subcategory').prepend($('<option></option>').html('Loading...'));
            }
            if (id != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: '{{ route('user.subcategory') }}',
                    method: "POST",
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                        } else {
                            $('#subcategory').html(result);
                        }
                    }
                });
            }
        }

        function getAttributes(id) {


            if (id != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: '{{ route('user.post.attribute') }}',
                    method: "POST",
                    data: {
                        category_id: $('#category').val(),
                        sub_category_id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                        } else {
                            $('#attribute').html(result);
                        }
                    }
                });
            }
        }


    </script>

    <script type="text/javascript">


        $.validator.addMethod("pwcheck", function (value) {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
        });


        $('#post').validate({
            debug: false,
            // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {

                category: {
                    required: true,
                },
                subcategory: {
                    required: true,
                },
                title: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true,
                },

            },
            messages: {


                category: {
                    required: "Categoty is required.",
                },
                subcategory: {
                    required: "Sub Category is required.",
                },
                title: {
                    required: "Title is required.",
                },
                price: {
                    required: "Price is required.",
                },


            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger');
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                }
            },
            submitHandler: function (e) {
                $(".register_btn").addClass('fa fa-spinner fa-spin');
                return true;
            }
        })

    </script>
@endpush
