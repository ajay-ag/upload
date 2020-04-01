@extends('admin.layout.app')

@section('title' , $title)

@push('css')
   

@push('js')
    
@endpush

@section('content')
@component('component.heading',[

'page_title' => 'Inquiry Add',
'icon' => 'ik ik-mail' ,
'tagline' =>'' ,

'action' => route('admin.inquirey.index') ,
'action_icon' => 'ik ik-arrow-left' ,
'text' => 'Back'
])

@endcomponent
<div class="section">
    
    
    <form action="{{ route('admin.inquirey.store') }}" method="POST" name="inquiryform" id="inquiryform" enctype="multipart/form-data">
        @csrf

        <div class="row">

            @include('component.error')

            <div class="col-sm-3">
                <h5 class=""><strong>Description</strong></h5>
                <p class="text-muted">An inquiry is a question which you ask in order to get some information. </p>
            </div>

            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input id="name" class="form-control" type="text" name="name" 
                                    data-rule-required="true" data-msg-required="Name is required" maxlength="190">
                                </div>
                            </div>
                        </div>
    
                         <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mobile">Mobile No <span class="text-danger">*</span></label>
                                    <input id="mobile" class="form-control" type="text" name="mobile" 
                                    data-rule-required="true"
                                    data-msg-required="Mobile no is required" maxlength="10"  data-rule-number="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Email </label>
                                    <input id="email" class="form-control" type="email" name="email" 
                                    maxlength="190" 
                                    >
                                </div>
                            </div>
                        </div>

                       
                         <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                   <textarea class="form-control html-editor" rows="10" 
                                     name="remark"></textarea>
                                </div>
                            </div>
                        </div>

                        

               
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-end">
                <button type="submit" class="btn btn-success shadow" id="btn_save"><i class="ik ik-check-circle" id="cl"></i>Download</button>
            </div>    
        </div>    
    </form>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

<script type="text/javascript">

        $('#inquiryform').validate({   
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


