@extends('websiteview.user_panel.layout.app')
@section('title' , 'Edit Post')

@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Post Edit',
    'back' =>  route('user.list'),
    'text' => 'Back',


])
@endcomponent
@endsection
@push('css')
    <style type="text/css">
        .error{
            width: 100%;
             font-size: 90%;
            color: #dc3545;
           font-weight: 400 !important;
        }
    </style>
    <link href="{{ asset('assets/website/css/bootstrap-datepicker.css') }}" rel="stylesheet">

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
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        @if ($message = Session::get('danger'))
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endif


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
                        <form id="post" method="post" name="post" action="{{ route('update.post') }}">
                            @csrf

                                    <!-- POST NEW AD FORM START -->
                                    <input
                                        type="hidden"
                                        class="form-control"
                                        id="id"
                                        name="id"
                                        value="{{ $posts->id ?? '' }}"
                                    >


                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Title <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="title"
                                                       name="title"
                                                       placeholder="Title"
                                                       value="{{ $posts->title ?? '' }}"
                                                >

                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Price <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="price"
                                                    name="price"
                                                    placeholder="Price"
                                                    maxlength="15"
                                                    value="{{ $posts->price ?? '' }}"
                                                >
                                            </div>

                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>Post Expire Date <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       class="form-control dateFrom"
                                                       id="expired_date"
                                                       name="expired_date"
                                                       readonly
                                                       placeholder="Post Expire Date"
                                                       value="{{ date('d-m-Y', strtotime($posts->expired_date)) }}"
                                                >

                                            </div>
                                        </div>

                                        <div class="col-md-6">


                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group ps-fullwidth">
                                                <label>Description <span class="text-danger">*</span></label>

                                                <textarea
                                                    {{-- data-msg-required="Description is required." --}}
                                                    required
                                                    rows="5"
                                                    class="form-control"
                                                    id="description"
                                                    name="description"
                                                    placeholder="Description"
                                                >{{$posts->description??''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="text-danger">*</span></label>
                                            <select
                                                name="state_id"
                                                required
                                                id="personal_state"
                                                data-target="#countriesID"
                                                class="form-control" style="width: 100%;">
                                                <option value="">Select State</option>

                                                @if($posts->state)
                                                    <option value="{{ $posts->state->id }}" selected>{{ $posts->state->name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>City <span class="text-danger">*</span></label>
                                            <select
                                                name="city_id"
                                                required
                                                id="personal_city"
                                                class="form-control" style="width: 100%;"
                                                data-target="#personal_state">
                                                <option value="">Select City *</option>
                                                @if($posts->city)
                                                    <option value="{{ $posts->city->id }}" selected>{{ $posts->city->name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label>Category <span class="text-danger">*</span></label>
                                                <select required class="form-control"
                                                        {{-- data-msg-required="Category is required." --}}
                                                         id="category"
                                                        name="category" onchange="getSub(this.value);">
                                                    <option value="">Select Category</option>
                                                    @foreach($category as $type)
                                                        <option value="{{$type->id}}"
                                                            {{ $type->id == $posts->category_id ? 'selected' : '' }}
                                                        >{{$type->name ?? ''}}</option>

                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label>Sub Category <span class="text-danger">*</span></label>
                                                <select 
                                                {{-- data-msg-required="Sub Category is required." --}}
                                                 required
                                                        id="subcategory"
                                                        name="subcategory"
                                                        class="form-control"
                                                        onchange="getAttributes(this.value);"
                                                >
                                                    @foreach($subcategory as $type)
                                                        <option value="{{$type->id}}"
                                                            {{ $type->id == $posts->sub_category_id ? 'selected' : '' }}
                                                        >{{$type->name ?? ''}}</option>

                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div id="brand_view" class="col-md-4">
                                            @if(isset($brand) && count($brand))
                                                <div class="form-group">
                                                    <label>Brand </label>
                                                    <select

                                                        class="form-control brands"
                                                        id="brand"
                                                        name="brand">
                                                        <option value="">Select Brand</option>
                                                        @foreach($brand as $key=>$record)
                                                            <option
                                                                value="{{$record->id}}" {{ $record->id == $posts->brand_id ? 'selected' : '' }}>{{$record->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            @endif

                                        </div>


                                    </div>

                                    <div id="attribute">


                                        @if(count($attr))


                                            <div class="row">


                                                @foreach($attr as $key=>$record)


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>{{$record->name ?? ''}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                id="attr{{$record->id}}"
                                                                name="grop[{{$record->id}}][attribute_value]"
                                                                required=""
                                                                value="{{ $record->field_value ?? '' }}"
                                                            >
                                                            <input
                                                                type="hidden"
                                                                class="form-control"
                                                                id="attr{{$record->id}}"
                                                                name="grop[{{$record->id}}][attribute_name]"
                                                                required=""
                                                                value="{{$record->name}}"
                                                            >
                                                            <input
                                                                type="hidden"
                                                                class="form-control"
                                                                id="attr{{$record->id}}"
                                                                name="grop[{{$record->id}}][attribute_id]"
                                                                required=""
                                                                value="{{$record->id}}"
                                                            >
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>

                                        @endif


                                    </div>


                                    <div class="mb-4 float-right">
                                        <button type="submit" class="btn btn-success ">Save & Next</button>

                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@push('js')
{{--<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>--}}
<script src="{{asset('assets/website/js/bootstrap-datepicker.min.js')}}"></script>

    <script>


        var start = '{{ date('d-m-Y', strtotime($posts->created_at)) }}';
        var end = '{{$expired_date}}';

        $('#personal_state').select2({

            ajax: {
                url: '{{route('select2StatePersonal') }}',
                data: function (params) {
                    return {
                        search: params.term,
                        id : 101
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    console.log(data);
                    //data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: `${item.name}`,
                                otherfield: item,

                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                //cache: true,
                delay: 50
            },
            placeholder: 'Select State',
            // minimumInputLength: 1,
            templateResult: getName,
        });

        $('#personal_city').select2({

            ajax: {
                url: '{{route('cityForPost') }}',
                data: function (params) {
                    return {
                        search: params.term,
                        id : $($(this).data('target')).val()
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    console.log(data);
                    //data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: `${item.name}`,
                                otherfield: item,
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                //cache: true,
                delay: 50
            },
            placeholder: 'Select State',
            // minimumInputLength: 1,
            templateResult: getName,
        });


        $('#personal_state , #personal_city ').on('select2:select' ,function(e){
            var el = $(this);
            var clearInput = el.data('clear').toString();
            $(clearInput).val(null).trigger('change');
        })


        $(".dateFrom").datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: start,
            endDate: end,
        });


        $('#price').keyup(function (event) {
            var value = $('#price').val();

            if (event.which >= 37 && event.which <= 40) {
                event.preventDefault();
            }
            var newvalue = value.replace(/,/g, '');
            var valuewithcomma = Number(newvalue).toLocaleString('en-IN');

            if (valuewithcomma == 'NaN') {
                $('#price').val('');

            } else if (valuewithcomma == 0) {
                $('#price').val('');
            } else {
                $('#price').val(valuewithcomma);

            }

        });
        $('#price').keyup();


        $("#city").select2({
            allowClear: true,
            placeholder: 'Select City',

        });


        $('#state').select2({
            ajax: {
                url: '{{route('select2StatePersonal') }}',
                data: function (params) {
                    return {
                        search: params.term,
                        //page: params.page || 1
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    console.log(data);
                    //data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: `${item.name}`,
                                otherfield: item,
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                //cache: true,
                delay: 50
            },
            placeholder: 'Select State',
            // minimumInputLength: 1,
            templateResult: getName,
        });


        function getName(data) {
            if (!data.id) {
                return data.text;
            }
            data = data.otherfield;
            var $html = $("<div >" + data.name + "</div>");
            return $html;
        }

        function getCity(id) {

            if (id == "") {
                $('#business_city').html('');
            } else {
                $('#business_city').html('');
                $('#business_city').prepend($('<option></option>').html('Loading...'));
            }
            if (id != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: "{{ url('getCitiesByState')}}",
                    method: "POST",
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (result) {
                        if (result.errors) {
                            $('.alert-danger').html('');
                        } else {
                            $('#city').html(result);
                        }
                    }
                });
            }
        }


        //       $(document).on('keyup','#price',function(){

        //   if (/\D/g.test(this.value))
        //   {
        //     // Filter non-digits from input value.
        //     this.value = this.value.replace(/\D/g, '');
        //   }
        // });
        $("#brand").select2({
            allowClear: true,
            placeholder: 'Select Brand',
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
                $('#brand_view').html('');
            } else {
                $('#subcategory').html('');
                $('#attribute').html('');
                $('#brand_view').html('');
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

            ajaxindicatorstart('loading please wait..');


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
                        ajaxindicatorstop();
                        if (result.errors) {
                            $('.alert-danger').html('');
                        } else {
                            // $('#attribute').html(result);
                            $('#attribute').html(result['attribute']);
                            $('#brand_view').html(result['brand']);
                            $("#brand").select2({
                                allowClear: true,
                                placeholder: 'Select Brand',
                            });
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

        //
        // $.validator.addMethod('ckdata', function (value, element, param) {
        //     var editor = CKEDITOR.instances[$(element).attr('id')];
        //     if (editor.getData().length <= 0) {
        //         return false;
        //     } else {
        //         return true;
        //     }
        // }, 'This field is required.');

        $('#post').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
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
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                price: {
                    required: true,
                    // number:true,
                },
                expired_date: {
                    required: true,
                },

            },
            messages: {


                // category: {
                //     required: "Categoty is required.",
                // },
                // subcategory: {
                //     required: "Sub Category is required.",
                // },
                // title: {
                //     required: "Title is required.",
                // },
                // state: {
                //     required: "State is required.",
                // },
                // city: {
                //     required: "City is required.",
                // },
                // price: {
                //     required: "Price is required.",
                // },
                // expired_date: {
                //     required: "Post Expire Date is required.",
                // },


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
                    // number:true,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                description: {
                    required: true,
                },

            },
            messages: {


                category: {
                    required: "Category is required.",
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
                state: {
                    required: "State is required.",
                },
                city: {
                    required: "City is required.",
                },
                description: {
                    required: "Description is required.",
                }


            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger-custom');
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                }
            },
            submitHandler: function (e) {

                return true;
            }
        })

    </script>
@endpush
