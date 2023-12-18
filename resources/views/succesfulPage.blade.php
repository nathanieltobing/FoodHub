@extends('master-clean')

@section('content')


{{-- <div class="covering">


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
</div> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Purchase</title>
    <style>
        body {
            font-family: "Montserrat",sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 97px;
            border-radius: 8px;
            text-align: center;
            max-width: 800px;
            height: 400px;
            width: 100%;
            border-radius: 15px;
             box-shadow: 0px 8px 15px #4F68C41A;

        }

        h1 {
            margin-top: -60px;
            color: #4CAF50;
            font-size: 30px
        }

        .submit-button:hover{
            color: var(--indigo-500);
    background: #f5f5f5;
        }


        .popup .dismiss-btn button{
    padding: 10px 20px;
    background:var(--indigo-500);
    color: #f5f5f5;
    border: 2px solid #fff;
    font-size: 16px;
    font-weight: 600;
    outline: none;
    border-radius: 10px;
    cursor: pointer;
    transition: all 300ms ease-in-out;
}

.popup .dismiss-btn button:hover{
    color: var(--indigo-500);
    background: #f5f5f5;
}
    </style>
</head>
<body>
    <div class="container">
        <h1 >Thank You for Your Purchase!</h1>
        <p class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;margin-top:30px;">Your order has been successfully processed.</p>
        <p class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;">An order successful notice has been sent to your email.</p>
        <p class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;">We appreciate your business and hope you enjoy your new purchase.</p>
        <p class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;">For any inquiries or assistance, please <a class="card-text payment-summary-price" style="font-size:18px;font-weight: 700; href="#">contact us</a>.</p>
        <a class="submit-button" href="/vendorList" style="--i:3;margin-left: 23%;    margin-top: 40px">Dismiss</a>
    </div>
</body>
</html>

</div>








@endsection
