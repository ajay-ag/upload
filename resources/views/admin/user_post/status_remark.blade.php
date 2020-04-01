<div class="modal fade" id="addcategory" role="dialog" aria-labelledby="addcategory" aria-hidden="true">

    <div class="modal-dialog" role="document">


            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Post Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true" data-msg-required="Brand is required.">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div id="form-errors"></div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="name">Cancellation Reason </label>
                                        @php
                                            $remark=DB::table('post_remarks')->get();
                                        @endphp
                                        <select disabled   data-rule-required="true" style="width: 100%" required="" name="post_remark" id="post_remark"
                                                class="form-control">
                                            <option value="">Please select remark </option>

                                            @foreach( $remark as $remk)
                                                <option value="{{$remk->id}}"
                                                        {{$remk->id==$post->post_remark ? 'selected':''}}
                                                >
                                                    {{$remk->name}}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group ">
                                        <label for="name">Note</label>
                                        <textarea disabled id="note"  class="form-control" name="note"

                                                  rows="3">{{$post->note ?? ''}}</textarea>


                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>


                </div>



            </div>

    </div>
</div>
<!-- <div id="form-errors"></div> -->
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
<script>

    $(document).ready(function () {

        $('.status').on('change', function () {


            if (this.value == "canceled") {
                $(".comment").removeClass("d-none");
            } else {
                $(".comment").addClass("d-none");
            }
        });


        $("#status").select2({
            allowClear: true,
            placeholder: 'Select Status',
            multiple: false
        });


        $('#ourclientform').validate({
            debug: false,
            // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {},
            messages: {},
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


