@extends('master')
@section('content')

{{-- <div class="toast">
    <div class="toast-content">
        <i class="fas fa-solid fa-check check"></i>
        <div class="message">
            <span class="text text-1">Success</span>
            <span class="text text-2">Your changes has been saved</span>
        </div>
    </div>
    <i class="fa-solid fa-xmark close"></i>
    <div class="progress"></div>
</div> --}}

    <div class="covering" style="margin-top:7%">
        <div class="cards">
            <div class="imgBx">
                <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
            </div>
            <div class="content" style="margin-left: -80%;">
                <div class="details">
                    <h2>Tobing Catering <br><span> Catering for bla ba</span></h2>
                    <div class="data">
                        <h3>342 <br> <span> Review</span> </h3>
                        <h3>2K <br> <span> Order</span> </h3>
                        <h3>3K <br> <span> Posts</span> </h3>
                    </div>
                    <div class="actionBtn">
                        <button>Follow </button>
                        <button>Message</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


   <div class="container mt-5">
        <h1>Product List</h1>
        <hr class="bg-dark">
        <form action="/products/search/{{$vendor->id}}" class="row justify-content-start mb-4" role="search">
            <div class="col-md-4">
                <input class="form-control me-2"  name="search" type="search" placeholder="Search" aria-label="Search">
            </div>
        </form>

        <div class="row justify-content-start">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{Storage::url($product->product_picture)}}" class="card-img-top" alt="Product Image" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Price: ${{ $product->price }}</p>
                            @if ($error == '-1')
                                <form action="/products/add/{{$product->id}}" method="POST">
                                    @csrf

                                    <button class="submit-button" style="margin-left:5em;" type="submit" id="error_trigger">Add to Cart</button>
                                </form>
                            @else
                                <button class="submit-button" style="margin-left:5em;" class="btnAdd" name="btnAdd" type="submit" id="error_trigger">Add to Cart</button> 
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <p>No products available</p>
            @endforelse
            <div class = "d-flex justify-content-center mt-4">
                {{$products->links()}}
              </div>  
            <input type="hidden" id="hidden1" name="role" value={{$error}}>
            <div class="popups" id="error" style="width: 50%">
                <div class="popup-content">
                  <div class="imgbox">
                    <img src="{{ asset('assets/images/cancel.png') }}" alt="" class="img">
                  </div>
                  <p class="para">YOU CAN'T ADD PRODUCTS FROM TWO DIFFERENT VENDORS</p>
                  <form action="">
                    <a href="#" class="buttons" id="e_button">EXIT</a>
                  </form>
                </div>
              </div>
              <script src="{{ asset('assets/popup.js') }}"></script>
        </div>
    </div>

    {{-- <div class="popups" id="popup-1">
        <div class="overlay"></div>
        <div class="content-popup">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Title</h1>
            <p> You can't add products from 2 different vendors</p>
        </div>


    </div>
    <button onclick="togglePopup()" class="submit-button" style="margin-left:5em;" type="submit" >Add to Cart</button>

    <script src="{{ asset('assets/popup.js') }}"></script> --}}
@endsection
