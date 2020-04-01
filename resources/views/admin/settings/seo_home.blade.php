@extends('admin.layout.app')

@section('title' , 'SEO home page')

@push('css')
   

@push('js')
    
@endpush

@section('content')
@component('component.heading',[

'page_title' => 'SEO Home',
'icon' => 'ik ik-home' ,
'tagline' =>'SEO home page.' ,

'action' => route('admin.settings.edit',['id'=>1]) ,
    'action_icon' => 'ik ik-arrow-left' ,
    'text' => 'Back'
])

@endcomponent
<div class="section">
    
    <form action="{{ route('admin.homeseo.update',['id'=>1]) }}" method="POST" name="seoform" id="seoform" enctype="multipart/form-data">
     @csrf()

        <div class="row">

            @include('component.error')

            <div class="col-sm-3">
                <h5 class=""><strong>SEO Home Page</strong></h5>
                <p class="text-muted">To set SEO title,keywords and description home page. </p>
            </div>

            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="home_title">Title</label>
                                    <input id="home_title" class="form-control" type="text" name="home_title"
                                    
                                    value="{{ $homeseo->home_title ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="home_keywords">Keywords </label>
                                    <input id="home_keywords" class="form-control" type="text" name="home_keywords"
                                    value="{{ $homeseo->home_keywords ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="home_description">Description</label>
                                <textarea name="home_description" class="form-control" id="home_description" cols="30"
                                    rows="10">{{ $homeseo->home_description ?? '' }}</textarea>
                      
                                </div>
                            </div>
                        </div>


    

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end">
                <button type="submit" class="btn btn-success shadow" id="btn_save"><i class="ik ik-check-circle" id="cl"></i>Save</button>
            </div>    
        </div>    
    </form>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

<script type="text/javascript">

        $('#seoform').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {},
        messages: {},
        errorPlacement: function (error, element) {            
            // $(element).addClass('is-invalid')
            error.appendTo(element.parent()).addClass('text-danger');
        },
        submitHandler: function (e) {
        $("#cl").removeClass('ik ik-check-circle').addClass('fa fa-spinner fa-spin');
            return true;
        }
    })

    </script>
@endpush


