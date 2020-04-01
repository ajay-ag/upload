@extends('admin.layout.app')
@section('title',' Edit Category')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Edit Category',
    'back' =>  route('admin.category.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@push('css')
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css">   
@endpush
@section('content')

<div class="container-fluid">

<form action="{{ route('admin.category.update',[$category->id]) }}" enctype="multipart/form-data" method="POST" name="category_form"
    id="category_form" autocomplete="off" data-exit-url="{{ url('common_check_exist') }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="id" value="{{ $category->id }}">
    <div class="row">

        <div class="col-md-3">
            
        </div>
        <div class="col-md-4">

            {{-- image --}}
             <div class="card">
                <div class="card-body">
                    <label>Image<span class="text-danger"> *</span> </label>
                    <hr>
                    <div class="row">

                               <div class="col-12">
                                      <div class="text-left">

                                        <img src="{{ $category->category_image }}"
                                                data-default="{{ $category->category_image }}" class="w-40"
                                                id="preview" style="width:100%;height:120px;">

                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="form-group">

                                        <input type="file" name="image" class="file-upload-default"
                                            data-rule-accept="jpg,png,jpeg"
                                            data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                            data-rule-required="false" data-rule-filesize="5000000" id="image" style="visibility: hidden;position: absolute;"
                                            data-msg-required="Image is required."
                                            data-msg-filesize="File size must be less than 5mb">

                                        <div class="input-group">
                                            <input type="text" class="form-control file-upload-info" disabled=""
                                                placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse shadow-sm btn btn-primary"
                                                    type="button">Upload</button>
                                            </span>
                                            <span class="input-group-append">
                                                <button class="file-upload-clear btn shadow-sm btn-danger"
                                                    type="button">Clear</button>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="text-danger"> *</span> Image size (100 x 100)
                                </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                   
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span> </label>
                        <input id="name" class="form-control" type="text" name="name"
                        data-msg-required="Category name is required." data-rule-required="true" maxlength="190" value="{{ $category->name ?? '' }}">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-prepend">
                               <button class="btn btn-primary shadow-sm" id="changeIcon" data-target="#icon_name" data-icon="{{ $category->icon_name }}" role="iconpicker"></button>
                            </span>
                            <input type="text" name="icon_name" id="icon_name" class="form-control" value="{{ $category->icon_name }}" data-rule-required="true"  readonly>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="card">
             <div class="card-body">

                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input id="slug" class="form-control" type="text" name="slug" readonly="" value="{{ $category->slug ?? '' }}">
                        </div>
                    </div>
                </div>

              </div>
         </div>
            <div class="row">
                <div class="col d-flex justify-content-end mb-4">
                    <button type="submit" name="save" class="btn btn-success shadow"><span id="sid" role="status" aria-hidden="true"></span> Save</button>
                 </div>

             </div>



        </div>

       
    </div>

  
 
</form>
</div>
<div id="load-modal"></div>

@endsection



@push('js')

    <script src="{{ asset('assets/admin/js/category.js') }}"></script>
    <script src="{{asset('assets/admin/js/jquery.checkImageSize.js')}}"></script>
    <script src="{{ asset('assets/admin/js/setting/category.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript">
        $('#changeIcon').on('change', function(e) {
    console.log(e.icon);
    if(e.icon=='empty')
    {
        $("#icon_name").val('');
    }else{

    $("#icon_name").val(e.icon);

    }
});
    </script>
@endpush



