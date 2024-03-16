@extends('master')

@section('content')


<section class="h-100 h-custom mt-5" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div  class="col-lg-8 col-xl-6">
                <div class="card border-top border-bottom border-3 fontstyle" style="border-color: #f37a27 !important;">
                    <div  class="card-body p-5">
                        <a href="{{url()->previous()}}"> <i class="fa-solid fa-arrow-left fa-xl me-3 fa-fw" style="margin-left:430px; margin-bottom:5%"></i></a>
                        <p class="lead fw-bold mb-5 fontstyle" style="color: #f37a27">Payment Proof</p>

                        <div class="row d-flex justify-content-start">
                          <div class="col-4 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Date</p>
                            <p class="fontstyle">{{\Carbon\Carbon::parse($order->due_date)->format('d M Y')}}</p>
                          </div>
                          <div class="col-5 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Vendor</p>
                            <p class="fontstyle">{{$vendor->name}}</p>
                          </div>
                          <div class="col-3 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Order No.</p>
                            <p class="fontstyle">ODR-{{$order->id}}</p>
                          </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                          <div class="col-6 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Address</p>
                            <p class="fontstyle">{{$order->address}}</p>
                          </div>
                          <div class="col-6 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Total</p>
                            @if ($order->nego_price)
                                <p class="fontstyle">Rp{{number_format($order->nego_price,2,",",".")}}</p>
                            @else
                                <p class="fontstyle">Rp{{number_format($order->total_price,2,",",".")}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-12 mb-3">
                            <p  class="text-muted mb-1 fontstyle" style="text-align: center;font-weight:bold">Picture of Proof </p>
                          </div>
                        </div>
                    </div>

                    <div class= 'd-flex justify-content-center align-items-center' style="margin-top: -100px">
                        <div class="click-zoom">
                            <img onclick="window.open(this.src, '_blank')"  class="img-thumbnail ms-2 me-3" src="/storage/{{$order->payment_proof}}" alt="" style="width:120px">
                          </div>
                    </div>

                    <div class="d-flex justify-content-center" style="gap:100px;margin-right: -6px;margin-top: -8px;margin-bottom:20px" enctype="multipart/form-data">
                        <a href="/rejectPaymentProof/{{$order->id}}" class="btn btn-danger text-light" style="width: 6rem;">Reject</a>
                        <a href="/acceptPaymentProof/{{$order->id}}" class="btn btn-success text-light" style="width: 6rem;">Approve</a>
                     </div>



                </div>



            </div>


        </div>


    </div>


</section>
