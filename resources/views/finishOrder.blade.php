@extends('master')

@section('content')
<div class="container">

    <h2 class="mt-4 mb-4">Rating and Review</h2>
    <div class="d-flex align-items-center">
        <img class="img-thumbnail ms-2 me-3" src="{{url('storage/images/book1.jpg')}}" alt="" style="width:100px">
        <div>
            <h3 class="">Order #{{$order->id}}</h3>
            <h5 class="card-text mx-1">{{$order->vendors->name}}</h5>
            <ul class="list-unstyled">
                @foreach ($order->order_details as $od)
                    <li class="card-text">- {{ $od->product_name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <form method="post" action="/addreview/{{$order->id}}">
        @csrf
        <div class="form-group mt-3">
            <label for="rating">Rating:</label>
            <select class="form-control" id="rating" name="rating">
                <option value="" disabled selected>Select a rating</option>
                <option value="5">5 stars</option>
                <option value="4">4 stars</option>
                <option value="3">3 stars</option>
                <option value="2">2 stars</option>
                <option value="1">1 star</option>
            </select>
        </div>

        <div class="form-group">
            <label for="review">Review:</label>
            <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection
