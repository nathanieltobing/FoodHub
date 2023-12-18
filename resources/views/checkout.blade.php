@extends('master')

@section('content')
<link href="{{ asset('assets/style.css') }}" rel="stylesheet">
<div class="container-fluid" style="padding : 0">
    <div class ="row w-100" style="padding : 0">
      <div class="col d-flex justify-content-center w-100">
         {{-- <h1 style="color: white"><b>Book List</b></h2>   --}}
            <p style="font-size: 30px; line-height :1.66; font-weight: 500; font-family: Poppins; margin-top:100px;">CHECKOUT</p>
      </div>
    </div>
    <div class ="row w-100">
        <div class="col-8 d-flex">
           {{-- <h1 style="color: white"><b>Book List</b></h2>   --}}
              <p style="font-size: 30px; line-height :1.66; font-weight: 500; font-family: Poppins; margin-bottom : 0;">ITEMS</p>
        </div>
        <div class="line"></div>
    </div>


</div>
    @if (!empty($carts) || $carts != null)
    <div id="cart-container" class="container my-5">
        <table width= "120%" style="font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>

            <?php
                $totalPrice = 0;
            ?>
            <tbody>
                    @foreach ($carts as $cart)
                    <?php
                    if($cart['discounted_price'] != null){
                        $totalPrice += $cart['discounted_price'] * $cart['quantity'];
                    }
                    else{
                        $totalPrice += $cart['price'] * $cart['quantity'];
                    }
                    ?>
                    <tr>
                        <td>
                            <form action="/checkout/{{$cart['product_id']}}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" style="border:0; background:none;"><i class="fas fa-trash alt"></i></button>
                            </form>
                        </td>

                        <td ><img src="{{Storage::url($cart['image'])}}" alt="" style="margin-top:4px;margin-bottom:4px"></td>

                    <td>
                        <div class="payment-summary-price">{{$cart['name']}}</div>
                        {{-- <p  class="payment-plan-info-price" style="font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol"> Paket 1 makanan</p> --}}
                    </td>
                        <td >
                            @if ($cart['discounted_price'] != null)                                                  
                              <div class="payment-summary-price">Rp{{number_format($cart['discounted_price'],2,",",".")}}</div>                        
                            @else                                                        
                              <div class="payment-summary-price">Rp{{number_format($cart['price'],2,",",".")}}</div>                            
                            @endif                          
                        </td>
                        <td>
                            <div class="wrappers">
                                <form action="/minQuantity/{{$cart['product_id']}}" method="POST">
                                    @csrf
                                    <button type="submit" style="border:0; background:none;margin-left:10px"><span style="margin-right: 10px" class="minus">- </span></i></button>
                                </form>
                                <span style="margin-left: 10px" class="num">{{$cart['quantity']}} </span>
                                <form action="/addQuantity/{{$cart['product_id']}}" method="POST">
                                    @csrf
                                    <button type="submit" style="border:0; background:none;margin-right:10px"><span style="margin-left: 10px" class="plus">+ </span></i></button>
                                </form>

                            </div>
                        </td>
                        @if ($cart['discounted_price'] != null)
                            <td> <div class="payment-summary-price">Rp{{number_format($cart['discounted_price'] * $cart['quantity'],2,",",".")}}</div></td>
                        @else
                            <td> <div class="payment-summary-price">Rp{{number_format($cart['price'] * $cart['quantity'],2,",",".")}}</div></td>  
                        @endif       
                
                       <?php

                       ?>
                    </tr>
                    @endforeach


            </tbody>
        </table>
    </div>
    <?php
        $customerMembership = Auth::guard('webcustomer')->user()->customer_membership;
        if($customerMembership != null){
            $customerMembership = json_decode($customerMembership, true);
        }
    ?>

    <div id="cart-bottom" class="container">
        <div class="payment-left">
            <div class="payment-header">
                <div class="payment-header-icon"><i class="ri-flashlight-fill"></i></div>
                <div class="payment-header-title">Order Summary</div>

            </div>
            <div class="payment-content">
                <div class="payment-body">
                    <div class="payment-plan">

                        <div class="payment-plan-info">
                             @if ($customerMembership != null && $customerMembership['status'] =='ACTIVE')
                                <div class="payment-plan-info-name">Professional Membership</div>
                             @else
                                <div class="payment-plan-info-name">Regular Customer</div>
                             @endif

                        </div>

                    </div>
                    <div class="payment-summary">
                        <div class="payment-summary-item">
                            <div class="payment-summary-name">Subtotal</div>
                            <div class="payment-summary-price">Rp{{number_format($totalPrice,2,",",".")}}</div>
                        </div>
                        <div class="payment-summary-item">
                            <div class="payment-summary-name">Service Fee</div>
                            <div class="payment-summary-price">Rp2.000,00</div>

                        </div>
                        @if ($customerMembership != null && $customerMembership['status'] == 'ACTIVE')
                            <div class="payment-summary-item">
                                <div class="payment-summary-name">Membership Discount</div>
                                <div class="payment-summary-price">-Rp{{number_format((int)($totalPrice * $customerMembership['discount'] / 100),2,",",".")}}</div>
                        </div>

                        @endif
                        <div class="payment-summary-divider"></div>
                        <div class="payment-summary-item payment-summary-total">
                            <div class="payment-summary-name">Total</div>
                            @if ($customerMembership != null)
                                <div class="payment-summary-price">Rp{{number_format($totalPrice + 2000 - (int)($totalPrice * $customerMembership['discount'] / 100),2,",",".")}}</div>
                            @else
                                <div class="payment-summary-price">Rp{{number_format($totalPrice + 2000 ,2,",",".")}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <section class="payment-section">
        <div class="container">
                <div class="payment-right">
                    <form action="/checkout" class="payment-form" method="POST">
                        @csrf
                        <h1 class="payment-title">Payment Details</h1>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="method-1" checked>
                            <label for="method-1" class="payment-method-item">
                                <img src="{{ asset('assets/images/visa.png') }}" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-2">
                            <label for="method-2" class="payment-method-item">
                                <img src="{{ asset('assets/images/mastercard.png') }}" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-3">
                            <label for="method-3" class="payment-method-item">
                                <img src="{{ asset('assets/images/bca.jpg') }}" alt="">
                            </label>
                            <input type="radio" name="payment-method" id="method-4">
                            <label for="method-4" class="payment-method-item">
                                <img src="{{ asset('assets/images/bri.png') }}" alt="">
                            </label>
                        </div>
                        <div class="payment-form-group">
                            <input type="email" placeholder=" " class="payment-form-control" name="email">
                            <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" placeholder=" " maxlength="16" class="payment-form-control" name="cardNumber">
                            <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                        </div>
                        <div class="payment-form-group-flex">
                            <div class="payment-form-group">
                                <input type="date" placeholder=" " class="payment-form-control" name="expiryDate">
                                <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                            </div>
                            <div class="payment-form-group">
                                <input type="text" placeholder=" " maxlength="3" class="payment-form-control" name="cvv">
                                <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                            </div>
                        </div>
                        <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pay</button>
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
                    </form>
                </div>
            </div>

    @else
       <p class ="d-flex justify-content-center" style="font-size :45px;" >Your cart is empty<i class="fa-regular fa-face-frown" style="margin-left:1%; margin-top:14px;"></i></p>

    @endif

  </div>
</section>


@endsection
