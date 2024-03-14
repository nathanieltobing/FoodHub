@extends('master')


@section('content')
<div class="pt-5" >
        <div class="inner pt-5" style="text-align: center; margin-top:4rem;">
            <h2 class="h2-text">Promotion</h2>
            <div class="border"></div>
        </div>
<div  class="slider" style="margin-top: 30px">
    <div class="list">
      @foreach ($featuredVendors as $vendor)
        <div class="item">
          <a href="/products/{{$vendor->id}}"><img class="slide" src="/storage/{{$vendor->image}}" alt=""></a>
        </div>
      @endforeach
    </div>
    <div class="buttons">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    <ul class="dots">
        <li class="active"></li>
        @for ($i = 1; $i < $featuredVendors->count(); $i++)
          <li></li>
        @endfor
    </ul>
    </div>

</div>
<script src="{{ asset('assets/script.js') }}"></script>

<div class="about-us">
    <div class="about-section">
        <div class="inner-container">
         <h1>ABOUT US</h1>
            <p class="text">
                At Foodhub, we pride ourselves as a bridge connecting vendors and customers. We serve as the trusted middleman, ensuring a harmonious connection between exceptional vendors and discerning customers
           </p>
          <div class="skills">
            <span> Food Management</span>
            <span> Service & Quality</span>
            <span> Vendors & Deliveries</span>
         </div>
        </div>

    </div>
</div>






<div class="d-flex justify-content-center" style="gap:20px">
    <div class="testimonials" style="width: 888px;border: 1px solid #BDBFC9">
        <div class="inner">
          <h2>Top Product</h2>
          <div class="border"></div>
          <div class="row">
            <div class="col">
              <div class="testimonial">
                <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
                <div class="name">Tobing Catering</div>
              </div>
            </div>

          </div>
        </div>
      </div>


    <div class="testimonials" style="width: 888px;border: 1px solid #BDBFC9">
        <div class="inner">
          <h2>Top Vendor</h2>
          <div class="border"></div>
          <div class="row">
            <div class="col">
              <div class="testimonial">
                <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
                <div class="name"> Tobing Catering</div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>





<div class="testimonials">
    <div class="inner">
      <h2 class="h2-text">Best Vendors</h2>
      <div class="border"></div>

      <div class="row">
        @foreach ($topRatedVendors as $vendor)
          <div class="col">
            <div class="testimonial">
              <a href="/products/{{$vendor->id}}"><img src="/storage/{{$vendor->image}}" alt=""></a>
              <div class="name">{{$vendor->name}}</div>
              <div class="stars">
                @for ($i = 0; $i < $vendor->rating ; $i++)
                  <i class="fas fa-star"></i>
               @endfor
              </div>


            </div>
          </div>

        @endforeach

      </div>
    </div>
  </div>
</div>


</body>

@endsection
