  
   <div class="site-blocks-cover overlay" style="background-image: url({{ $sliders->slider_imge }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10">
            
            
            <div class="row justify-content-center mb-4">
              <div class="col-md-10 text-center">
                <h1 data-aos="fade-up">{{ $sliders->title ?? '' }}<span class="typed-words"></span></h1>
              
              </div>
            </div>

            <div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
              <form method="get" action="{{route('advertise')}}">
                <div class="row align-items-center">
                  <div class="col-lg-12 col-xl-5 no-sm-border border-right">
                    <input type="text" class="form-control" placeholder="What are you looking for?" name="title" id="title">
                  </div>
                 
                  <div class="col-lg-12 col-xl-5">
                    <div class="select-wrap">
                      <span class="icon"><span class=""></span></span>
                      <select class="form-control city"  name="city" id="city">
                        <option value="">Select City</option>
                       
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12 col-xl-2 ml-auto text-right">
                    <input type="submit" class="btn text-white btn-primary" value="Search">
                  </div>
                  
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div> 
