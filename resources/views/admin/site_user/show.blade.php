@extends('admin.layout.app')
@section('title',@$title)

@section('wrapper')
@component('component.heading' , [
    'page_title' => 'User Detail',
    'back' =>  route('admin.site-user.index'),
    'text' => 'Back',
])
@endcomponent
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>User Personal Detail</strong></h6>
                    <hr>
                    <div class="form-group">
                        <label for="category_id"><b>Name:</b></label>
                        {{$user->name ? $user->name:'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>Email:</b></label>
                        {{$user->email ? $user->email:'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>Mobile:</b></label>
                        {{$user->mobile}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>WhatsApp No:</b></label>
                        {{$user->personal_whatapp_mobile ? $user->personal_whatapp_mobile:'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>Address:</b></label>
                        {{$user->personal_address ? $user->personal_address : 'N/A' }}
                    </div>
                    <div class="form-group">
                        <label for="category_id"><b>Country:</b></label>
                        @if(isset($user->per_country->name))
                            {{$user->per_country->name ?? ''}}
                        @else
                            {{'N/A'}}
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="category_id"><b>State:</b></label>
                        @if(isset($user->per_state->name))
                            {{$user->per_state->name ?? ''}}
                        @else
                            {{'N/A'}}
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>City:</b></label>
                        @if(isset($user->per_city->name))
                            {{$user->per_city->name }}
                        @else
                            {{'N/A'}}
                        @endif

                    </div>


                </div>
            </div>

        </div>
       {{-- <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-mute"><strong>User Business Detail</strong></h6>
                    <hr>
                    <div class="form-group">
                        <label for="category_id"><b> Name:</b></label>
                        {{$user->business_name ? $user->business_name :'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>Email:</b></label>
                        {{$user->business_email ? $user->business_email:'N/A'}}
                    </div>
                    <div class="form-group">
                        <label for="category_id"><b>GST No:</b></label>
                        {{$user->business_gst ? $user->business_gst :'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>PAN No:</b></label>
                        {{$user->business_pan ? $user->business_pan :'N/A'}}
                    </div>
                    <div class="form-group">
                        <label for="category_id"><b>Mobile:</b></label>
                        {{$user->business_mobile ? $user->business_mobile:'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>WhatsApp No:</b></label>
                        {{$user->business_whatapp_mobile ? $user->business_whatapp_mobile:'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>Website Url:</b></label>
                        {{$user->business_site_url ? $user->business_site_url:'N/A'}}
                    </div>
                    <div class="form-group">
                        <label for="category_id"><b>Address:</b></label>
                        {{$user->business_address ? $user->business_address : 'N/A'}}
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>State:</b></label>
                        @if(isset($user->bus_state->name))
                            {{$user->bus_state->name}}
                        @else
                            {{'N/A'}}
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="category_id"><b>City:</b></label>
                        @if(isset($user->bus_city->name))
                            {{$user->bus_city->name ??  ''}}
                        @else
                            {{'N/A'}}
                        @endif
                    </div>


                </div>
            </div>

        </div>--}}

    </div>
</div>
@endsection




