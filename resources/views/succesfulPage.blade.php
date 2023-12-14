@extends('master-clean')

@section('content')


<div class="covering">


<div class="popup center">
    <div class="icon">
        <i class="fa fa-check"></i>
    </div>
    <div class="title">
        Success!!
    </div>
    <div class="description">
        Your Order has been Successfully accepted and receipt of your order has been sent to your email
    </div>

    <div class="dismiss-btn">
        <button id="dismiss-popup">
            <a href="/vendorList" style="--i:3">Dismiss</a>
        </button>
    </div>
</div>
</div>








@endsection
