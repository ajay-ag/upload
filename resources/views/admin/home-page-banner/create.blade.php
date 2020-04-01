@extends('admin.layout.app')
@section('title',' Homepage Banner')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Homepage Banner',
   
])
@endcomponent
@endsection
@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.homepagebanners.store') }}" enctype="multipart/form-data" method="POST"
          name="category_form"
          id="category_form" autocomplete="off">
        @csrf


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                      
                        <div class="form-group">
                            <label for="name">Title </label>
                            <input id="title" class="form-control ckeditor" type="text" name="title"
                                   maxlength="190" value="{{ $title_banner ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="name">Description</label>
                            <input id="description" class="form-control" type="text" name="description"
                                   maxlength="190" value="{{ $content_banner ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-4">

                {{-- image --}}
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-mute">Slider 1 </h6>


                        <hr>
                        <div class="row">


                            <div class="col-12">
                                <div class="text-left">

                                    <img src="{{ $image1->slider_imge ?? '' }}"
                                         data-default="{{ $image1->slider_imge ?? '' }}" class="w-40 "
                                         id="preview" style="width:100%;height:120px;">

                                </div>
                                <br>
                            </div>
                            <div class="col-12">
                                <div class="form-group">

                                    <input

                                        type="file" name="image1"
                                        class="file-upload-default check-image-size"
                                        data-rule-accept="jpg,png,jpeg"
                                        data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                        data-rule-required="false" data-rule-filesize="5000000"
                                        id="image1"  style="visibility: hidden;position: absolute;"
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
                                    <br>

                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input id="status_{{$image1->id}}" name="status_{{$image1->id}}"
                                               data-url="{{ route('admin.homepagebanners.status') }}" type="checkbox"
                                               class="change-status custom-control-input"
                                               value="{{$image1->id}}" {{  $image1->is_active =="Yes" ? 'checked' :'' }} />
                                        <label for="status_{{$image1->id}}" class="custom-control-label"></label>
                                    </div>


                                </div>

                                <span class="text-danger"> *</span> Image size (1920 x 595)
                            </div>

                        </div>

                    </div>
                </div>


            </div>


            <div class="col-sm-4">

                {{-- image --}}
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-mute">Slider 2</h6>
                        <hr>
                        <div class="row">

                            <div class="col-12">
                                <div class="text-left">

                                    <img src="{{ $image2->slider_imge ?? '' }}"
                                         data-default="{{ $image2->slider_imge ?? '' }}" class="w-40"
                                         id="preview1" style="width:100%;height:120px;">

                                </div>
                                <br>
                            </div>
                            <div class="col-12">
                                <div class="form-group">

                                    <input

                                        type="file" name="image2" class="file-upload-default1 check-image-size"
                                        data-rule-accept="png,jpeg,jpg"
                                        data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                        data-rule-required="false" data-rule-filesize="5000000"
                                        id="image2"
                                        data-msg-required="Banner Image is required."
                                        data-msg-filesize="File size must be less than 5mb"
                                        style="visibility: hidden;position: absolute;" data-image-target="#preview1">

                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                               placeholder="Upload Background Image">
                                        <span class="input-group-append">
                                                <button class="file-upload-browse1 shadow-sm btn btn-primary"
                                                        type="button">Upload</button>


                                            </span>
                                        <span class="input-group-append">
                                                <button class="file-upload-clear1 btn shadow-sm btn-danger"
                                                        type="button">Clear</button>
                                            </span>
                                    </div>

                                    <br>

                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input id="status_{{$image2->id}}" name="status_{{$image2->id}}"
                                               data-url="{{ route('admin.homepagebanners.status') }}" type="checkbox"
                                               class="change-status custom-control-input"
                                               value="{{$image2->id}}" {{  $image2->is_active =="Yes" ? 'checked' :'' }} />
                                        <label for="status_{{$image2->id}}" class="custom-control-label"></label>
                                    </div>

                                </div>


                                <span class="text-danger"> *</span> Image size (1920 x 595)


                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-sm-4">

                {{-- image --}}
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-mute">Slider 3 </h6>
                        <hr>
                        <div class="row">

                            <div class="col-12">
                                <div class="text-left">

                                    <img src="{{ $image3->slider_imge ?? '' }}"
                                         data-default="{{ $image3->slider_imge ?? '' }}" class="w-40"
                                         id="preview2" style="width:100%;height:120px;">

                                </div>
                                <br>
                            </div>
                            <div class="col-12">
                                <div class="form-group">

                                    <input type="file"
                                           name="image3"

                                           class="file-upload-default2 check-image-size"
                                           data-rule-accept="png,jpeg,jpg"
                                           data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                           data-rule-required="false" data-rule-filesize="5000000"
                                           id="image3"
                                           data-msg-required="Background Image is required."
                                           data-msg-filesize="File size must be less than 5mb"
                                           style="visibility: hidden;position: absolute;" data-image-target="#preview2">

                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control form-banner-control file-upload-info2"
                                               disabled="" placeholder="Upload Banner Image">
                                        <span class="input-group-append">
                                                <button class="file-upload-browse2  shadow-sm btn btn-primary"
                                                        type="button">Upload</button>


                                            </span>
                                        <span class="input-group-append">
                                                <button class="file-upload-clear2 btn shadow-sm btn-danger"
                                                        type="button">Clear</button>
                                            </span>
                                    </div>

                                    <br>
              
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input id="status_{{$image3->id}}" name="status_{{$image3->id}}"
                                               data-url="{{ route('admin.homepagebanners.status') }}" type="checkbox"
                                               class="change-status custom-control-input"
                                               value="{{$image3->id}}" {{  $image3->is_active =="Yes" ? 'checked' :'' }} />
                                        <label for="status_{{$image3->id}}" class="custom-control-label"></label>
                                    </div>

                                </div>
                                <span class="text-danger"> *</span> Image size (1920 x 595)
                            </div>
                        </div>
                    </div>
                </div>


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
  

    <script src="{{ asset('assets/admin/js/category.js') }}"></script>
    <script src="{{ asset('assets/admin/js/setting/home-banner.js') }}"></script>
    <script src="{{asset('assets/js/jquery.checkImageSize.js')}}"></script>


@endpush



