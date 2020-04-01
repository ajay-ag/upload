@extends('admin.layout.app')
@section('title','Create Package')

@section('wrapper')
@component('component.heading' , [
    'page_title' => 'Add Package',
    'back' =>  route('admin.plan.index'),
    'text' => 'Back',
])
@endcomponent
@endsection


@section('content')

<div class="container-fluid">
  <form action="{{ route('admin.plan.store') }}" method="post" name="planForm" id="planForm" enctype="multipart/form-data" data-url="{{ route('admin.checkPlan') }}">
  @csrf

    <div class="row">
      @include('component.error')
      <div class="col-md-3">
      </div>
      <div class="col-md-9">
        <div class="card">
          <!--Begin :: Body -->
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-4">
                <label for="title">Package Name <i class="text-danger">*</i></label>
                <input type="text" name="title" id="title" data-rule-required="true" data-msg-required="This field is required." class="form-control">
              </div>

               <div class="form-group col-md-4">
                <label for="feature">Feature <i class="text-danger">*</i></label>
                <input type="text" name="feature" id="feature" data-rule-required="true" data-msg-required="This field is required." class="form-control">
              </div>

               <div class="form-group col-md-4">
                <label for="price">Price <i class="text-danger">*</i></label>
                <input type="text" name="price" id="price" data-rule-required="true" data-msg-required="This field is required." class="form-control" data-rule-number="true">
              </div>
            </div>
          </div>
          <!-- end :: Body -->
          <!-- <div class="card-footer">
            
          </div> -->


        </div>
        <div class="float-right">
             <!--  <a href="{{route('admin.plan.index')}}" class="btn btn-default">Cancel</a> -->
              <button type="submit" class="btn btn-success" name="save"><span id="sid" role="status" aria-hidden="true"></span> Save</button>
            </div>
      </div>
    </div>
    
  </form>
</div>

@endsection

@push('js')

<script src="{{ asset('assets/admin/js/plan/validation-plan.js') }}" type="text/javascript"></script>
@endpush
