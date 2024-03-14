@extends('master')

@section('content')
@php
    use App\Models\Product;
@endphp
 <div class="container pt-5" style="margin-top: 4rem">
    @if(session('message'))
    <div class="container">
        <div class="d-grid gap-2 mt-3">
            <div class="btn btn-success" type="">{{session('message')}}</div>
        </div>
    </div>
    @endif
 <div class="p-5" style="background-color: #black">
    <h1 class="text-center" style="font-size :30px;font-family: Poppins;font-weight:700">Payment</h1>
    <div class="border"></div>
    <br>

    <div  class="d-flex justify-content-around align-items-center">
        <div class="col-10">
            @foreach ($orders as $o)
            @if ($o->status == 'AWAITING PAYMENT' && $o->payment_proof)
            <div class="card card-body"style=" border-radius: 15px; box-shadow: 0px 8px 15px #4F68C41A;">
                <div class="card-title d-flex pb-1" style="margin-bottom:30px">
                    <i style="font-size:30px; margin-top:14px;margin-right:20px;margin-left:9px" class="fa">&#xf290;</i>

                    <div class="" style="margin-top:20px">
                        <span class="payment-summary-price justify-content-start" style="font-size:16px;font-weight: 700;margin-bottom:0;"> Order {{$o->id}}</span>


                    </div>
                </div>
                <div class="d-flex justify-content-end" style="gap:10px;margin-right: 20px;margin-top: -70px">
                    <span style="justify-content: end" class="btn-secondary mx-3 btn active"> AWAITING CONFIRMATION</span>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">

                        @foreach ($o->order_details as $index=>$od)
                        @if ($index == 0)
                        <img class="img-thumbnail ms-2 me-3" src="/storage/{{Product::where('id',$od->product_id)->value('image')}}" alt="" style="width:80px">

                        <div>
                            <ul class="list-unstyled">
                                <li class="card-text payment-summary-price" style="font-size:16px;font-weight: 700;" >{{ $od->product_name }}</li>
                                <span style="font-weight : 700;" class="card-text payment-summary-name"> QTY:</span> <span style="margin-left:10px;font-weight : 700;" class="card-text payment-summary-name">x{{ $od->quantity }}</span>
                            </ul>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
                <div class="card-text d-flex flex-column">
                    <span class="payment-summary-price" style="font-size:16px;font-weight: 700;margin-left:8px;margin-top:10px;justify-content-start">Total Belanja</span>
                    <p class="payment-summary-name" style="font-weight : 700;margin-left:8px;justify-content-start">Rp{{number_format($o->total_price,2,",",".")}}</p>
                    @if ($o->nego_price && $o->nego_status != 'REJECTED')
                        <span class="payment-summary-price" style="font-size:16px;font-weight: 700;margin-left:8px;margin-top:10px;justify-content-start">Harga Negosiasi</span>
                        <p class="payment-summary-name" style="font-weight : 700;margin-left:8px;justify-content-start">Rp{{number_format($o->nego_price,2,",",".")}}</p>
                    @endif

                    <div class="d-flex justify-content-end" style="gap:10px;margin-right: 35px;margin-top: -60px">
                        @if ($o->payment_proof_status == 'REJECTED')
                            <p class="btn btn-info active" style="text-decoration: none;margin-left: 73%; width: 12rem;">Waiting for revision</p>
                        @else
                            <a href="/transaction/{{$o->id}}" class="btn text-light" style="background-color:var(--indigo-500)">Check proof</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach


        </div>

    </div>
 </div>
</div>




