@extends('admin.layout.app')
@section('title',@$title)
@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Edit Subcategory',
    'back' =>  route('admin.subcategory.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')

<div class="container-fluid">
<form action="{{ route('admin.subcategory.update',[$subcategory->id]) }}" enctype="multipart/form-data" method="POST" name="subcategory_form"  data-exit-url="{{ url('common_check_exist') }}"
    id="subcategory_form" autocomplete="off">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" id="id" value="{{ $subcategory->id }}">
    <div class="row">
        <div class="col-md-3">
            
         </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>Category</strong> </h6>
                    <hr>
                     <div class="form-group">
                        <label for="category_id">Category Name <span class="text-danger">*</span> </label>
                        <select {{$count!='0' ? 'disabled':''}}   id="category_id" name="category_id" data-msg-required="Category name is required." data-rule-required="true" class="form-control" style="width: 100%;">
                        <option value="">Select Category Name</option>
                          @foreach($category as $ckey =>$category_val)
                                        <option value="{{$category_val->id}}"
                                            {{ $category_val->id == $subcategory->parent_id ? 'selected' :''  }}
                                            >{{$category_val->name ?? ''}}</option>
                                @endforeach




                        </select>

                    </div>

                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span> </label>
                        <input id="name" class="form-control" type="text" name="name"
                        data-msg-required="Name is required." data-rule-required="true" maxlength="190" value="{{ $subcategory->name ?? '' }}">
                    </div>



                </div>
            </div>

             <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input id="slug" class="form-control" type="text" name="slug" readonly="" value="{{ $subcategory->slug ?? '' }}">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

        </div>

    </div>

    <div class="row">
        <div class="col d-flex justify-content-end mb-4">
            <button type="submit" class="btn btn-success shadow" name="save"><span id="sid" role="status" aria-hidden="true"></span>Save</button>
        </div>



    </div>
</form>
</div>
<div id="load-modal"></div>

@endsection



@push('js')

<script>

var count='{{$count}}';


</script>

<script src="{{asset('assets/admin/js/setting/subcatgeory.js')}}"></script>
<script type="text/javascript">
                if(count==0){

           $("#category_id").select2({
           allowClear:true,
           placeholder: 'Select Categoty',
           multiple:false
            });
            }
</script>


@endpush



