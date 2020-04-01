@push('css')
<link href="{{ asset('assets/admin/css/croppie.css')}}" rel="stylesheet" type="text/css" />
@endpush
<div class="col-md-4">
     <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center" id="tag_container">
                  <img class="profile-user-img img-fluid img-circle" id="showcropimg"
                       src="{{ $admin->profile_image }}"
                       alt="User profile picture">
                  </div>
                  <div class="text-center mt-3">
                   <label for="uplode_btn" class="btn btn-sm btn-primary">Upload Image</label>
                       <input type="file" value="Choose a file" accept="image/*" id="uplode_btn" name="uplode_btn"  style="display:none;">
                  </div>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item" style="border:none;">
                        <b>Name</b> <a class="ml-2"> {{ $adminlogin->name }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Email</b> <a class="ml-2"> {{ $adminlogin->email }}</a>
                      </li>
                      
                    </ul>

                
              </div>
              <!-- /.card-body -->
     </div>
</div>

<!-- Start Cropie Modal -->
   <div class="modal fade" id="profile_modal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-demo"></div>
                <input type="hidden" name="profile_url" id="profile_url" value="{{ route('admin.changeProfilImage' , ['id' => $admin->id ]) }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn upload-result btn-primary">Save </button>
            </div>
        </div>
    </div>
</div>
<!-- End Cropie Modal -->

@push('js')

<script src="{{asset('assets/admin/js/croppie.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/exif.js') }}"></script>
<script src="{{asset('assets/admin/js/croppie-validation.js') }}"></script>

@endpush
