<!DOCTYPE html>
<html>

<style>
    @font-face {
        font-family: "scandia-line-web";
        src: url("https://use.typekit.net/af/3cdb9c/00000000000000007735db09/30/l?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n4&v=3") format("woff2"),
            url("https://use.typekit.net/af/3cdb9c/00000000000000007735db09/30/d?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n4&v=3") format("woff"),
            url("https://use.typekit.net/af/3cdb9c/00000000000000007735db09/30/a?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n4&v=3") format("opentype");
        font-display: auto;
        font-style: normal;
        font-weight: 400;
        font-stretch: normal;
    }
    * {
        font-family: "scandia-web";
    }
</style>

<head>
    <title>Foodhub Order Checkout Successful</title>
</head>

<body>
    <p>We send this email to inform you that your order has been successfully processed.</p>
    <p>
        Vendor : {{$order->vendors->name}}
        Order No : ODR-{{$order->id}}
    </p>
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
        @if ($od->discount_price != null)
            <p>{{$od->product_name}}&emsp;{{$od->quantity}}qty&emsp;Rp{{number_format($od->discount_price,2,",",".")}}</p> 
        @else
            <p>{{$od->product_name}}&emsp;{{$od->quantity}}qty&emsp;Rp{{number_format($od->price,2,",",".")}}</p> 
        @endif  
    @endforeach
    <br>
    <p>Service Fee : Rp2.000,00</p>
    @if ($order->membership_discount != null)   
        <p>Membership Discount : Rp{{number_format((int)($totalPrice * $order->membership_discount),2,",",".")}}</p> 
        <p>Total Price : Rp{{number_format($totalPrice + 2000 - (int)($totalPrice * $order->membership_discount),2,",",".")}}</p>        
    @else
        <p>Total Price : Rp{{number_format($totalPrice + 2000 ,2,",",".")}}</p>         
    @endif


</body>

</html>