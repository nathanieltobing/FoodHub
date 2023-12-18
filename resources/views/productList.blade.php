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

    <div class="covering mt-5" style="padding-top:7rem">
        <div class="cards">
            <div class="imgBx">
                @if(!$vendor->image)
                    <i class="bx bx-user-circle" style="font-size: 10rem;margin-right:10px"></i>
                @endif
                @if ($vendor->image)
                    <img src="{{Storage::url($vendor->image)}}">
                @endif
                {{-- <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt=""> --}}
            </div>
            <div class="content" style="margin-left: -80%;">
                <div class="details">
                    {{-- <h2>{{$vendor->name}} <br><span>{{$vendor->description}}</span></h2> --}}

                    <div class="data">
                        <h2>{{$vendor->name}} <br> <span> {{$vendor->description}}</span> </h2>

                    </div>
                    <div class="actionBtn">
                        {{-- <button style="height: 40px">Message</button> --}}
                        <button style="margin-top: 10px">{{$vendor->phone}}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


   <div class="container mt-5">
        @if (Auth::guard('webcustomer')->check())
            <h1>Product List</h1>
        @elseif(Auth::guard('webvendor')->check())
            <div class="d-flex">
                <h1 style="padding-top :0%" class="align-self-end">Product List</h1>
            <a href="/product/vendor/add" class="submit-button ms-auto" style="width: 20%;background-color:green;text-decoration:none;color:white"id="editProduct">Add Product</a>
            </div>
        @else
            <h1>Product List</h1>
        @endif
        <hr class="bg-dark">
        <form action="/products/search/{{$vendor->id}}" class="row justify-content-start mb-4" role="search">
            <div class="col-md-4">
                <input class="form-control me-2"  name="search" type="search" placeholder="Search" aria-label="Search">
            </div>
        </form>

        <div class="row justify-content-start">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow text-center" style="border-radius: 15px;" >
                        <img src="{{Storage::url($product->product_picture)}}" class="card-img-top" alt="Product Image" style="border-top-left-radius: 15px; border-top-right-radius: 15px; object-fit:cover; height: 12.5rem;">
                        <div class="card-body" style="height: 17.5rem; overflow: hidden;">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-title text-secondary">{{ $product->categories->name }}</h6>
                            <p class="card-text" style="height:5rem; overflow:hidden;" >{{ $product->description }}</p>
                            @if(!$product->promotions)
                                <h6 class="card-text mb-4">Rp{{number_format($product->price,2,",",".")}}</h6>
                            @else
                                <h6 class="card-text" style="margin-top:-0.9rem">Rp{{number_format($product->promotions->discount,2,",",".")}}</h6>
                                <small><p class="card-text mb-2" style="text-decoration: line-through">Rp{{number_format($product->price,2,",",".")}}</p></small>
                            @endif
                            @if (Auth::guard('webcustomer')->check())
                                @if ($error == '-1')
                                    <form action="/products/add/{{$product->id}}" method="POST">
                                        @csrf

                                        <button class="submit-button" style="margin-left:5em;" type="submit" id="error_trigger">Add to Cart</button>
                                    </form>
                                @else
                                    <button class="submit-button" style="margin-left:5em;" class="btnAdd" name="btnAdd" type="submit" id="error_trigger">Add to Cart</button>
                                @endif
                            @elseif(Auth::guard('webvendor')->check())
                                <a href="/product/vendor/edit/{{$product->id}}" class="submit-button" style="margin-left:5em;text-decoration:none;color:white">Edit</a>
                            @else
                                <a href="/login" class="submit-button" style="margin-left:3em;text-decoration:none;color:white;width:70%;margin-top:1.3em">Login to add to cart</a>
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
              @if (Auth::guard('webcustomer')->check())
                <input type="hidden" id="hidden1" name="role" value={{$error}}>
                <div class="popups" id="error">
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

              @endif
              <script src="{{ asset('assets/popup.js') }}"></script>
        </div>
    </div>
@endsection
