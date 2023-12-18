@extends('master')

@section('content')
<div class="container my-5" style="padding-top: 7rem">
    <div class="card">
        <div class="card-body">
            <a href="{{url()->previous()}}"> <i class="fa-solid fa-arrow-left fa-xl me-3 fa-fw" style="margin-left:1030px"></i></a>
            <h3 class="card-title">Register Membership</h3>
            <p>Your membership will start as you register and ends in {{\Carbon\Carbon::now()->addDays(30)->format('d M Y')}}</p>
            <p>You will be charged <strong>Rp50.000,-</strong> per month</p>
            @if (Auth::guard('webvendor')->check())
            @php
                $countDiscountedProducts = 0;
            @endphp
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
                                <td><img src="{{Storage::url($product->product_picture)}}" alt="" style="height: 5rem"></td>
                                <td>{{ $product->name }}</td>
                                <td>Rp{{number_format($product->price,2,",",".")}}</td>
                                @if ($product->promotion_id)
                                    <td>Rp{{number_format($product->promotions->discount,2,",",".")}}</td>
                                    @php
                                        $countDiscountedProducts++;
                                    @endphp
                                @else
                                <td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#AddDiscount{{$product->id}}">Add discount to product</a></td>
                                @endif
                            </tr>
                            <div class="modal fade" id="AddDiscount{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="AddDiscount{{$product->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelMembershipModalLabel">Input discount for {{$product->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <p>Current price : Rp{{number_format($product->price,2,",",".")}}</p>
                                                <form method="post" action="/promotion/add/{{$product->id}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="name">Discount:</label>
                                                        <input type="number" class="form-control" id="discount" name="discount" placeholder="" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add discount</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            @endif
        </div>
        <div class="container pb-3">
            <div class="payment-right">
                <form action="{{ Auth::guard('webvendor')->check() ? '/vendor/registermembership' : '/customer/registermembership' }}" method="post">
                @csrf
                <h1 class="payment-title">Payment Details</h1>
                <div class="payment-method">
                    <input type="radio" name="payment-method" id="method-1" checked>
                    <label for="method-1" class="payment-method-item">
                        <img src="{{asset('assets/images/visa.png')}}" alt="">
                    </label>
                    <input type="radio" name="payment-method" id="method-2">
                    <label for="method-2" class="payment-method-item">
                        <img src="{{asset('assets/images/mastercard.png')}}" alt="">
                    </label>
                    <input type="radio" name="payment-method" id="method-3">
                    <label for="method-3" class="payment-method-item">
                        <img src="{{asset('assets/images/bca.jpg')}}" alt="">
                    </label>
                    <input type="radio" name="payment-method" id="method-4">
                    <label for="method-4" class="payment-method-item">
                        <img src="{{asset('assets/images/bri.png')}}" alt="">
                    </label>
                </div>
                <div class="payment-form-group">
                    <input type="email" placeholder=" " class="payment-form-control" id="email" name="email">
                    <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                </div>
                <div class="payment-form-group">
                    <input type="text" placeholder=" " class="payment-form-control" maxlength="16" id="cardNumber" name="cardNumber">
                    <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                </div>
                <div class="payment-form-group-flex">
                    <div class="payment-form-group">
                        <input type="date" placeholder=" " class="payment-form-control" id="expiryDate" name="expiryDate">
                        <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                    </div>
                    <div class="payment-form-group">
                        <input type="text" placeholder=" " class="payment-form-control" maxlength="3" id="cvv" name="cvv">
                        <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                    </div>
                </div>
                @if (Auth::guard('webcustomer')->check())
                        <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i>Confirm Payment</button>
                @elseif (Auth::guard('webvendor')->check())<button type="submit" class="payment-form-submit-button btn btn-success" {{ $vendorHasDiscountedProduct ? '' : 'disabled' }}>Confirm Payment</button>
                        <p class="text-center text-danger mt-3">You must select at least 3 products to be added to promotion</p>
                @endif
                </form>
                <div class="row text-danger">
                    @if(session()->has('error'))
                            <p>{{ session()->get('error') }}</p>
                        @endif
                        @if ($errors->any())
                        <ul class="ps-5">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                </div>
        </div>
        </div>
    </div>
</div>
@endsection
