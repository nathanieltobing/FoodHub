@extends('master')

@section('content')
<div class="container my-5" style="padding-top: 7rem">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Register Membership</h3>

            @if (Auth::guard('webcustomer')->check())
            <form action="/customer/registermembership" method="post">
                @csrf
                <p>Your membership will start as you register and ends in {{\Carbon\Carbon::now()->addDays(30)->format('d M Y')}}</p>
                <a href="/customer/profile" class="btn btn-primary">Back to Profile</a>
                <button type="submit" class="btn btn-success">Register now</button>
            </form>
            @elseif (Auth::guard('webvendor')->check())
                <p>Your membership will start as you register and ends in {{\Carbon\Carbon::now()->addDays(30)->format('d M Y')}}</p>
                <p>You must select at least 3 products to be added discount</p>
                <a href="/vendor/profile" class="btn btn-primary">Back to Profile</a>
                @if (!$showProducts)
                    <a href="/registermembership/products" class="btn btn-success">Register now</a>
                @else
                <h3 class="mt-3">Select your discounted products:</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendor->products as $product)
                            <tr>
                                <td><img src="{{url('storage/images/'.$product->product_picture)}}" alt="" style="height: 5rem"></td>
                                <td>{{ $product->name }}</td>
                                <td>Rp{{ $product->price }}</td>
                                @if ($product->promotion_id)
                                    <td>Rp{{$product->promotions->discount}}</td>
                                    @php
                                        $countDiscountedProducts++;
                                    @endphp
                                @else
                                <td><a href="/promotion/create/{{$product->id}}" class="btn btn-primary">Add discount to product</a></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">No products available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @php
                    $vendorHasDiscountedProduct = $countDiscountedProducts >= 3;
                @endphp
                <form action="/vendor/registermembership" class="text-right" method="post">
                @csrf
                    <button type="submit" class="btn btn-success" {{ $vendorHasDiscountedProduct ? '' : 'disabled' }}>Register now</button>
                </form>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
