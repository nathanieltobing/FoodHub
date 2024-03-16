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
    <title>Incoming Order FoodHub</title>
</head>

<body>
    <p>Your order has been updated, please check your order in FoodHub to see the update</p>
    <p>
        {{-- Order No : ODR-{{$order->id}} --}}
    </p>

</body>

</html>