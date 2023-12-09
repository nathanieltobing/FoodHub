@extends('master')


@section('content')
<div >


        <div class="inner" style="margin-top: 100px;text-align: center;">
            <h2>Promotion</h2>
            <div class="border"></div>
        </div>
<div  class="slider" style="margin-top: 30px">
    <div class="list">
        <div class="item">
            <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
        </div>
        <div class="item">
            <img src="https://images.unsplash.com/photo-1656077217715-bdaeb06bd01f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
        </div>
        <div class="item">
            <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
        </div>
        <div class="item">
            <img src="https://images.unsplash.com/photo-1656077217715-bdaeb06bd01f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
        </div>
        <div class="item">
            <img src="https://images.unsplash.com/photo-1656077217715-bdaeb06bd01f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
        </div>
    </div>
    <div class="buttons">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    <ul class="dots">
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    </div>

</div>
<script src="{{ asset('assets/script.js') }}"></script>
{{-- <div class="cover">


    <div class="container">
     <div class="inner">
        <h2 style="margin-left:43%">Promotion</h2>
        <div class="border"></div>
     </div>
         <div class="slider-wrapper">
            <div class="slider">
            <img id="slide-1" src="storage/images/foodbanner1.jpg" alt="3D rendering of an imaginary orange planet in space" />
            <img id="slide-2" src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="3D rendering of an imaginary green planet in space" />
            <img id="slide-3" src="https://images.unsplash.com/photo-1656077217715-bdaeb06bd01f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="3D rendering of an imaginary blue planet in space" />
            </div>
          <div class="slider-nav">
            <a href="#slide-1"></a>
            <a href="#slide-2"></a>
            <a href="#slide-3"></a>
          </div>
     </div>
    </div>
</div> --}}

<div class="about-us">
    <div class="about-section">
        <div class="inner-container">
         <h1>ABOUT US</h1>
            <p class="text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium minus eum beatae veniam odio ducimus quo iste sint adipisci libero similique consequuntur natus, minima suscipit, quisquam amet? Est, temporibus quae!

           </p>
          <div class="skills">
            <span> Food Management</span>
            <span> Service & Quality</span>
            <span> Vendors & Deliveries</span>
         </div>
        </div>

    </div>
</div>

<div class="testimonials">
    <div class="inner">
      <h2>Best Vendors</h2>
      <div class="border"></div>

      <div class="row">
        <div class="col">
          <div class="testimonial">
            <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
            <div class="name">Tobing Catering</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>


          </div>
        </div>

        <div class="col">
          <div class="testimonial">
            <img src="storage/images/foodbanner1.jpg" alt="">
            <div class="name">Tobing Catering</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
            </div>


          </div>
        </div>

        <div class="col">
          <div class="testimonial">
            <img src="storage/images/foodbanner1.jpg" alt="">
            <div class="name">Steven Catering</div>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</body>

@endsection
