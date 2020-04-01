@extends('admin.layout.app')
@section('title','Edit Post Attribute')
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Edit Post Attribute',
    'back' =>  route('admin.post-attribute.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')
<div class="container-fluid">

<form action="{{ route('admin.post-attribute.update',[$attribute->id]) }}" enctype="multipart/form-data" method="POST" name="attribute_form"
    id="attribute_form" autocomplete="off">
          <input type="hidden" name="id" id="id" value="{{ $attribute->id ?? '' }}">
    @csrf
        @method('PUT')
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
                        <label for="title">Category <span class="text-danger">*</span> </label>
                      
                    <select  required class="form-control" id="category" data-msg-required="Sub Category is required."   name="category"  onchange="getSub(this.value);" style="width: 100%;">
                        <option value="">Select Category</option>
                                @foreach($category as $type)
                                        <option value="{{$type->id}}"
                                            {{ $type->id == $attribute->category_id ? 'selected' :''  }}
                                            >{{$type->name ?? ''}}</option>
                                @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Sub Category <span class="text-danger">*</span> </label>
                        <select required id="subcategory" 
                                name="subcategory"
                                data-msg-required="Sub Category is required." 
                                class="form-control" style="width: 100%;">
                                 @foreach($sub_category as $type)
                                        <option value="{{$type->id}}"
                                            {{ $type->id == $attribute->sub_category_id ? 'selected' :''  }}
                                            >{{$type->name ?? ''}}</option>
                                @endforeach
                                
                        </select>

                    </div>


                             <div class="form-group">
                        <label for="title">Attributes</label>
                      

                    </div>

                     <div class="repeater">
                            <div data-repeater-list="attribute_list">

                        @if(count($attribute_list))

                            @foreach($attribute_list as $name) 
                                
                                <div data-repeater-item>
                                    <div class="row">
                         
                                         <div class="col-md-4">
                                            <input type="hidden" value="{{ $name->id ?? 
                                                      '' }}" id="id" name="id" class="form-control">

                                            
                                                  <div class="form-group">
                                                       <label for="title">Name <span class="text-danger">*</span> </label>
                                                      <input type="text" value="{{ $name->name ?? 
                                                      '' }}" id="name" name="name" data-rule-required="true" class="form-control">
                                                </div>

                                           
                                        </div>

                                        

                                        <div class="col-md-1">
                                           
                                                  <div class="form-group">
                                                   
                                                     <div style="margin-top:28px;"></div>
                                                     <button data-atter-id="{{ $name->id ?? 
                                                      '' }}"   type="button" data-repeater-delete type="button" class="btn btn-danger waves-effect waves-light delbtn">
                                                        <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                    </button>
                                                </div>

                                            
                                        </div>


                                   

                                       
                                    </div>
                                  
                                    <br>
                                </div>
                            @endforeach


                            @else


                             <div data-repeater-item>
                                    <div class="row">
                         
                                         <div class="col-md-4">
                                            <input type="hidden" value="" id="id" name="id" class="form-control">

                                            
                                                  <div class="form-group">
                                                       <label for="title">Name <span class="text-danger">*</span> </label>
                                                      <input type="text"  data-msg-required="Name is required." value="" id="name" name="name" data-rule-required="true" class="form-control">
                                                </div>

                                           
                                        </div>

                                        

                                        <div class="col-md-1">
                                           
                                                  <div class="form-group">
                                                   
                                                     <div style="margin-top:28px;"></div>
                                                     <button data-atter-id="" type="button" data-repeater-delete type="button" class="btn btn-danger waves-effect waves-light delbtn" ><i class="far fa-trash-alt" aria-hidden="true"></i></button>
                                                </div>

                                            
                                        </div>


                                   

                                       
                                    </div>
                                  
                                    <br>
                                </div>


                            @endif


                            </div>
                           <button data-repeater-create type="button" value="Add New" class="btn btn-success" type="button"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add More</button>
                        </div>
                    

                </div>
                 <div class="card-footer">
                  <div class="float-right">
               
                  <button type="submit" name="save" class="btn btn-success"><span id="sid" role="status" aria-hidden="true"></span> Save</button>

                </div>
                </div>
            </div>

                   
            

        </div>



        <div class="col-sm-4">


        </div>
    </div>
   
 
</form>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/admin/js/jquery-repeater-edit.min.js') }}"></script>
@endpush
@push('scripts')
  
      <script>
        var relationurl="{{ route('admin.post.attribute.relation') }}"

        $("#category").select2({
        allowClear:true,
        placeholder: 'Select Category',
           multiple:false
      }); 
    $("#subcategory").select2({
        allowClear:true,
        placeholder: 'Select Sub Category',
           multiple:false
      });
    $(document).ready(function () {

        $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            initEmpty: '{{ $count }}',
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'text-input': 'foo'
            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function () {

               $(this).find('.delbtn').attr('data-atter-id','');
               
                       // var t =$(this).attr("data-atter-id");
                      // $('.delbtn').attr('data-atter-id','');
                $(this).slideDown();
       
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            ready: function (setIndexes) {
                //$dragAndDrop.on('drop', setIndexes);
            },
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            isFirstItemUndeletable: false
        })
    });
</script>

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
   
   
    <script type="text/javascript">
  
    $('#attribute_form').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {


            subcategory: {
                // required: true,
                remote: {
                    async: false,
                    url: "{{ url('common_check_exist') }}",
                    type: "post",
                    data: {
                        _token: function () {
                            return "{{csrf_token()}}"
                        },
                        form_field: function () {
                            return $("#category").val();
                        },
                        id: function ()
                        {
                            return $("#id").val();
                        },
                        db_field: function () {
                            return 'category_id';
                        },
                        table: function () {
                            return 'post_attributes';
                        },
                        condition_form_field: function () {
                            return $("#subcategory").val();
                        },
                        condition_db_field: function () {
                            return 'sub_category_id';
                        }
                    }
                }
            }

            
            },
        messages: {

             subcategory:{
                 remote: "Post Attribute is already exits."
            }

                
          
        },
        errorPlacement: function (error, element) {            
            error.appendTo(element.parent()).addClass('text-danger-custom');
            if(element.parent('.input-group').length)
                {
                    error.insertAfter(element.parent());
                }
        },
        submitHandler: function (e) {
           $("button[name='save']").attr("disabled", "disabled").button('refresh');
                                        $('#attribute_form').find('span#sid').addClass("spinner-border spinner-border-sm");
                                                            return true;
        }
    })
      
    </script>

@endpush



