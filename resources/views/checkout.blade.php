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
                    @if (!empty($carts) || $carts != null)
                        @foreach ($carts as $cart)
                        <?php
                            $totalPrice += $cart['price'] * $cart['quantity'];
                        ?>
                        <tr>
                            <td>
                                <form action="/checkout/{{$cart['product_id']}}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" style="border:0; background:none;"><i class="fas fa-trash alt"></i></button>
                                </form>
                            </td>
                            
                            <td ><img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt=""></td>
                        <td>
                            <div class="payment-summary-price">{{$cart['name']}}</div>
                            {{-- <p  class="payment-plan-info-price" style="font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol"> Paket 1 makanan</p> --}}
                        </td>
                            <td >
                                <div class="payment-summary-price">{{$cart['price']}}</div>
                            </td>          
                                <td>
                                    <p class="w-25 pl-1">3</p>
                                    {{-- <input class="w-25 pl-1" value="{{$cart['quantity']}}" id="quantity" name="quantity" type="number"> --}}
                                    <button type="submit" style="border:0; background:none;"><i class="fas fa-plus"></i></button>
                                </td>    
                                                       
                            <td> <div class="payment-summary-price">{{$cart['price'] * $cart['quantity']}}</div></td>
                            {{-- <td> <div class="payment-summary-price">{{Request::input('quantity')}}</div></td> --}}
                           <?php
                                
                           ?>
                        </tr>                      
                        @endforeach
                    @else
                        <p>Your cart is empty</p>
                        
                    @endif
                   
                    {{-- <tr>
                        <td><a href=""><i class="fas fa-trash alt"></i></a> </td>
                        <td ><img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt=""></td>
                      <td>
                        <div class="payment-summary-price">Paket 1 makanan</div>
                      </td>
                        <td>
                            <div class="payment-summary-price">$65</div>
                        </td>
                        <td><input class="w-25 pl-1" value="1" type="number"></td>
                        <td > <div class="payment-summary-price">$130</div></td>
                    </tr>

                    <tr>
                        <td><a href=""><i class="fas fa-trash alt"></i></a> </td>
                        <td ><img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt=""></td>
                      <td>
                        <div class="payment-summary-price">Paket 1 makanan</div>
                      </td>
                        <td>
                            <div class="payment-summary-price">$65</div>
                        </td>
                        <td><input class="w-25 pl-1" value="1" type="number"></td>
                        <td> <div class="payment-summary-price">$65</div></td>
                    </tr> --}}
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
                    {{-- <p class="payment-header-description">This is the order</p> --}}
                </div>
                <div class="payment-content">
                    <div class="payment-body">
                        <div class="payment-plan">
                            {{-- <div class="payment-plan-type">Order</div> --}}
                            <div class="payment-plan-info">
                                 @if ($customerMembership != null && $customerMembership['status'] =='ACTIVE')
                                    <div class="payment-plan-info-name">Professional Membership</div>
                                 @else
                                    <div class="payment-plan-info-name">Regular Customer</div>
                                 @endif                           

                            </div>
                            {{-- <a href="#" class="payment-plan-change">Change</a> --}}
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
            {{-- <div class="row">

                    <div class="coupon col-lg-6 col-md-6 col-12 mb-4">
                        <div>
                            <h5>COUPON</h5>
                            <p>Enter your Coupon code if you have one</p>
                            <input type="text" placeholder="Coupon Code">
                            <button>APPLY COUPON</button>
                        </div>
                    </div>
                <div class="total col-lg-6 col-md-6 col-12 mb-4">
                    <div>
                        <h5>CART TOTAL</h5>
                        <div class="d-flex justify-content-between">
                            <h6>Subtotal</h6>
                            <p>$215.00</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Subtotal</h6>
                            <p>$215.00</p>
                        </div>
                        <hr class="second-hr">
                        <div class="d-flex justify-content-between">
                            <h6>Subtotal</h6>
                            <p>$215.00</p>
                        </div>
                        <button>PROCEED TO CHECKOUT</button>
                    </div>
                </div>


            </div> --}}


        </div>
        <section class="payment-section">
            <div class="container">
                {{-- <div class="payment-wrapper">
                    <div class="payment-left">
                        <div class="payment-header">
                            <div class="payment-header-icon"><i class="ri-flashlight-fill"></i></div>
                            <div class="payment-header-title">Order Summary</div>
                            <p class="payment-header-description">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        </div>
                        <div class="payment-content">
                            <div class="payment-body">
                                <div class="payment-plan">
                                    <div class="payment-plan-type">Pro</div>
                                    <div class="payment-plan-info">
                                        <div class="payment-plan-info-name">Professional Plan</div>
                                        <div class="payment-plan-info-price">$49 per month</div>
                                    </div>
                                    <a href="#" class="payment-plan-change">Change</a>
                                </div>
                                <div class="payment-summary">
                                    <div class="payment-summary-item">
                                        <div class="payment-summary-name">Additional fee</div>
                                        <div class="payment-summary-price">$10</div>
                                    </div>
                                    <div class="payment-summary-item">
                                        <div class="payment-summary-name">Discount 20%</div>
                                        <div class="payment-summary-price">-$10</div>
                                    </div>
                                    <div class="payment-summary-divider"></div>
                                    <div class="payment-summary-item payment-summary-total">
                                        <div class="payment-summary-name">Total</div>
                                        <div class="payment-summary-price">-$10</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="payment-right">
                        <form action="/checkout" class="payment-form" method="POST">
                            @csrf
                            <h1 class="payment-title">Payment Details</h1>
                            <div class="payment-method">
                                <input type="radio" name="payment-method" id="method-1" checked>
                                <label for="method-1" class="payment-method-item">
                                    <img src="images/visa.png" alt="">
                                </label>
                                <input type="radio" name="payment-method" id="method-2">
                                <label for="method-2" class="payment-method-item">
                                    <img src="images/mastercard.png" alt="">
                                </label>
                                <input type="radio" name="payment-method" id="method-3">
                                <label for="method-3" class="payment-method-item">
                                    <img src="images/paypal.png" alt="">
                                </label>
                                <input type="radio" name="payment-method" id="method-4">
                                <label for="method-4" class="payment-method-item">
                                    <img src="images/stripe.png" alt="">
                                </label>
                            </div>
                            <div class="payment-form-group">
                                <input type="email" placeholder=" " class="payment-form-control" id="email">
                                <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                            </div>
                            <div class="payment-form-group">
                                <input type="text" placeholder=" " class="payment-form-control" id="card-number">
                                <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                            </div>
                            <div class="payment-form-group-flex">
                                <div class="payment-form-group">
                                    <input type="date" placeholder=" " class="payment-form-control" id="expiry-date">
                                    <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                                </div>
                                <div class="payment-form-group">
                                    <input type="text" placeholder=" " class="payment-form-control" id="cvv">
                                    <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                                </div>
                            </div>
                            <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>


@endsection
