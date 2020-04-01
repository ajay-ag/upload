@extends('admin.layout.app')

@section('title' , $title)
@section('wrapper')
@component('component.heading' , [

    'page_title' => 'General',
])
@endcomponent
@endsection
@section('content')

<div class="container-fluid">
<form action="{{ route('admin.settings.store') }}" enctype="multipart/form-data" method="POST" name="general_form" id="general_form" autocomplete="off">
    @csrf
   
    <div class="row">
         <div class="col-sm-3">
                <h5 class=""><strong>Site Detail</strong></h5>
                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
            </div>
        <div class="col-sm-9">
          @include('component.error')
            <div class="card">
                <div class="card-body">
                   <div class="form-group">
                        <label for="store_name">Store name <span class="text-danger">*</span> </label>
                                    <input id="store_name" class="form-control" type="text" name="store_name" data-rule-required="true" value="{{ $setting->store_name ?? '' }}" maxlength="190">
                    </div>
                    <div class="form-group">
                        <label for="address_name">Address <span class="text-danger">*</span> </label>
                                    <input id="address_name" class="form-control" type="text" name="address_name" data-rule-required="true" value="{{ $setting->address_name ?? '' }}" maxlength="190">
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                        <div class="col">
                           <label for="address_email">Email <span class="text-danger">*</span> </label>
                                    <input id="address_email" class="form-control" type="email" name="address_email" data-rule-required="true" value="{{ $setting->address_email ?? '' }}" maxlength="190">
                        </div>
                    
                        <div class="col">
                                    <label for="address_contact_us">Contact Us <span class="text-danger">*</span> </label>
                                    <input id="address_contact_us" class="form-control" type="text" name="address_contact_us" data-rule-required="true" value="{{ $setting->address_contact ?? '' }}" maxlength="10" data-rule-number=”true”>
                         </div>
                    </div>
                    </div>
                    <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="country">Country <span class="text-danger">*</span> </label>

                                    <select class="form-control select-change country-select2"  style="width:100%" name="country" id="country"   data-rule-required="true" 
                                        data-url="{{ route('admin.get.country') }}" 
                                        data-clear="#city_id,#state"
                                        data-msg-required="Country is required" >   
                                        <option value="">Select Country</option>
                                        @if ($setting->country)
                                            <option value="{{ $setting->country->id }}" selected >{{ $setting->country->name }}</option>   
                                        @endif
                                    </select>           

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="state">State <span class="text-danger">*</span></label>
                                    <select id="state" name="state" id="state" data-rule-required="true" style="width:100%"  
                                        data-msg-required="State is required" 
                                        data-url="{{ route('admin.get.state') }}" 
                                        data-target="#country" 
                                        data-clear="#city_id"
                                        class="selectpicker form-control state-select2 select-change">
                                        <option value="" > Select State </option>
                                        @if ($setting->country)
                                            <option value="{{ $setting->state->id }}" selected >{{ $setting->state->name }}</option>   
                                        @endif
                                    </select>                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="city_id">City <span class="text-danger">*</span> </label>
                                    <select id="city_id" name="city_id" data-rule-required="true" style="width:100%;" 
                                    data-url="{{ route('admin.get.city') }}" 
                                    data-target="#state" 
                                    data-msg-required="City is required" 
                                    class="selectpicker form-control city-select2">
                                        <option value="" > Select City </option>           
                                        @if($setting->city)
                                            <option value="{{ $setting->city->id }}" selected >{{ $setting->city->name }}</option>   
                                        @endif
                                    </select>                                      
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="postal_code">Pin code <span class="text-danger">*</span> </label>
                                    <input id="postal_code" class="form-control" type="text" name="postal_code"
                                    data-rule-required="true"
                                    value="{{  $setting->pincode ?? '' }}"
                                     data-msg-required="Pin code is required"
                                     data-rule-minlength="6"
                                     data-msg-minlength="pin code must be 6 digit."
                                     data-rule-maxlength="6"
                                     data-msg-maxlength="pin code must be 6 digit."
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col">
                                     <div class="form-group">
                                            <label for="favicon" class="form-control-label">Favicon <i class="text-danger">*</i></label><br>

                                            <div class="text-center">
                                              <img src="{{ $setting->favicon_image }}" data-default="{{ $setting->favicon_image }}" id="preview" height="100" width="100">
                                            </div>

                                            <input type="file" name="favicon" class="file-upload-default"
                                              data-rule-extension="jpg,png,jpeg,svg" data-msg-extension="Only image type jpg/png/jpeg/svg is allowed." data-rule-required="false" data-rule-filesize="5000000" id="favicon" data-msg-required="This field is required." data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;">

                                            <div class="input-group mb-2">
                                              <input type="text" class="form-control file-upload-info" disabled=""
                                              placeholder="Upload Image"  style="cursor: not-allowed;">
                                              <span class="input-group-append">
                                                  <button class="file-upload-browse shadow-sm btn btn-primary"
                                                     type="button">Upload</button>
                                              </span>
                                              <span class="input-group-append">
                                                  <button class="file-upload-clear btn shadow-sm btn-danger"
                                                      type="button" data-target="#faviconpreview">Clear</button>
                                              </span>
                                            </div>             
                                            </div> 
                                            <span>Note : Image size must be 33 x 35</span>


                            </div>



                            <div class="col">
                                    <div class="form-group">
                                            <label for="logo" class="form-control-label">Logo <i class="text-danger">*</i></label><br>

                                            <div class="text-center">
                                              <img src="{{ $setting->logo_image }}" data-default="{{ $setting->logo_image }}" id="preview1" height="100" width="200">
                                            </div>

                                            <input type="file" name="logo" class="file-upload-default1"
                                            data-rule-accept="jpg,png,jpeg" data-msg-accept="Only image type jpg/png/jpeg is allowed." 
                                            data-rule-required="false" data-rule-filesize="5000000" id="featured_image"
                                            data-msg-required="This field is required."
                                            data-msg-filesize="File size must be less than 5mb" style="visibility: hidden;">

                                            <div class="input-group mb-2">
                                              <input type="text" class="form-control file-upload-info" disabled=""
                                                  placeholder="Upload Image"  style="cursor: not-allowed;">
                                              <span class="input-group-append">
                                                  <button class="file-upload-browse1 shadow-sm btn btn-primary"
                                                      type="button">Upload</button>
                                              </span>
                                              <span class="input-group-append">
                                                  <button class="file-upload-clear1 btn shadow-sm btn-danger"
                                                      type="button">Clear</button>
                                              </span>
                                            </div>                
                                            </div> 
                                             <span>Note : Image size must be 133 x 35</span>
                            </div>
                        </div>


                        
                </div>
            </div>

        </div>
   
    </div>
     <div class="row">
         <div class="col-sm-3">
                <h5 class=""><strong>Social Media</strong></h5>
                <p class="text-muted">Social media refers to websites and applications that are designed to allow people to share content quickly, efficiently, and in real-time.</p>
            </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                   
                    <div class="form-group">
                         <div class="input-group input-group-default">
                            <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-facebook"></i></label></span>
                            <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $social->facebook ?? '' }}" data-rule-url=”true”>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-default">
                            <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-twitter"></i></label></span>

                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $social->twitter }}" data-rule-url=”true”>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-default">
                            <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-youtube"></i></label></span>
                            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $social->youtube ?? '' }}" data-rule-url=”true”>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-default">
                            <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-instagram ml-1"></i></label></span>

                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $social->instagram ?? '' }}" data-rule-url=”true”>
                        </div> 
                    </div>
                      <div class="form-group">
                        <div class="input-group input-group-default">
                            <span class="input-group-prepend"><label class="input-group-text"><i class="fab fa-linkedin ml-1"></i></label></span>
                            <input type="text" class="form-control" id="linkin" name="linkin" value="{{ $social->linkedin ?? '' }}" data-rule-url=”true”>
                        </div> 
                    </div>

                </div>
            </div>

        </div>
   
    </div>
     <div class="row">
         <div class="col-sm-3">
                <h5 class=""><strong>Personalize</strong></h5>
                <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy.</p>
            </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                   <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Date Format : </label>
                                         @foreach($site_date_format as $dkey => $site_date_format_val)
                                       

                                        <div class="custom-control custom-radio">
                                          <input class="custom-control-input" type="radio" id="{{$dkey}}" {{$setting->site_date_format==$dkey?'checked':''}}  name="site_date_format" value="{{$dkey}}">

                                          <label for="{{$dkey}}" class="custom-control-label" style="font-weight: 500;">{{$site_date_format_val}}</label>
                                        </div>
                                    @endforeach
                                      
                       
                
                                                                         
                                </div>
                                
                                
                            </div>
                         
                       </div>
                       <div class="form-row">
                            <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label >Time Zone : </label>
                                    <select name="timezone" id="timezone" class="form-control">
                                        <option value="">Select a timezone</option>
                                        @foreach (timezone_identifiers_list() as $key=> $timezone)

                                        
                                            <option value="{{ $timezone }}" {{ ($timezone == $setting->time_zone) ? 'selected':'' }}>{{ $timezone }}</option>
                               
                                    
                                        
                                        
                                        @endforeach
                                    </select>
                                   
                                      
                       
                
                                                                         
                                </div>
                                
                            </div>
                         
                       </div>
                        <div class="form-row">
                          
                            
                             <div class="col-md-6">
                         
                                
                                <div class="form-group">
                                  <label >Currency  : </label>
                                 <select name="currency_symbol" id="currency_symbol1" class="form-control">
                                    <option value="">Select a currency</option>
                                    @foreach($currency_list as $key=> $currency)

                                      
                                        <option value="{{ $currency->id }}" {{ ( $currency->id == $setting->currency_symbol) ? 'selected' : '' }}> {{ $currency->country }} ({{ $currency->code }}) : {{ $currency->symbol }}</option>
                                    @endforeach
                                 </select>
                                   
                                      
                       
                
                                                                         
                                </div>

                                  
                                  
                                
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                  <label >Format  : </label>
                                  <select class="form-control " name="currency_format" id="currency_format">
                                        <option value="">Select format a currency</option>
                                        <option value="right" {{ ( $setting->currency_format=='right') ? 'selected' : '' }}>Right (100$)</option>
                                        <option value="right_space" {{ ( $setting->currency_format=='right_space') ? 'selected' : '' }}>Right with space (100 $)</option>
                                        <option value="left" {{ ( $setting->currency_format=='left') ? 'selected' : '' }}>Left ($100)</option>
                                        <option value="left_space" {{ ( $setting->currency_format=='left_space') ? 'selected' : '' }}>Left with space ($ 100)</option>
                                    </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label >Thousand Separator  : </label>
                                  <input type="text" name="thousan_separator" class="form-control" value="{{ $setting->thousan_separator}}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label >Decimal Separator  : </label>
                                <div class="form-group">
                                  <input type="text" name="decimal_separator" class="form-control" value="{{ $setting->decimal_separator}}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label >No of Decimal  : </label>
                                <div class="form-group">
                                  <input type="number" name="no_of_decimal" class="form-control" value="{{ $setting->no_of_decimal}}" data-rule-number=”true” data-msg-maxlength="Please enter a value less than or equal to 4." maxlength="1" min="0" max="4" pattern="\d*">
                            
                               
                                </div>
                              </div>
                         
                       </div>
                   

                </div>
            </div>

        </div>
   
    </div>

   
    <div class="row">
        <div class="col d-flex justify-content-end mb-4">
            <button type="submit" name="save" class="btn btn-success shadow"><span id="sid" role="status" aria-hidden="true"></span> Save </button>
        </div>
      
  

    </div>
</form>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/admin/js/setting/setting.js') }}"></script>
<script src="{{ asset('assets/admin/js/setting/upload-input.js') }}"></script>


@endpush


