@extends('websiteview.user_panel.layout.app')
@section('title' , 'Create Post Image')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Post Image',
    
    
])
@endcomponent
@endsection
@push('css')

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <style>


        .img-box {
            height: 300px;
            display: inline-block;
            position: relative;
            width: 100%;
            overflow: hidden;
            z-index: 90;
            margin: 10px 0;
            border-radius: 10px;
            box-shadow: 0 5px 15px 0 rgba(0, 0, 0, 0.3);
        }

        .img-box-background {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0px;
            left: 0px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% center;
            transition: transform 0.35s ease-out 0s;
        }

        
    </style>
@endpush
@section('content')
   
<div class="container-fluid">

  

                <div class="row">
                    <!-- SIDEBAR START -->

                <!-- SIDEBAR END -->

                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-9">
                       <div class="card">
                          <div class="card-body">


                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form method="post" action="{{route('create.post.image')}}" enctype="multipart/form-data"
                              class="dropzone" id="dropzone">
                            <input type="hidden" id="post_id" name="post_id" value="{{Request::segment(2)}}">
                            @csrf
                        </form>


                        <h4 style="text-align:center" class="mt-1"> Drag and Drop Images</h4>
                        <div style="text-align:center;color:red;"> First position image will be cover image
                        </div>


        
   


                                <div class="imgData mt-3">
                
                                   <div id="shortable" class="row"
                                         data-position-url="{{ route('gallery.image.position',Request::segment(2)) }}">
                                        {{-- <div class="row"> --}}
                                        @foreach($gallery as $img)

                                            <div class="col-md-2" style="float:left;" id="img_{{ $img->id}}">
                                                <input type="hidden" name="image_id[]" value="{{  $img->id  }}">

                                                <img src="{{asset('storage/'.$img->thumb_path )}}" alt="" width="100"
                                                     height="100">


                                                <a class="delete-confrim1"
                                                   data-imgid="{{$img->id}}"
                                                   data-hrefurl="{{ route('user.image.delete', ['id'=>$img->id]) }}"
                                                   href="#" class="button gray">
                                                    <center><i class="far fa-trash-alt"></i> Delete</center>
                                                </a>


                                            </div>
                                        @endforeach
                              

                                    </div>

                                </div>
                            </div>
                        </div>


                    
                                    <form action="{{ route('gallery.image.final')}}" method="get">
                                        <button type="submit" class="btn btn-success float-right mb-4">Save</button>

                                    </form>
                                    {{-- <p>Click “Save Changes” to update</p> --}}
                            

                            </div>
                  
               
              
            </div>
    

</div>

@endsection

@push('js')

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>

    <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
    crossorigin="anonymous"></script>

    <script>


        Dropzone.options.dropzone =
            {
                uploadMultiple: true,
                parallelUploads: 25,
                maxFilesize: 2,
                init: function () {


                    // this.on("thumbnail", function(file) {
                    //     if (file.width < 300  || file.height < 200) {
                    //         file.rejectDimensions();
                    //         this.removeFile(file);
                    //     }
                    //     else {
                    //         file.acceptDimensions();
                    //     }
                    // });


                    var drop = this; // Closure
                    // this.on("addedfile", function(file) {
                    //     ajaxindicatorstart('loading please wait..');
                    // });

                    this.on('error', function (file, errorMessage) {

                        if (file.type != "image/jpeg" && file.type != "image/jpg" && file.type != "image/png") {
                            drop.removeFile(file);

                            // alert('only file type jpg,png allow.');
                            toastr.remove();
                            toastr.error('only file type jpg,png allow.', 'Error');
                        }

                        if (errorMessage.indexOf('Error 404') !== -1) {
                            var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
                            errorDisplay[errorDisplay.length - 1].innerHTML = 'Error 404: The upload page was not found on the server';
                        }
                        if (errorMessage.indexOf('File is too big') !== -1) {
                            toastr.remove();
                            toastr.error('Maximum file size 2mb.', 'Error');
                            // i remove current file
                            drop.removeFile(file);
                        }
                    });
                },
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                success: function (file, response) {
                    this.removeAllFiles(true);
                    $('#shortable').html(response.data);
                    // ajaxindicatorstop();
                },
                error: function (file, response) {
                    // ajaxindicatorstop();
                    return false;
                }
            };


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


        function ajaxindicatorstart(text) {
            if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
                jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src=""><div>' + text + '</div></div><div class="bg"></div></div>');
            }
            jQuery('#resultLoading').css({
                'width': '100%',
                'height': '100%',
                'position': 'fixed',
                'z-index': '10000000',
                'top': '0',
                'left': '0',
                'right': '0',
                'bottom': '0',
                'margin': 'auto'
            });

            jQuery('#resultLoading .bg').css({
                'background': '#000000',
                'opacity': '0.7',
                'width': '100%',
                'height': '100%',
                'position': 'absolute',
                'top': '0'
            });

            jQuery('#resultLoading>div:first').css({
                'width': '250px',
                'height': '75px',
                'text-align': 'center',
                'position': 'fixed',
                'top': '0',
                'left': '0',
                'right': '0',
                'bottom': '0',
                'margin': 'auto',
                'font-size': '16px',
                'z-index': '10',
                'color': '#ffffff'

            });

            jQuery('#resultLoading .bg').height('100%');
            jQuery('#resultLoading').fadeIn(300);
            jQuery('body').css('cursor', 'wait');
        }


        function ajaxindicatorstop() {
            jQuery('#resultLoading .bg').height('100%');
            jQuery('#resultLoading').fadeOut(300);
            jQuery('body').css('cursor', 'default');
        }


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
        });


        $(document).ready(function () {


            $(document).on('click', '.delete-confrim1', function (e) {


                if (confirm("Are you sure you want to delete?")) {

                    e.preventDefault();


                    var el = $(this);
                    var url = el.data('hrefurl');
                    var id = el.data('imgid');

                    ajaxindicatorstart('loading please wait..');

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            id: id,
                            _method: 'GET'
                        }
                    }).always(function (respons) {
                        ajaxindicatorstop();
                        //$(refresh).DataTable().ajax.reload();
                        if (respons.success == true) {

                            $("#img_" + id).remove();
                        }

                    }).done(function (respons) {
                        ajaxindicatorstop();

                        // swal.fire({
                        //     type: 'success',
                        //     title: 'Success' ,
                        //     text: respons.message
                        // });

                        // alert(respons.message);
                        toastr.remove();
                        toastr.success(respons.message, 'Success');

                    }).fail(function (respons) {
                        ajaxindicatorstop();

                        var res = respons.responseJSON;
                        var msg = 'something went wrong please try again !';

                        if (res.errormessage) {
                            msg = res.errormessage
                        }

                        // swal.fire({
                        //     type: 'error',
                        //     title: 'Error',
                        //     text: msg
                        // });

                        alert(msg);

                    });

                }
                return false;


            });


        });

    </script>

    <script type="text/javascript">
        var list = document.getElementById('shortable');

        $("#shortable").sortable();

        $("#shortable").on("sortupdate", function (event, ui) {
            // $( this ).sortable( "refreshPositions" );
            var data = $(':input', this).serializeArray();
            //alert(data);
            data.push({name: 'date', value: new Date()});

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                type: "POST",
                url: $('#shortable').data('position-url'),
                data: data
            }).done(function (res) {
                console.log(res);
            }).fail(function (res) {
                alert('something went wrong please try again.');
                // message.fire({
                //     title: 'Error',
                //     text: "something went wrong please try again.",
                //     type: 'success',
                // });
            });
        });

    </script>
@endpush
