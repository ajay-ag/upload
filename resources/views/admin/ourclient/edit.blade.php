<div class="modal fade" id="addcategory" role="dialog" aria-labelledby="addcategory" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.ourclient.update',[$ourclient->id]) }}" method="POST" id="ourclientform" name="ourclientform" enctype="multipart/form-data">
           @csrf()
                @method('PUT')
             
                <input type="hidden" name="id" id="id" value="{{ $ourclient->id }}">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" >Edit Our Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true" >&times;</span></button>
                </div>

                <div class="modal-body">
                    <div id="form-errors"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" class="form-control" type="text" name="name"
                                             maxlength="190" value="{{ $ourclient->name  }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">                        
                       
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="text-left">
                                        <img src="{{ $ourclient->our_image }}"
                                            data-default="{{ $ourclient->our_image }}" class="w-40"
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
            //          url: "{{ route('admin.employee.check.update') }}",
            //          type: 'post',
            //          data: { id: $('#id').val() },
            //         }
            // },
            // designation:{
            //     required:true,
            // }
        },
        messages: {
            // name:{
            //     required:"Employee Name is required",
            //     remote:"Employee alredy exits",
            // },
            // designation:{
            //     required:"Designation is required",
            // }
        },
        errorPlacement: function (error, element) {            
            error.appendTo(element.parent()).addClass('text-danger');
        },
        submitHandler: function (e) {
                // var formData = $("#categoryform");
                $("#cl").removeClass('ik ik-check-circle').addClass('fa fa-spinner fa-spin');
                return true;
                // var formData = new FormData($("#categoryform")[0]);
                // var url = $("#categoryform").attr('action');
           
                // $.ajax({
                //     url:url,
                //     type:'POST',
                //      processData: false,
                //     contentType: false,
                //     data:formData,
                //     success:function(data) {
                //    $("#addcategory").modal('hide');
                //    $("#categoryDataTable").dataTable().api().ajax.reload();
                //         message.fire({
                //             type: 'success',
                //             title: 'Success' ,
                //             text: data.message,
                //         });
                //     },
                //     error:function(xhr, status, error) {
                //         /* Act on the event */
                //         if( xhr.status === 422 ) {
                    
                //         var errors = xhr.responseJSON.errors;
                //         errorsHtml = '<div class="alert alert-danger"><ul>';
                //          $.each( errors , function( key, value ) {
                //                 console.log( value[0] );
                //                 errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                //             });
                //             errorsHtml += '</ul></di>';
                //             $( '#form-errors' ).html( errorsHtml );
                            
                //         }
                //         $("#cl").removeClass('fa fa-spinner fa-spin').addClass('ik ik-check-circle');
                //          message.fire({
                //             type: 'error',
                //             title: 'Error' ,
                //             text: 'something went wrong please try again !',
                //         })
                //     },
                // });
        }
    })


    
});
</script>


