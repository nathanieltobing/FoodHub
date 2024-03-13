@extends('master')

@section('content')
 <div class="container pt-5" style="margin-top: 4rem">
 {{-- <div class="p-5" style="background-color: #black"> --}}
    <h1 class="text-center" style="font-size :30px;font-family: Poppins;font-weight:700">Payment</h1>
    <div class="border"></div>




    <div  class="d-flex justify-content-around align-items-center">
        <div class="col-10">
            <div class="card card-body"style=" border-radius: 15px; box-shadow: 0px 8px 15px #4F68C41A;">
                <div class="card-title d-flex pb-1" style="margin-bottom:30px">
                    <i style="font-size:30px; margin-top:14px;margin-right:20px;margin-left:9px" class="fa">&#xf290;</i>

                    <div class="" style="margin-top:20px">
                        <span class="payment-summary-price justify-content-start" style="font-size:16px;font-weight: 700;margin-bottom:0;"> Order 1</span>


                    </div>
                </div>


                <div class="d-flex justify-content-end" style="gap:10px;margin-right: 20px;margin-top: -70px">
                    <span style="justify-content: end" class="btn-warning mx-3 btn active"> Awaiting Payment</span>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">


                        <img class="img-thumbnail ms-2 me-3" src="" alt="" style="width:80px">

                        <div>
                            <ul class="list-unstyled" style="margin-left: 8px">
                                        <li class="card-text payment-summary-price" style=" font-size:16px;font-weight: 700;" ></li>
                                        <span style="font-weight : 700;" class="card-text payment-summary-name"> QTY:</span> <span style="margin-left:10px;font-weight : 700;" class="card-text payment-summary-name">x</span>
                            </ul>
                            <span class="payment-summary-price" style="font-size:16px;font-weight: 700;margin-left:8px;margin-top:10px;justify-content-start">Total Belanja</span>
                            <p class="payment-summary-name" style="font-weight : 700;margin-left:8px;justify-content-start">Rp 150000</p>


                        </div>
                    </div>
                </div>
                <div class="actionBtn">
                    <a href="" style="text-decoration: none;margin-left: 73%"> <button>View Transaction</button></a>

                </div>


            </div>

        </div>

    </div>
</div>




