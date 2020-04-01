@extends('admin.layout.app')

@section('title' , $title)

@section('content')
@component('component.heading',[

'page_title' => 'Add Slider',
'icon' => 'ik ik-home' ,
'tagline' =>'Edit home page banner' ,

'action' => route('admin.homepagebanners.index') ,
'action_icon' => 'ik ik-arrow-left' ,
'text' => 'Back'
])

@endcomponent
<div class="secction">
    <form action="{{ route('admin.homepagebanners.update', ['id' => $slider->id ] ) }}" method="POST" name="bannerform" id="bannerform"  enctype="multipart/form-data" >        
        @csrf()   
        @method('PUT')

        <div class="row">
            @include('component.error')
            
            <div class="col-md-8">
                <div class="card">
                     <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <h6><strong>Title <span class="text-danger"></span></strong></h6>
                                    <hr>
                                    <textarea class="form-control html-editor" name="title" id="title" rows="10"
                                    data-rule-required="false" 
                                    data-msg-required="Title is required">{{ $slider->title ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                      {{--    <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <h6><strong>Title Position</strong></h6>
                                    <hr>
                                    <div class="form-radio">
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" {{ $slider->title_position == 'Left' ? 'checked' : '' }} name="title_position" value="Left" checked="checked">
                                                <i class="helper"></i>Left
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="title_position" value="Center" {{ $slider->title_position == 'Center' ? 'checked' : '' }}>
                                                <i class="helper"></i>Center
                                            </label>
                                        </div>
                                       <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="title_position" value="Right" {{ $slider->title_position == 'Right' ? 'checked' : '' }} >
                                                <i class="helper"></i>Right
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <h6><strong>Status</strong></h6>
                            <hr>
                            
                            <div class="form-radio">
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="status" value="Yes" {{ $slider->is_active == 'Yes' ? 'checked' : '' }} >
                                        <i class="helper"></i>Enabled
                                    </label>
                                </div>
                                <div class="radio radio-inline">
                                    <label>
                                        <input type="radio" name="status" value="No" {{ $slider->is_active == 'No' ? 'checked' : '' }}>
                                        <i class="helper"></i>Disabled
                                    </label>
                                </div>
                            </div>
                        </div>
                        <h6><strong>Button Name <span class="text-danger"></span></strong></h6>
                        <hr>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="btn_name" id="btn_name" class="form-control" value="{{ $slider->btn_name ?? '' }}">
                                </div>
                            </div>
                        </div>
                         <h6><strong>Button Url <span class="text-danger"></span></strong></h6>
                        <hr>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="btn_url" id="btn_url" class="form-control" value="{{ $slider->btn_url ?? '' }}"  data-rule-url=”true”>
                                </div>
                            </div>
                        </div>
                         {{-- <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <h6><strong>Button Position</strong></h6>
                                    <hr>
                                    <div class="form-radio">
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="btn_position" value="Left" {{ $slider->btn_position == 'Left' ? 'checked' : '' }}>
                                                <i class="helper"></i>Left
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="btn_position" value="Center" {{ $slider->btn_position == 'Center' ? 'checked' : '' }}>
                                                <i class="helper"></i>Center
                                            </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <label>
                                                <input type="radio" name="btn_position" value="Right" {{ $slider->btn_position == 'Right' ? 'checked' : '' }}>
                                                <i class="helper"></i>Right
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <h6 class="text-mute"><strong>Slider Image <span class="text-danger">*</span></strong> </h6> <hr>
                                <div class="text-center">
                                <img src="{{$slider->slider_imge}}" data-default="{{ $slider->slider_imge }}" class="w-100" id="preview">
                                </div><br>
                                <div class="form-group">
                                    <input type="file" name="slider_image" class="file-upload-default"
                                    data-rule-accept="jpg,png,jpeg" data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                    data-rule-required="false" data-rule-filesize="5000000" id="featured_image"
                                    data-msg-required="Image is required." data-msg-filesize="File size must be less than 5mb" 
                                    >
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse shadow-sm btn btn-primary" type="button">Upload</button>
                                        </span>
                                        <span class="input-group-append">
                                            <button class="file-upload-clear btn shadow-sm btn-danger" type="button">Clear</button>
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
            <div class="col d-flex justify-content-end">
                <button type="submit" class="btn btn-success shadow"><i class="ik ik-check-circle">
                </i>Save</button>
            </div>    
        </div>    

    </form>
</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>        
@endpush    
@push('scripts')
    <script>

         $.validator.addMethod('filesize', function (value, element, param) {
            if (element.files.length) {
                return this.optional(element) || (element.files[0].size <= param)
            }
            return true;
        }, 'File size must be less than 5mb.');

        $(document).ready(function ()   {

            $('.file-upload-browse').on('click', function() {
                var file = $(this).parents().find('.file-upload-default');
                file.trigger('click');
            });

            $('.file-upload-clear').on('click', function() {
                $('.file-upload-default').val('');
                $('.file-upload-default').trigger('change');
            });

            $('.file-upload-default').on('change', function() {
                var el = $(this) ;
                var preview = $('#preview') ;      

                if(el.val() && el.valid()) {
                    readURL(this);
                    el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
                    return true ;
                }
                
                preview.attr('src', preview.data('default'));
                el.val('');
                el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
            });

            var readURL = function (input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

                
            $('#bannerform').validate({   
                debug: false,
                ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                rules: {},
                messages: {},
                errorPlacement: function (error, element) {            
                    // $(element).addClass('is-invalid')
                    error.appendTo(element.parent()).addClass('text-danger');
                },
                submitHandler: function (e) {
                    return true;
                }
            })

        });
        
    </script>
@endpush