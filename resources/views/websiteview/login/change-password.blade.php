@extends('websiteview.user_panel.layout.app')
@section('title' , 'Change Password')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Change Password',
   
    
    
])
@endcomponent
@endsection
@push('css')

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
  background-color: #44b15d;
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



    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
        .switch{
            margin-top: -18px !important;
        }
    }

</style>
@endpush
@section('content')
<div class="container-fluid">
    <!-- BANNER END -->
    <!-- MAIN START -->

             {{--   <div class="row">
                    <!-- SIDEBAR START -->
                                     
                    <!-- SIDEBAR END -->

                    <div class="col-lg-3">
                       <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                     <div class="col-lg-9">
                        <div class="card">
                           <div class="card-body">


                         


                                <!-- POST NEW AD FORM START -->



                 <div class="form-group">

                      <label>Show my phone number on my post</label>

                      <label style="float: right;" class="switch">

                      <input data-status="number" data-url="{{ route('privacy.change') }}" class="change-status2" type="checkbox" name="show_mobile"  {{$user->show_mobile=="Yes" ? 'checked':''}}   >
                      <span class="slider round"></span>
                     </label>


                </div>
              <hr>


                 <div class="form-group">

                      <label> Show my address on my post</label>

                    <label style="float: right;"  class="switch">

                      <input data-status="address" data-url="{{ route('privacy.change') }}"  class="change-status2" type="checkbox"  name="show_address"  {{$user->show_address=="Yes" ? 'checked':''}} >
                      <span class="slider round"></span>
                    </label>


                 </div>
              </div>
            </div>
          </div>
      </div>--}}
      <div class="row">

        <div class="col-lg-3">
                       <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
        </div>

        <div class="col-lg-9">
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
                  <div class="card">
                     <div class="card-body">
                       <form class="ps-profile-form" id="change" method="post" name="change" action="{{ route('set.password') }}">
                           @csrf
                           

                           
                                <!-- POST NEW AD FORM START -->



                              <div class="form-group">
                                            <input
                                            type="password"
                                            class="form-control"
                                            id="old_password"
                                            name="old_password"
                                            placeholder="Old Password">
                                        </div>

                              <div class="form-group">
                                            <input
                                            type="password"
                                            class="form-control"
                                            id="password"
                                            name="password"
                                             placeholder="Password"
                                            >
                                        </div>

                              <div class="form-group">
                                            <input
                                            type="password"
                                            class="form-control"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                             placeholder="Confirm Password"
                                             >
                                        </div>



                                   <div class="ps-profile-setting__save">
                                    <button type="submit" class="btn btn-success float-right">Save Changes</button>
                                  </div>
                         







           
     
        </form>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection

@push('js')





         <script type="text/javascript">



              $(document).on('click' ,'.change-status2', function (e) {

            var el = $(this);
            var status = el.data('status');
            var url = el.data('url');
            // alert(status);
                 $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

            var id = el.val();
           // alert(id);
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id : id ,
                    status : el.prop("checked") ,
                    for :status,
                }
            }).always(function(respons){
            }).done(function(respons){
                  toastr.remove();

                   toastr.success(respons.message,'Success');

                // message.fire({
                //     type: 'success',
                //     title: 'Success' ,
                //     text: respons.message
                // });

            }).fail(function(respons){
                  toastr.remove();

                   toastr.error('something went wrong please try again !','Error');

                // message.fire({
                //     type: 'error',
                //     title: 'Error',
                //     text: 'something went wrong please try again !'
                // });

            });

        });




        $.validator.addMethod("pwcheck", function(value) {
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
            error.appendTo(element.parent()).addClass('text-danger-custom');
            if(element.parent('.input-group').length)
                {
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
