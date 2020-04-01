<div class="modal fade" id="addcategory" role="dialog" aria-labelledby="addcategory" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.post.store') }}" method="POST" id="ourclientform" name="ourclientform"
              enctype="multipart/form-data">
            @csrf()

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Status Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true" data-msg-required="Brand is required.">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div id="form-errors"></div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div class="col">
                                    <input type="hidden" name="id" value="{{$post->id}}">

                                    <div class="form-group">
                                        <label for="name">Status</label>
                                        <select style="width: 100%" required="" name="status" id="status"
                                                class="form-control status">
                                            <option {{$post->status=="pending" ? 'selected':''}} value="pending">
                                                Pending
                                            </option>
                                            <option {{$post->status=="approved" ? 'selected':''}} value="approved">
                                                Approved
                                            </option>
                                            <option {{$post->status=="canceled" ? 'selected':''}} value="canceled">
                                                Canceled
                                            </option>

                                        </select>

                                    </div>

                                    <div class="form-group comment d-none">
                                        <label for="name">Post Remark <span class="text-danger">*</span></label>
                                        @php
                                            $remark=DB::table('post_remarks')->get();
                                        @endphp
                                        <select   data-rule-required="true" style="width: 100%" required="" name="post_remark" id="post_remark"
                                                class="form-control">
                                            <option value="">Please select remark </option>

                                            @foreach( $remark as $remk)
                                                <option value="{{$remk->id}}">
                                                    {{$remk->name}}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group comment d-none">
                                        <label for="name">Note</label>
                                        <textarea id="note"  class="form-control" name="note"

                                                  rows="3"></textarea>


                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="ik ik-x"></i>Close
                    </button>
                    <button type="submit" class="btn btn-success shadow" name="save"><span id="sid" role="status" aria-hidden="true"></span> Save
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="{{ asset('assets/admin/js/user_post/post-status.js') }}"></script>



