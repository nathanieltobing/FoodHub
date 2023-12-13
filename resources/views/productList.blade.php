@extends('master')
@section('content')


    <div class="covering" style="margin-top:5%">
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
        <div class="row justify-content-start">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{url('storage/images/user customer 1.jpg')}}" class="card-img-top" alt="Product Image" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Price: ${{ $product->price }}</p>
                            <form action="/products/add/{{$product->id}}" method="post">
                                @csrf
                                <button class="payment-form-submit-button" style="margin-left:5em;" type="submit" >Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products available</p>
            @endforelse
        </div>
    </div>

@endsection
