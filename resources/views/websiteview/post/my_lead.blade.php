@extends('websiteview.user_panel.layout.app')
@section('title' , 'My lead')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'My lead',
   
    
    
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
              <table  class="table " id="leadTable" data-url="{{ route('user.lead.datalist') }}" style="width: 100%;">
                <thead class="thead-dark">
                <tr>
                      <th style="width:5%">No</th>
                      <th style="width:15%">Ad Name</th>
                      <th style="width:30%">Name</th>
                      <!-- <th style="width:25%">Emial ID</th> -->
                      <th style="width:50%" data-orderable="false" class="text-left">Description</th>
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

<script src="{{ asset('assets/website/js/lead/lead-datatable.js') }}"></script>


    <script type="text/javascript">

        $(document).on('click', '.ps-favorite-href', function () {

            var auth = '{{Auth::check()}}';

            if (!auth) {
                // alert("Please Login.");
                // toastr.remove();
                // toastr.error('Please Login first.','Error');
                window.location.href = "{{url('login')}}"
                return false
            }

            $(this).closest('.cardhide').remove();


            var postId = $(this).attr('data-post_id');
            var url = $(this).attr('data-url');
            var el = $(this);

            $.ajax({
                type: "GET",
                url: url,

            }).always(function () {

            }).done(function (res) {

                if (res.process == "add") {
                    $(el).addClass('ps-favorite');
                    toastr.remove();
                    toastr.success('Favourite add successfully.', 'Success');

                } else if (res.process == "remove") {

                    $(el).removeClass('ps-favorite');
                    toastr.remove();
                    toastr.success('Favourite remove successfully.', 'Success');
                    $(this).closest('.cardhide').remove();
                }


                // alert(res.process);
                // $('#load-modal').html(res.html);
                // $(target).modal('toggle');
            });

        });


    </script>
@endpush
