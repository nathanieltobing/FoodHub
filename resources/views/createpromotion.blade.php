@extends('master')

@section('content')
<div class="container my-5" style="padding-top: 10rem">
    <h2>Input discount for {{$product->name}}</h2>
    <p>Current price : Rp{{number_format($product->price,2,",",".")}}</p>
    <form method="post" action="/promotion/add/{{$product->id}}">
        @csrf
        <div class="form-group">
            <label for="name">Discount:</label>
            <input type="number" class="form-control" id="discount" name="discount" required>
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Add discount</button>
    </form>
</div>
@endsection
