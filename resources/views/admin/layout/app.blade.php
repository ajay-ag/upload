<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ $setting->store_name }} | @yield('title') </title>
  
  <link rel="shortcut icon" href="{{ $setting->favicon_image }}" type="image/x-icon"/>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/admin/css/common.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script>
        window.Laravel = @json([
            'csrfToken' => csrf_token(),
        ]) 
  </script>
   @stack('css')
   @stack('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('admin.layout.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       @yield('wrapper')

    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

      @yield('content')
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
 
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 @include('admin.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
      const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 8000
    });

    const message = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success shadow-sm mr-2',
            cancelButton: 'btn btn-danger shadow-sm' 
        },
        buttonsStyling: false,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        

        $(document).on('click', '.delete-confrim', function (e) {
            e.preventDefault();

            var el = $(this);
            var url = el.attr('href');
            var id = el.data('id');
            var refresh = el.closest('table');

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
                            id: id,
                            _method: 'DELETE'
                        }
                    }).always(function (respons) {
                        $(refresh).DataTable().ajax.reload();
                    }).done(function (respons) {
                        if (!respons.success) {
                            message.fire({
                                type: 'error',
                                title: 'Error',
                                text: respons.message
                            });
                        } else {
                            message.fire({
                                type: 'success',
                                title: 'Success',
                                text: respons.message
                            });
                        }
                    }).fail(function (respons) {
                        var res = respons.responseJSON;
                        var msg = 'something went wrong please try again !';
                        if (res.errormessage) {
                            msg = res.errormessage
                        }
                        message.fire({
                            type: 'error',
                            title: 'Error',
                            text: msg
                        });
                    });
                }
            });

        });

        $(document).on('click', '.change-status', function (e) {
            var el = $(this);
            var url = el.data('url');
            var id = el.val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id,
                    status: el.prop("checked"),
                }
            }).always(function (respons) {
            }).done(function (respons) {
                message.fire({
                    type: 'success',
                    title: 'Success',
                    text: respons.message
                });
            }).fail(function (respons) {
                message.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'something went wrong please try again !'
                });
            });
        });

        $(document).on('click', '.call-model', function (e) {

            e.preventDefault();
            // return false;
            var el = $(this);
            var url = el.data('url');
            var target = el.data('target-modal');

            $.ajax({
                type: "GET",
                url: url
            }).always(function () {
                $('#load-modal').html(' ')
            }).done(function (res) {
                $('#load-modal').html(res.html);
                $(target).modal('toggle');
            });

        });



    @if(Session::has( 'error' ))    
        message.fire({
            type: 'error',
            title: 'Error',
            text: "{!!  session('error')  !!}"
        });
        @php session()->forget('error') @endphp
    @endif

    @if(Session::has('success'))    
        message.fire({
            type: 'success',
            title: 'Success',
            text: "{!!  session('success')  !!}"
        });
        @php session()->forget('success') @endphp
    @endif
</script>
@stack('js')
@stack('scripts')
</body>
</html>
