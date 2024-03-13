@extends('master')

@section('content')
<div class="container pt-5" style="margin-top: 4rem">
    @if(session('message'))
    <div class="container">
        <div class="d-grid gap-2 mt-3">
            <div class="btn btn-success" type="">{{session('message')}}</div>
        </div>
    </div>
    @endif

    <div class="p-5" style="background-color: #black">
    <h1 class="text-center" style="font-size :30px;font-family: Poppins;font-weight:700">Payment Form</h1>
    <div class="border"></div>
    <br>
    <div class="payment-form">
        <form action="/confirmPayment/{{$order->id}}" method="POST" class="pb-3" enctype="multipart/form-data">
            @csrf
            <h1 class="payment-title">Upload Payment proof</h1>
            <div class="payment-form-group">
                @if (!$order->nego_price)
                <p> <b>Total Payment</b> : Rp{{number_format($order->total_price,2,",",".")}}</p>
                @else
                <p> <b>Total Payment</b> : Rp{{number_format($order->nego_price,2,",",".")}}</p>
                @endif
                <p><b>Bank Account Number</b> : 744010233 (PT Foodhub Sejahtera)</p>
                <label for="paymentProof">Please upload your payment proof (format jpg, peg, or png)</label>
                <input type="file" class="form-control" id="paymentProof" name="paymentProof">
            </div>
            <button type="submit" class="payment-form-submit-button my-3"><i class="ri-wallet-line"></i>Submit</button>
        </form>
        <div class="row text-danger">
            @if(session()->has('error'))
                    <p>{{ session()->get('error') }}</p>
                @endif
                @if ($errors->any())
                <ul class="ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
        </div>
    </div>
    </div>
</div>
@endsection
