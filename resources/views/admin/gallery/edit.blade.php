<div class="modal fade" id="addcategory" role="dialog" aria-labelledby="addcategory" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.gallery.update',[$gallery->id]) }}" method="POST" id="ourclientform" name="ourclientform" enctype="multipart/form-data">
            @csrf()
            @method('PUT')
             
                <input type="hidden" name="id" id="id" value="{{ $gallery->id }}">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" >Edit Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"  data-msg-required="Brand is required." >&times;</span></button>
                </div>

                <div class="modal-body">
                    <div id="form-errors"></div>
              

                    <div class="row">                        
                      
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="text-left">
                                        <img src="{{ $gallery->gallery_image }}"
                                            data-default="{{ $gallery->gallery_image }}" class="w-40"
                                            id="preview">
                                    </div><br>
                                </div>
                                <div class="col-12">                                    
                                    <div class="form-group">
                                        <input type="file" name="slider_image" class="file-upload-default"
                                            data-rule-accept="jpg,png,jpeg"
                                            data-msg-accept="Only image type jpg/png/jpeg is allowed."
                                            data-rule-required="false" data-rule-filesize="5000000" id="featured_image"
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
              

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="ik ik-x"></i>Close</button>
                    <button type="submit" class="btn btn-success shadow"><i class="ik ik-check-circle" id="cl">
                        </i>Save</button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- <div id="form-errors"></div> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
<script>

$(document).ready(function () {
    
    $('#ourclientform').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {
            // name:{
            //     required:true,
            //      remote:{
            //          url: "{{ route('admin.employee.check') }}",
            //          type: 'post',
            //         }
            // }
        },
        messages: {
            // name:{
            //     required:"Name is required",
            //     remote:"Employee alredy exits",
            // }
        },
        errorPlacement: function (error, element) {            
            error.appendTo(element.parent()).addClass('text-danger');
        },
        submitHandler: function (e) {
                // var formData = $("#categoryform");
                $("#cl").removeClass('ik ik-check-circle').addClass('fa fa-spinner fa-spin');
                return true;
       
        }
    })


    
});
</script>


