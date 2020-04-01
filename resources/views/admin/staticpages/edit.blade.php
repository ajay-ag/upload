@extends('admin.layout.app')
@section('title',@$title)
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Static pages',
    'back' =>  route('admin.staticpages.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')

<div class="container-fluid">
<form action="{{ route('admin.staticpages.update',[$staticpages->id]) }}" enctype="multipart/form-data" method="POST" name="staticpages_form"
    id="staticpages_form" autocomplete="off">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="id" value="{{ $staticpages->id }}">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>Static pages</strong> </h6>
                    <hr>
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span> </label>
                        <input id="title" class="form-control" type="text" name="title" 
                        data-msg-required="Static page name is required." data-rule-required="true" maxlength="190" value="{{ $staticpages->title ?? '' }}">
                    </div>
                      <div class="form-group">
                        <div class="form-group">
                            <label for="content">Description <span class="text-danger"></span> </label>
                            <textarea id="description" class="ckeditor form-control col-8" data-rule-ckdata="ck"     name="description" 
                                data-rule-required="false"
                                data-msg-ckdata="Description is required."
                                rows="3">{{ $staticpages->description ?? '' }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
             
            

        </div>

         <div class="col-sm-4">

            
             <div class="card">
                    <div class="card-body">
                           <div class="form-row">
                             <div class="col-12">
                                 <div class="form-group">
                             <label for="slug">Banner Image <span class="text-danger"> *</span></label>
                                       <div class="text-left">
                         
                                            

                                         <img src="{{ $staticpages->staticpages_banner_image }}"
                                                data-default="{{ $staticpages->staticpages_banner_image }}" class="w-100"
                                                id="preview2" style="width:100%;height:120px;">   
                                          
                                    </div>

                                        <input type="file" name="banner_image" class="file-upload-default2"
                                             data-rule-accept="png,jpeg,jpg"
                                            data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                            data-rule-required="false" data-rule-filesize="5000000" id="banner_image"
                                            data-msg-required="Banner Image is required."
                                            data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;position: absolute;" data-image-target="#preview2">
                                    
                                        <div class="input-group mt-4">
                                        <input type="text" class="form-control form-banner-control file-upload-info2" disabled=" " placeholder="Upload Banner Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse2  shadow-sm btn btn-primary"
                                                    type="button">Upload</button>


                                            </span>
                                            <span class="input-group-append">
                                                <button class="file-upload-clear2 btn shadow-sm btn-danger"
                                                    type="button">Clear</button>
                                            </span>
                                        </div>

                                    </div>
                                    <span class="text-danger"> *</span> Image size (1920 x 256)</div>

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
         

<script src="{{ asset('assets/admin/js/setting/staticpage.js') }}"></script>
<script src="{{asset('assets/js/jquery.checkImageSize.js')}}"></script>

@endpush



