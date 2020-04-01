@extends('admin.layout.app')
@section('title',' Add Service')
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<style type="text/css">
.text-left {
    text-align: center!important;
}
</style>
@endpush
@section('content')
@component('component.heading' , [
    'page_title' => 'Service',
    'icon' => 'ik ik-layers' ,
    'tagline' =>'This is service table' ,
    'action' => route('admin.services.index') ,
    'action_icon' => 'ik ik-arrow-left' ,
    'text' => 'Back'
])
@endcomponent

<form action="{{ route('admin.services.store') }}" enctype="multipart/form-data" method="POST" name="service_form"
    id="service_form" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>Service</strong> </h6>
                    <hr>
                    <div class="form-group">
                        <label for="title">Service Name <span class="text-danger">*</span> </label>
                        <input id="title" class="form-control" type="text" name="title" 
                        data-msg-required="Service name is required." data-rule-required="true" maxlength="190">
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="content">Description <span class="text-danger">*</span> </label>
                            <textarea id="content" class="ckeditor form-control col-8" data-rule-ckdata="ck"     name="content" 
                                data-rule-required="true"
                                data-msg-ckdata="Description is required."
                                rows="3">
                            </textarea>
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
                                    <input id="slug" class="form-control" type="text" name="slug" readonly="">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

        </div>
        <div class="col-sm-4">

            {{-- image --}}
             <div class="card">
                <div class="card-body">
                    <h6 class="text-mute">Image<span class="text-danger"> *</span> </h6>
                    <hr>
                    <div class="row">
                     
                          <div class="col-12">
                                      <div class="text-left">
                         
                                        <img src="{{ asset('storage/default/picture.png') }}"
                                            data-default="{{ asset('storage/default/picture.png') }}" class="w-40"
                                            id="preview">
                                          
                                    </div><br>
                                </div>
                                <div class="col-12">                                    
                                    <div class="form-group">
                                      
                                        <input type="file" name="slider_image" class="file-upload-default"
                                            data-rule-accept="jpg,png,jpeg"
                                            data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                            data-rule-required="true" data-rule-filesize="5000000" id="featured_image"
                                            data-msg-required="Image is required."
                                            data-msg-filesize="File size must be less than 5mb">
                                    
                                        <div class="input-group mb-2">
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
                                </div> 
                    </div>
                </div>
            </div>
             <div class="card">
                <div class="card-body">
                    <h6 class="text-mute">Icon Image<span class="text-danger"> *</span> </h6>
                    <hr>
                    <div class="row">
                     
                          <div class="col-12">
                                      <div class="text-left">
                         
                                        <img src="{{ asset('storage/default/picture.png') }}"
                                            data-default="{{ asset('storage/default/picture.png') }}" class="w-40"
                                            id="preview1">
                                          
                                    </div><br>
                                </div>
                                <div class="col-12">                                    
                                    <div class="form-group">
                                      
                                        <input type="file" name="icon_image" class="file-upload-default1"
                                            data-rule-accept="png"
                                            data-msg-accept="Only image type .png is allowed."
                                            data-rule-required="true" data-rule-filesize="5000000" id="icon_image"
                                            data-msg-required="Icon Image is required."
                                            data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;position: absolute;">
                                    
                                        <div class="input-group mb-2">
                                        <input type="text" class="form-control file-upload-info" disabled=""placeholder="Upload Icon Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse1 shadow-sm btn btn-primary"
                                                    type="button">Upload</button>


                                            </span>
                                            <span class="input-group-append">
                                                <button class="file-upload-clear1 btn shadow-sm btn-danger"
                                                    type="button">Clear</button>
                                            </span>
                                        </div>

                                    </div>
                                    <span class="text-danger"> *</span> Image size (64 x 64) - PNG
                                </div> 
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="dropzoneel">

    </div>
    <div class="row">
        <div class="col d-flex justify-content-end">
            <button type="submit" class="btn btn-success shadow"><i class="ik ik-check-circle" id="cl"></i>Save</button>
        </div>
      
  

    </div>
</form>
<div id="load-modal"></div>

@endsection



@push('js')
   <!--  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>  -->       
  
    <script src="{{ asset('js/category.js') }}"></script>
    <script src="{{asset('assets/js/jquery.checkImageSize.js')}}"></script>
   
    <script type="text/javascript">
  
    $('#service_form').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {
                    title:{
                 remote:{
                     url: "{{ route('admin.services.check') }}",
                     type: 'post',
                    }
                   }
            },
        messages: {
              title:{
                 remote:"Service already exists.",
             }
          
        },
        errorPlacement: function (error, element) {            
            error.appendTo(element.parent()).addClass('text-danger');
            if(element.parent('.input-group').length)
                {
                    error.insertAfter(element.parent());
                }
        },
        submitHandler: function (e) {
          $("#cl").removeClass('ik ik-check-circle').addClass('fa fa-spinner fa-spin');
            return true;
        }
    })
      
    </script>
    <script type="text/javascript">
        
          $('#title').on('keydown keyup', function (e) {
        // alert('keypress');
        var el = $(this);
        var textdata = el.val();
        var slug = convertToSlug(textdata);
        $('#slug').val(slug);

    });
    




var  convertToSlug = function convertToSlug(Text) {
    var data = Text
        .toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');
    return data
}
    </script>
<script type="text/javascript">
        $(document).ready(function ()   {


    $(document).on('click','.file-upload-browse1', function() {
        var file = $(this).parents().find('.file-upload-default1');
        file.trigger('click');
    });

    $(document).on('click','.file-upload-clear1',function() {
        $('.file-upload-default1').val('');
        $('.file-upload-default1').trigger('change');
    });

    $(document).on('change', '.file-upload-default1', function() {
        var el = $(this) ;
        var preview = $('#preview1') ;      

        if(el.val() && el.valid()) {
            readURL(this);
            el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
            return true ;
        }
        
        preview.attr('src', preview.data('default'));
        el.val('');
        el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
    });
// $("#icon_image").checkImageSize({
//   minWidth: 64,
//   minHeight: 64,
//   maxWidth: 64,
//   maxHeight: 64,
//   showError:true,
//   ignoreError:false

// });
    var readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview1').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }



});

    </script>
@endpush



