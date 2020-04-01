<div class="modal fade" id="addinqury" role="dialog" aria-labelledby="addinqury" aria-hidden="true">

    <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" >Inquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"  data-msg-required="Brand is required." >&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                                     
                                        <table class="table table-borderless">
                                            <tbody>
                                                 <tr>
                                                    <td><strong>Name</strong></td>
                                                    <td class="text-muted">{{ $inquiry->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Mobile</strong></td>
                                                    <td class="text-muted">{{ $inquiry->mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email</strong></td>
                                                    <td class="text-muted">{{ $inquiry->email ?? 'N/A' }}</td>
                                                </tr>
                                                 <tr>
                                                    <td><strong>Remark</strong></td>
                                                    <td class="text-muted">{{ $inquiry->remarks ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                                    {{--  <div class="col-md-12 col-12"> <strong>Remark</strong>
                                                       
                                                        <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                    </div>--}}
                                      

                                     
                                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="ik ik-x"></i>Close</button>
                    
                </div>

            </div>
 
    </div>
</div>
<!-- <div id="form-errors"></div> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>


