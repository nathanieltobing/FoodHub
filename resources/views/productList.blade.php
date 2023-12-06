@extends('master')
@section('content')
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
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
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
