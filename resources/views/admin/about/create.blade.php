@extends('admin.layout.app')

@section('title' , $title)
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'About Us',
    
])
@endcomponent
@endsection
@section('content')

<div class="container-fluid">
<form action="{{ route('admin.about.store') }}" enctype="multipart/form-data" method="POST" name="about_form"
    id="about_form" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                 
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span> </label>
                        <input id="title" class="form-control" type="text" name="title" 
                        data-msg-required="Title is required." data-rule-required="true" maxlength="190" value="{{ $about->title ?? '' }}">
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span> </label>
                            <textarea id="content" class="ckeditor form-control col-8" data-rule-ckdata="ck"     name="content" 
                                data-rule-required="true"
                                data-msg-ckdata="Content is required."
                                rows="3">{{ $about->content ?? '' }}
                            </textarea>
                        </div>
                    </div>

                </div>
            </div>
       {{--       <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="home_title">Title</label>
                                    <input id="home_title" class="form-control" type="text" name="home_title"
                                    
                                    value="{{ $about->meta_title ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="home_keywords">Keywords </label>
                                    <input id="home_keywords" class="form-control" type="text" name="home_keywords"
                                    value="{{ $about->meta_keywords ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="home_description">Description</label>
                                <textarea name="home_description" class="form-control" id="home_description" cols="30"
                                    rows="10">{{ $about->meta_description ?? '' }}</textarea>
                      
                                </div>
                            </div>
                        </div>


    

                    </div>
                </div> --}}

 
        


        </div>
        <div class="col-sm-4">

            {{-- image --}}
             <div class="card">
                <div class="card-body">
                
                    <label >Image <span class="text-danger"> *</span> </label>
                    <hr>
                    <div class="row">
                    
                          <div class="col-12">
                                    <div class="text-center">
                         
                                        <img src="{{ $about->about_image }}"
                                            data-default="{{ $about->about_image }}" width="200" height="200" 
                                            id="preview" >
                                          
                                    </div><br>
                                </div>
                                <div class="col-12">                                    
                                    <div class="form-group">
                                        @if($about->about_image!='')
                                        <input type="file" name="slider_image" class="file-upload-default"
                                            data-rule-accept="jpg,png,jpeg"
                                            data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                            data-rule-required="false" data-rule-filesize="5000000" id="featured_image" style="visibility: hidden;position: absolute;"
                                            data-msg-required="Image is required."
                                            data-msg-filesize="File size must be less than 5mb">
                                        @else
                                        <input type="file" name="slider_image" class="file-upload-default"
                                            data-rule-accept="jpg,png,jpeg"
                                            data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                            data-rule-required="true" data-rule-filesize="5000000" id="featured_image" style="visibility: hidden;position: absolute;"
                                            data-msg-required="Image is required."
                                            data-msg-filesize="File size must be less than 5mb">
                                        @endif
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

        </div>
    </div>
   
    <div class="row">
        <div class="col d-flex justify-content-end mb-4">
            <button type="submit" class="btn btn-success shadow" name="save"><span id="sid" role="status" aria-hidden="true"></span> Save</button>
        </div>
      
  

    </div>
</form>
</div>
<div id="load-modal"></div>

@endsection



@push('js')
      
  
    <script src="{{ asset('assets/admin/js/category.js') }}"></script>
   
    <script type="text/javascript">
  
    $('#about_form').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {
          
            },
        messages: {
          
        },
        errorPlacement: function (error, element) {            
           error.appendTo(element.parent()).addClass('text-danger-custom');
            if(element.parent('.input-group').length)
                {
                    error.insertAfter(element.parent());
                }
        },
        submitHandler: function (e) {
         $("button[name='save']").attr("disabled", "disabled").button('refresh');
         $('#about_form').find('span#sid').addClass("spinner-border spinner-border-sm");
         return true;
        }
    })
      
    </script>
@endpush



