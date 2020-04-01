@extends('admin.layout.app')
@section('title','Add Post Attribute')

@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Add Post Attribute',
    'back' =>  route('admin.post-attribute.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')
<div class="container-fluid">

<form action="{{ route('admin.post-attribute.store') }}" enctype="multipart/form-data" method="POST" name="attribute_form"
    id="attribute_form" autocomplete="off" data-exit-url="{{ url('common_check_exist') }}">
    @csrf
    <div class="row">
          <div class="col-md-3">
            
          </div>
          <div class="col-md-9">
                   @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            <div class="card">
              
                <div class="card-body">
                    

                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="title">Category <span class="text-danger">*</span> </label>
                      
                    <select  required class="form-control"  data-msg-required="Category is required." id="category"  name="category"  onchange="getSub(this.value);" style="width: 100%;">
                        <option value="">Select Category</option>
                                @foreach($category as $type)
                                        <option value="{{$type->id}}">{{$type->name ?? ''}}</option>
                                @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Sub Category <span class="text-danger">*</span> </label>
                        <select data-msg-required="Sub Category is required."  required id="subcategory" 
                                name="subcategory"
                                class="form-control" style="width: 100%;">
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="title">Attributes</label>
                      

                    </div>

                     <div class="repeater">
                            <div data-repeater-list="attribute_list">
                                <div data-repeater-item>
                                    <div class="row">
                         
                                         <div class="col-md-4">

                                            
                                                  <div class="form-group">
                                                       <label for="title">Name <span class="text-danger">*</span> </label>
                                                      <input type="text" id="name"  data-msg-required="Name is required." name="name" data-rule-required="true" class="form-control">
                                                </div>

                                           
                                        </div>

                                        

                                        <div class="col-md-1">
                                           
                                                  <div class="form-group">
                                                   
                                                     <div style="margin-top:28px;"></div>
                                                     <button type="button" data-repeater-delete type="button" class="btn btn-danger waves-effect waves-light" ><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                                                </div>

                                            
                                        </div>


                                   

                                       
                                    </div>
                                  
                                    <br>
                                </div>
                            </div>
                           <button data-repeater-create type="button" value="Add New" class="btn btn-success " type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add More</button>
                        </div>
                    

                </div>
                <div class="card-footer">
                  <div class="float-right">
               
                  <button type="submit" name="save" class="btn btn-success"><span id="sid" role="status" aria-hidden="true"></span> Save</button>

                </div>
                </div>
            </div>

                   
            

        </div>



        
    </div>
  
   
</form>
</div>

@endsection
@push('js')
   <script src="{{ asset('assets/admin/js/jquery-repeater.min.js') }}"></script>
   <script src="{{ asset('assets/admin/js/setting/post-attribute.js') }}"></script>
@endpush
@push('scripts')
    <script>
    
    function getSub(id) {

         if(id==""){
             $('#subcategory').html('');
         }else{
             $('#subcategory').html('');
             $('#subcategory').prepend($('<option></option>').html('Loading...'));
         }
        if (id != '') {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: '{{ route('admin.postattribute.getsubcategory') }}',
                method: "POST",
                data: {
                    id: id
                },
                success: function (result) {
                    if (result.errors)
                    {
                        $('.alert-danger').html('');
                    }
                    else
                    {
                        $('#subcategory').html(result);
                    }
                }
            });
        }
    }
</script>
   
   

@endpush



