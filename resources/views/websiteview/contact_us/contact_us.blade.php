@extends('websiteview.layout.app')
@section('title',$title)
@section('site-block')
 <div class="site-blocks-cover inner-page-cover overlay"
      style="background-image: url({{asset('storage/staticpages/banner_image/'.$static_page->banner_image) }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>{{ $static_page->title }}</h1>

              </div>
            </div>


          </div>
        </div>
      </div>
    </div>


@endsection
@section('content')
<div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5"  data-aos="fade">



            <form method="post" action="{{ route('contactus.store') }}" class="p-5 bg-white" style="margin-top: -150px;">
              @csrf

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="name">Full Name *</label>
                  <input type="text" id="name" required name="name" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="mobile">Phone *</label>
                  <input type="text" required name="mobile" id="mobile" class="form-control">
                </div>
              </div>

              <div class="row form-group">

                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">

                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject *</label>
                  <input type="subject" required name="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message *</label>
                  <textarea name="remarks" id="remarks" required="" cols="30" rows="7" class="form-control" ></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                </div>
              </div>


            </form>
          </div>
          <div class="col-md-5"  data-aos="fade" data-aos-delay="100">

            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>

              <p class="mb-4">{{ $setting->store_name ?? '' }}<br>{{ $setting->address_name ?? '' }} <br>
                                        {{ $setting->city->name}} - {{ $setting->pincode ?? ''}}<br>
                                        {{ $setting->state->name}} - {{ $setting->country->name}}</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="tel:{{$setting->address_contact}}">{{ $setting->address_contact ?? ''}}</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="mailto:{{$setting->address_email}}">{{ $setting->address_email ?? ''}}</a></p>

            </div>

            <!-- <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ad iure porro mollitia architecto hic consequuntur. Distinctio nisi perferendis dolore, ipsa consectetur? Fugiat quaerat eos qui, libero neque sed nulla.</p>
              <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Learn More</a></p>
            </div> -->

          </div>
        </div>
      </div>
    </div>


@endsection
