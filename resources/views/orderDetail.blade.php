@extends('master')

@section('content')

<section class="h-100 h-custom mt-5" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
            <div class="card-body p-5">
  
              <p class="lead fw-bold mb-5" style="color: #f37a27;">Order Detail</p>
  
              <div class="row d-flex justify-content-start">
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Date</p>
                  <p>{{ \Carbon\Carbon::parse($order->transaction_date)->format('d M Y')}}</p>
                </div>
                <div class="col mb-3 ml-5">
                  <p class="small text-muted mb-1">Order No.</p>
                  <p>ODR-{{$order->id}}</p>
                </div>
              </div>
  
              <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2; margin-right: -3rem;
               margin-left: -3rem;">
                <?php
                    $totalPrice = 0;
                ?>
                @foreach ($orderDetails as $od)
                <?php
                     if($od->discount_price != null){
                        $totalPrice += $od->discount_price * $od->quantity;
                     }
                     else{
                        $totalPrice += $od->price * $od->quantity;
                     }
                 ?>
                    <div class="row">
                    <div class="col-md-6 col-lg-6">
                        {{-- <p>{{$od->product_name}}</p> --}}
                        <p>{{$od->product_name}}</p>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <p>{{$od->quantity}} qty</p>
                    </div>
                    @if ($od->discount_price != null)
                    <div class="col-md-4 col-lg-4">
                      <p>Rp{{number_format($od->discount_price,2,",",".")}}</p>
                  </div>
                    @else
                      <div class="col-md-4 col-lg-4">
                          <p>Rp{{number_format($od->price,2,",",".")}}</p>
                      </div>
                    @endif
                    </div>
                @endforeach
                @if ($order->membership_discount != null)
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                      <p class="mb-0">Membership Discount</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <p class="mb-0">Rp{{number_format((int)($totalPrice * $order->membership_discount),2,",",".")}}</p>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                      <p class="mb-0">Service fee</p>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <p class="mb-0">Rp2.000,00</p>
                    </div>
                </div>
                
              </div>
              
              @if ($order->membership_discount != null)
                <div class="row my-4">
                  <div class="col-md-6 offset-md-8 col-lg-6 offset-lg-9">
                    <p class="lead fw-bold mb-0" style="color: #f37a27;">Rp{{number_format($totalPrice + 2000 - (int)($totalPrice * $order->membership_discount),2,",",".")}}</p>
                  </div>
                </div>
              @else
                <div class="row my-4">
                  <div class="col-md-6 offset-md-8 col-lg-6 offset-lg-9">
                    <p class="lead fw-bold mb-0" style="color: #f37a27;">Rp{{number_format($totalPrice + 2000 ,2,",",".")}}</p>
                  </div>
                </div>              
              @endif
              
  
              <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>
  
              <div class="row">
                <div class="col-lg-12"> 
  
                  <div class="horizontal-timeline">
                    
                    <ul class="list-inline items d-flex justify-content-between">
                        @if ($order->status == 'OPEN')
                        <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Open</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list">
                            <p style="margin-right: -8px;">On Going </p>
                            </p>
                          </li>
                          <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                            <p style="margin-right: -8px;">Finished</p>
                            </p>
                          </li>
                        @elseif($order->status == 'ON GOING')
                        <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Open</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">On Going</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                            <p style="margin-right: -8px;">Finished</p>
                          </li>
                        @elseif($order->status == 'REJECTED')
                          <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Open</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">On Going</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                            <p class="py-1 px-2 rounded text-white" style="margin-right: -8px;background-color: red;">Rejected</p>
                          </li>
                        @elseif($order->status == 'FINISHED')
                        <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Open</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list">
                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">On Going</p
                              class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                          </li>
                          <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                            <p class="py-1 px-2 rounded text-white" style="margin-right: -8px;background-color: green;">Finished</p>
                          </li>
                        @endif
                    </ul>
  
                  </div>
  
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection