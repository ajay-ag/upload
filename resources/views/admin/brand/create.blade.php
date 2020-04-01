@extends('admin.layout.app')
@section('title','Add Brand')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Add Brand',
    'back' =>  route('admin.brand.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')
<div class="container-fluid">

    <form action="{{ route('admin.brand.store') }}" enctype="multipart/form-data" method="POST" name="attribute_form"
          id="attribute_form" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-3">
            
           </div>
            <div class="col-md-9">
                @if (count($errors) > 0)
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
                     

                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="title">Category <span class="text-danger">*</span> </label>

                            <select required class="form-control" data-msg-required="Category is required."
                                    id="category" name="category" onchange="getSub(this.value);" style="width: 100%;">
                                <option value="">Select Category</option>
                                @foreach($category as $type)
                                    <option value="{{$type->id}}">{{$type->name ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Sub Category <span class="text-danger">*</span> </label>
                            <select data-msg-required="Sub Category is required." required id="subcategory"
                                    name="subcategory"
                                    class="form-control" style="width: 100%;">
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="title">Name <span class="text-danger">*</span> </label>
                            <input id="name" class="form-control" type="text" name="name"
                                   data-msg-required="Name is required." data-rule-required="true" maxlength="190">

                        </div>


                    </div>
                </div>


            </div>


            <div class="col-sm-4">


            </div>
        </div>
        <div class="dropzoneel">

        </div>
        <div class="row">
            <div class="col d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-success shadow" name="save"><span id="sid" role="status" aria-hidden="true"></span> Save
                </button>
            </div>


        </div>
    </form>
</div>
    <div id="load-modal"></div>

@endsection



@push('js')
<script src="{{ asset('assets/admin/js/setting/brand.js') }}"></script>
<script>

        function getSub(id) {

            if (id == "") {
                $('#subcategory').html('');
            } else {
                $('#subcategory').html('');
                $('#subcategory').prepend($('<option></option>').html('Loading...'));
            }
            if (id != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: '{{ route('admin.postattribute.getsubcategory') }}',
                    method: "POST",
                    data: {
                        id: id
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
    </script>


@endpush



