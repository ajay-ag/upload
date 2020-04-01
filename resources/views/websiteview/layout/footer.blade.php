<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Help Support</h2>
                <ul class="list-unstyled">
                  <li><a href="{{url('terms-and-conditions')}}">Terms & Conditions</a></li>
                  <li><a href="{{url('privancy-policy')}}">Privacy Policy</a></li>
                </ul>
              </div>
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Our Company</h2>
                <ul class="list-unstyled">
                  <li><a href="{{ url('/') }}">Home</a></li>
                  <li><a href="{{ url('/category') }}">Categories</a></li>
                  <li><a href="{{ url('/about') }}">About Us</a></li>
                  <li><a href="{{ url('/contactus') }}">Contact Us</a></li>
                </ul>
              </div>
             
              <div class="col-md-6 mb-5 mb-lg-0 col-lg-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <div class="d-flex">
                  @if($social->facebook !='')
                  <a href="{{ $social->facebook }}" target="_blank" class="px-1 "><span class="icon-facebook"></span></a>
                  @endif
                  @if($social->twitter !='')
                  <a href="{{ $social->twitter }}" class=" px-1" target="_blank"><span class="icon-twitter"></span></a>
                  @endif
                  @if($social->instagram !='')
                  <a href="{{ $social->instagram }}" target="_blank" class=" px-1"><span class="icon-instagram"></span></a>
                  @endif
                  @if($social->linkedin !='')
                  <a href="{{ $social->linkedin }}" target="_blank" class=" px-1"><span class="icon-linkedin"></span></a>
                  @endif
                  @if($social->youtube !='')
                  <a href="{{ $social->youtube }}" target="_blank" class="px-1 "><span class="icon-youtube"></span></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <h2 class="footer-heading mb-4">Newsletter</h2>
           

            <form action="{{ route('newsletter.store') }}" method="post">
              @csrf
              <div class="input-group mb-3">
                <input required="" name="email" type="email" class="form-control bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="submit" id="button-addon2">Submit</button>
                </div>
              </div>
            </form>

          </div>
        </div>
        <div class="row pt-3 mt-3">
          <div class="col-6 text-md-center text-left" style="text-align: left !important;">
            <p>
              <!-- Link back to Free-Template.co can't be removed. Template is licensed under CC BY 3.0. -->
          &copy; {{ date('Y') }} MNS Technoweb Pvt. Ltd. All rights reserved.
          </p>
          </div>
          <div class="col-6 text-md-center text-right" style="text-align: right !important;">
            <p>
              <!-- Link back to Free-Template.co can't be removed. Template is licensed under CC BY 3.0. -->
              Developed by <a href="//www.mnstechnologies.com/" target="_blank" class="" rel="nofollow" rel="nofollow">MNS Technologies</a>
          </p>
          </div>
        </div>
      </div>
    </footer>