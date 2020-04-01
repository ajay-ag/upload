@extends('admin.layout.app')
@section('title',@$title)
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

<style type="text/css">
.text-left {
    text-align: center!important;
}
</style>
@endpush
@section('content')
@component('component.heading' , [
    'page_title' => 'User Detail',
    'icon' => 'ik ik-layers' ,
    'tagline' =>'This is user detail table' ,
    'action' => route('admin.site-user.index') ,
    'action_icon' => 'ik ik-arrow-left' ,
    'text' => 'Back'
])
@endcomponent

@php 

@endphp 
 <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>User Personal Detail</strong> </h6>
                    <hr>
                      <div class="form-group"> 
                        <label for="category_id">Name:</label>
                        {{$user->name}}
                        </div>

                         <div class="form-group"> 
                            <label for="category_id">Email:</label>
                            {{$user->email}}
                        </div>

                        <div class="form-group"> 
                            <label for="category_id">Mobile:</label>
                            {{$user->mobile}}
                        </div>

                        <div class="form-group"> 
                            <label for="category_id">State:</label>
                             @if($user->personal_state!="")
                                {{$state[$user->personal_state]->name}}
                            @endif
                        </div>

                        <div class="form-group"> 
                            <label for="category_id">City:</label>
                            @if($user->personal_city!="")
                                {{$cities[$user->personal_city]->name}}
                            @endif
                            
                        </div>

                         <div class="form-group"> 
                            <label for="category_id">Address:</label>
                            {{$user->personal_address}}
                        </div>


                </div>
            </div>

        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>User Business Detail</strong> </h6>
                    <hr>
                         <div class="form-group"> 
                            <label for="category_id">Name:</label>
                            {{$user->business_name}}
                        </div>
                            <div class="form-group"> 
                            <label for="category_id">GST No:</label>
                            {{$user->business_gst}}
                         </div>

                         <div class="form-group"> 
                            <label for="category_id">PAN No:</label>
                            {{$user->business_pan}}
                         </div>

                         <div class="form-group"> 
                            <label for="category_id">State:</label>
                            @if($user->business_state!="")
                                {{$state[$user->business_state]->name}}
                            @endif
                         </div>

                         <div class="form-group"> 
                            <label for="category_id">City:</label>
                           @if($user->business_city!="")
                                {{$cities[$user->business_city]->name}}
                            @endif
                         </div>
                            <div class="form-group"> 
                            <label for="category_id">Address:</label>
                            {{$user->business_address}}
                         </div>

                       

                     </div>
            </div>

        </div>
       
    </div>
@endsection


<!-- <div id="form-errors"></div> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>



