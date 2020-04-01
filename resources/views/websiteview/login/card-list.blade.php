@extends('websiteview.layout.app')
@section('title' , 'Privacy')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}">

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 47px;
            height: 22px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 17px;
            left: 0px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #f1c40f;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #f1c40f;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #d8d8d8;
            border-radius: 0px !important;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 42px;
            user-select: none;
            -webkit-user-select: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 42px;
        }


        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            .switch {
                margin-top: -18px !important;
            }
        }

        a:hover, a:focus, a:active, i:hover, i:focus, i:active {
            outline: none;
            text-decoration: none;
            color: #ffffff !important;
        }
    </style>

@endsection
@section('content')
    <div class="ps-main-banner">
        <div class="ps-banner-img3">
            <div class="ps-dark-overlay2">
                <div class="container">
                    <div class="ps-banner-contentv3">
                        <h4>It’s Never Too Late To Start</h4>
                        <p><a href="{{url('/')}}">Home</a> <span><i class="ti-angle-right"></i></span> Business Card
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BANNER END -->
    <!-- MAIN START -->

    <main class="ps-main">
        <section class="ps-main-section">
            <div class="container">
                <div class="row">
                    <!-- SIDEBAR START -->
                @include('websiteview.layout.front_sidebar')
                <!-- SIDEBAR END -->


                    <div class="col-lg-8 ps-dashboard-user">
                        <form method="post"
                              action="{{ route('business_card_set') }}">
                            @csrf

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="ps-profile-setting__save text-center justify-content-end">

                                        <a target="_blank" class="btn btn-info" href="{{url('card').'/'.Auth::user()->id.'/'.Auth::user()->unique_id}}">View
                                            My Card</a>

                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <img style="width: 100%" class="card shadow-lg  mb-4 bg-white rounded" height=""
                                         src="{{asset('websiteview/assets/images/card_design/1.JPG') }}">
                                    <div class="row">
                                        <div class="col-md-6 mt-1">
                                            <div class="custom-control custom-radio text-right">
                                                <input {{$user->card=="1" ?  'checked':''}} type="radio"
                                                       class="custom-control-input" id="customRadio1" name="card"
                                                       value="1">
                                                <label class="custom-control-label" for="customRadio1">Select
                                                    Card</label><br>

                                            </div>

                                        </div>
                                        <div class="col-md-5 text-left">

                                            <a class="btn btn-info btn-sm" target="_blank"
                                               href="{{url('card-1')}}"> Preview</a>

                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <img style="width: 100%" class="card shadow-lg mb-4 bg-white rounded" height=""
                                         src="{{asset('websiteview/assets/images/card_design/2.JPG') }}">
                                    <div class="row">
                                        <div class="col-md-6 mt-1">
                                            <div class="custom-control custom-radio text-right">
                                                <input {{$user->card=="2" ?  'checked':''}}  type="radio"
                                                       class="custom-control-input" id="customRadio2" name="card"
                                                       value="2">
                                                <label class="custom-control-label" for="customRadio2">Select
                                                    Card</label><br>

                                            </div>
                                        </div>
                                        <div class="col-md-5 text-left">

                                            <a class="btn btn-info btn-sm" target="_blank"
                                               href="{{url('card-2')}}"> Preview</a>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-6">
                                    <img style="width: 100%" class="card shadow-lg mb-4 bg-white rounded" height=""
                                         src="{{asset('websiteview/assets/images/card_design/3.JPG') }}">
                                    <div class="row">
                                        <div class="col-md-6 mt-1">
                                            <div class="custom-control custom-radio text-right">
                                                <input {{$user->card=="3" ?  'checked':''}} type="radio"
                                                       class="custom-control-input" id="customRadio3" name="card"
                                                       value="3">
                                                <label class="custom-control-label" for="customRadio3">Select
                                                    Card</label><br>

                                            </div>

                                        </div>
                                        <div class="col-md-5 text-left">

                                            <a class="btn btn-info btn-sm" target="_blank"
                                               href="{{url('card-3')}}"> Preview</a>

                                        </div>


                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <div class="ps-profile-setting__save text-center justify-content-center">
                                        <button type="submit" class="btn ps-btn">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>


                </div>
            </div>
        </section>
    </main>



@endsection

@section('js')


    <script src="{{ asset('websiteview/assets/js/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('websiteview/assets/js/jquery-validation/dist/additional-methods.js')}}"></script>

    <script type="text/javascript">

        $(document).on('click', '.change-status', function (e) {

            var el = $(this);
            var status = el.data('status');
            // alert(status);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = el.val();
            $.ajax({
                type: "POST",
                url: '{{route('privacy.change')}}',
                data: {
                    id: id,
                    status: el.prop("checked"),
                    for: status,
                }
            }).always(function (respons) {
            }).done(function (respons) {
                toastr.remove();

                toastr.success(respons.message, 'Success');

                // message.fire({
                //     type: 'success',
                //     title: 'Success' ,
                //     text: respons.message
                // });

            }).fail(function (respons) {
                toastr.remove();

                toastr.error('something went wrong please try again !', 'Error');

                // message.fire({
                //     type: 'error',
                //     title: 'Error',
                //     text: 'something went wrong please try again !'
                // });

            });

        });


        $.validator.addMethod("pwcheck", function (value) {
            return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(value) // consists of only these
        });


        $('#change').validate({
            debug: false,
            // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {

                old_password: {
                    required: true,
                },
                password: {
                    required: true,
                    pwcheck: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            },
            messages: {
                old_password: {
                    required: "Old password is required.",
                },
                password: {
                    required: "New password is required.",
                    pwcheck: 'Password must be minimum 8 characters.password must contain at least 1 lowercase, 1 Uppercase, 1 numeric and 1 special character.',
                    minlength: "Please enter atleast 8 digit."
                },
                password_confirmation: {
                    required: "Confirm password is required.",
                    minlength: "Password must be at least 8 characters long.",
                    equalTo: "Confirm password does not match to password."

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
@endsection
