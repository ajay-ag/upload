@extends('websiteview.user_panel.layout.app')
@section('title' , 'Profile')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Profile Setting',



])
@endcomponent
@endsection




@section('content')
 <div class="container-fluid">
    <!-- BANNER END -->
    <!-- MAIN START -->

    <form enctype='multipart/form-data' id="profile" method="post" name="profile" action="{{ route('profile.set') }}">




                    <div class="row">


                        <div class="col-md-3">
                          <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                        </div>
                        <div class="col-md-9">

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

                            @csrf

                                    <!-- POST NEW AD FORM START -->

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Profile Image</label>
                                                <input type="file" id="image" name="image"
                                                       data-rule-accept="jpg,png,jpeg"
                                                       data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                                       data-rule-filesize="5000000"
                                                       data-msg-filesize="File size must be less than 5mb"/>
                                            </div>
                                        </div>

                                        <img src="{{ $user->profile_src ?? '' }}" width="50" height="50">
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="personal_name"
                                                    name="personal_name"
                                                    placeholder="Name *"
                                                    value="{{ $user->name ?? '' }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email </label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="personal_email"
                                                    name="personal_email"
                                                    placeholder="Email"
                                                    value="{{ $user->email ?? '' }}"
                                                >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="mobile"
                                                    readonly
                                                    name="mobile"
                                                    placeholder="Mobile No. "
                                                    value="{{ $user->mobile ?? '' }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>WhatsApp No.</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="personal_whatapp_mobile"
                                                    name="personal_whatapp_mobile"
                                                    placeholder="WhatsApp No."
                                                    value="{{ $user->personal_whatapp_mobile ?? '' }}"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address <span class="text-danger">*</span></label>
                                                <textarea
                                                    rows="5"
                                                    placeholder="Address *"
                                                    class="form-control"
                                                    name="personal_address"
                                                    id="personal_address">{{$user->personal_address ?? ''}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country <span class="text-danger">*</span></label>
                                                <select
                                                    onchange=""
                                                    data-clear="#personal_state"
                                                    name="countriesID"
                                                    id="countriesID"
                                                    data-target="#countriesID"
                                                    class="form-control"  style="width: 100%;">
                                                    <option value="">Select Country</option>
                                                    @foreach($personal_country as $countries)
                                                        <option value="{{$countries->id}}"
                                                            {{ $countries->id==$user->personal_country ? 'selected' : '' }}>
                                                            {{$countries->name}}</option>
                                                    @endforeach


                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State <span class="text-danger">*</span></label>
                                                <select
                                                    onchange="getCityPersonal(this.value);"
                                                    name="personal_state"
                                                    id="personal_state"
                                                    data-target="#countriesID"
                                                    class="form-control" style="width: 100%;">
                                                    <option value="">Select State</option>
                                                     @foreach($state_personal as $state)
                                                        <option value="{{$state->id}}"
                                                            {{ $state->id==$user->personal_state ? 'selected' : '' }}
                                                        >
                                                            {{$state->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label>City <span class="text-danger">*</span></label>
                                                <select
                                                    name="personal_city"
                                                    id="personal_city"
                                                    class="form-control" style="width: 100%;"
                                                >
                                                    <option value="">Select City *</option>
                                                    @foreach($cityes_personal as $city)
                                                        <option value="{{$city->id}}"
                                                            {{ $city->id==$user->personal_city ? 'selected' : '' }}
                                                        >
                                                            {{$city->name}}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="ps-profile-setting__save">
            <button type="submit" class="btn btn-success float-right">Save Changes</button>
        </div>



        </div>
    </div>
   </div>
</div>


    </form>
</div>




@endsection

@push('js')

    <script>

        getLocation()
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    // Success function
                    showPosition,
                    // Error function
                    null,
                    // Options. See MDN for details.
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
        }
    </script>

    <script type="text/javascript">

        $("#countriesID").select2({
            allowClear: true,
            placeholder: 'Select Country',

        });

        $("#personal_city").select2({
            allowClear: true,
            placeholder: 'Select City',

        });
        $("#business_city").select2({
            allowClear: true,
            placeholder: 'Select City',

        });
         var countriesID = $('#countriesID');
        $('#countriesID').select2({
            ajax: {
                url: '{{route('select2Country') }}',
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
            placeholder: 'Select Country',
            // minimumInputLength: 1,
            templateResult: getName,
        });
        $('#personal_state').select2({

            ajax: {
                url: '{{route('select2StatePersonal') }}',
                data: function (params) {
                    return {
                        search: params.term,
                         id : $(countriesID.data('target')).val()
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
        $('#countriesID , #personal_state ').on('select2:select' ,function(e){
            var el = $(this);
            var clearInput = el.data('clear').toString();
            $(clearInput).val(null).trigger('change');
        })




        function getName(data) {
            if (!data.id) {
                return data.text;
            }
            data = data.otherfield;
            var $html = $("<div >" + data.name + "</div>");
            return $html;
        }

        function getCityPersonal(id) {

            if (id == "") {
                $('#personal_city').html('');
            } else {
                $('#personal_city').html('');
                $('#personal_city').prepend($('<option></option>').html('Loading...'));
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
                            $('#personal_city').html(result);
                        }
                    }
                });
            }
        }

        function getCityBusiness(id) {

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
                            $('#business_city').html(result);
                        }
                    }
                });
            }
        }


        $.validator.addMethod("pwcheck", function (value) {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
        });

        $.validator.addMethod("pan", function (value, element) {
            return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
        }, "Please enter a valid PAN");

        $.validator.addMethod("gst", function (value, element) {
            return this.optional(element) || /^([0]{1}[1-9]{1}|[1-2]{1}[0-9]{1}|[3]{1}[0-7]{1})([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/.test(value);
        }, "Please enter a valid GST No");


        $('#profile').validate({
            debug: false,
            // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {

                personal_name: {
                    required: true,
                },
                personal_address: {
                    required: true,
                },
                personal_state: {
                    required: true,
                },
                personal_city: {
                    required: true,
                },
                personal_email: {
                    email: true,
                },
                personal_whatapp_mobile: {
                    minlength: 10,
                    maxlength: 10,
                    number: true,
                },
                business_whatapp_mobile: {
                    minlength: 10,
                    maxlength: 10,
                    number: true,
                },
                business_mobile: {
                    minlength: 10,
                    maxlength: 10,
                    number: true,
                },
                business_gst: {
                    maxlength: 15,
                    minlength: 15,
                    gst: true
                },

                business_pan: {
                    // required: !0,
                    maxlength: 10,
                    minlength: 10,
                    pan: true
                },

                //  business_state: {
                //         required: true,
                // },
                // business_city: {
                //         required: true,
                // },
                // business_address: {
                //         required: true,
                // },
                // business_name: {
                //         required: true,
                // },


            },
            messages: {


                personal_whatapp_mobile: {
                    minlength: "WhatsApp no must be 10 digit.",
                    minlength: "WhatsApp no must be 10 digit.",
                    maxlength: "WhatsApp no must be 10 digit.",
                    number: "please enter digit 0-9.",
                },
                business_whatapp_mobile: {
                    minlength: "WhatsApp no must be 10 digit.",
                    minlength: "WhatsApp no must be 10 digit.",
                    maxlength: "WhatsApp no must be 10 digit.",
                    number: "please enter digit 0-9.",
                },
                business_mobile: {
                    minlength: "Mobile no must be 10 digit.",
                    minlength: "Mobile no must be 10 digit.",
                    maxlength: "Mobile no must be 10 digit.",
                    number: "please enter digit 0-9.",
                },
                business_gst: {
                    // required: "GST NO is required",
                    maxlength: "GST NO must be 15 character.",
                    minlength: "GST NO must be 15 character.",
                },
                business_pan: {
                    // required: "PAN NO is required",
                    maxlength: "PAN NO must be 10 character.",
                    minlength: "PAN NO must be 10 character.",
                },
               
                business_address: {
                    required: "Address is required.",
                },
                // personal_state: {
                //     required: "State is required.",
                // },
                // personal_city: {
                //     required: "City is required.",
                // },

                // business_state: {
                //         required: "State is required.",
                //     },
                // business_city: {
                //         required: "City is required.",
                //     },
                //     business_name: {
                //         required: "Name is required.",
                //     },


            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent()).addClass('text-danger-custom');
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
