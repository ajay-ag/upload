 <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Popular Categories</h2>
            <p class="color-black-opacity-5">Start Exploring With Our.</p>
          </div>
        </div>

        @php
            $category=collect($category)->where('post_cat_count_count','<>',0)->all()
        @endphp
        @foreach(collect($category)->chunk(6); as $cat_key =>$item_categorys)
        <div class="row align-items-stretch">
          @foreach(collect($item_categorys) as $cat_key =>$item_category)
          <div class="col-6 col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
            <a href="javascript:void(0);" class="popular-category h-100" onclick="location.href='{{route('advertise')}}/category/{{$item_category->slug}}'">
              <span class="icon mb-3"><span class="{{ $item_category->icon_name }}"></span></span>
              <span class="caption mb-2 d-block">{{$item_category->name}}</span>
              <span class="number">{{$item_category->post_cat_count_count}} </span>
            </a>
          </div>

          @endforeach

        </div>
        <br>
        @endforeach
        @if($category)
         <div class="row mt-5 justify-content-center tex-center">
          <div class="col-md-4"><a href="{{ url('category') }}" class="btn btn-block btn-outline-primary btn-md px-5">View All Categories</a></div>
        </div>
        @endif
      </div>
    </div>