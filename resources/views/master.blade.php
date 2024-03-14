<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="js/YourExternalJQueryScripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body>
<header class="header">
       <a href="/" class="logo">FH</a>
        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class="bx bx-menu" id="menu-icon" style="margin-right: 20px"></i>
            <i class="bx bx-x" id="close-icon" style="margin-right: 20px"></i>
        </label>
    <nav class="navbar" style="display: block">

        @if(Auth::guard('webcustomer')->check())
          <div class="justify-content-center" style="gap: 50px;display :block">

            <a  href="/vendorList" style="--i:3"><img src="{{ asset('assets/images/vendoricon.png') }}" style="height:1.3rem; margin-bottom:0.3rem"></a>
            <a  href="/orderlist" style="--i:3"><img src="{{ asset('assets/images/orderlist.png') }}" style="height:1.3rem; margin-bottom:0.3rem"></a>

            <a href="/checkout" style="--i:3"><i class="fa-solid fa-cart-shopping"></i></a>
          </div>
            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="{{ asset('assets/images/user.png') }}" alt="">
                </div>
                <div class="menu">
                    <h3>{{Auth::guard('webcustomer')->user()->name}} </h3>
                    <ul>
                        <li><img src="{{ asset('assets/images/user.png') }}"><a href="/customer/profile"  style="margin-left:10px">Profile</a></li>
                        <li><img src="{{ asset('assets/images/log-out.png') }}"><a href="/logout" style="margin-left:10px">Logout</a></li>

                    </ul>
                </div>
            </div>

          </div>
          @elseif (Auth::guard('webvendor')->check())
          <div class="justify-content-center" style="gap: 50px">
            <a href="/orderlist" style="--i:3"><img src="{{ asset('assets/images/orderlist.png') }}" style="height:1.3rem"></a>
            <a href="/product/vendor" style="--i:3"><img src="{{ asset('assets/images/producticon.png') }}" style="height:1.4rem"></a>

            <div class="action">
                <div class="profile" onclick="menuToggle();">
                    <img src="{{ asset('assets/images/user.png') }}" alt="">
                </div>
                <div class="menu">
                    <h3>{{Auth::guard('webvendor')->user()->name}} </h3>
                    <ul>
                        <li><img src="{{ asset('assets/images/user.png') }}"><a href="/vendor/profile"  style="margin-left:10px">Profile</a></li>
                        <li><img src="{{ asset('assets/images/log-out.png') }}"><a href="/logout" style="margin-left:10px">Logout</a></li>

                    </ul>
                </div>
            </div>
          </div>
          @elseif(Auth::guard('webadmin')->check())
            {{-- Button khusus Admin --}}
            <a href="/admin-payment" style="--i:3"><img src="{{ asset('assets/images/transaction.png') }}" style="height:1.3rem"></a>
            <a href="/logout" style="--i:3"><i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180" style="height:1.3rem; margin-bottom:0.3rem"></i></a>
          @else
            <a href="/vendorList" style="--i:3"><img src="{{ asset('assets/images/vendoricon.png') }}" style="height:1.3rem; margin-bottom:0.3rem"></a>
            <a href="/login" style="--i:3">Login</a>
            <a href="/register/customer" style="--i:3">Register</a>
          @endif
          <script>
            function menuToggle(){
                const toggleMenu = document.querySelector('.menu');
                toggleMenu.classList.toggle('active')
            }
          </script>
    </nav>

</header>


        @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

<footer>
    <div class="footerContainer">
        <div class="socialIcons">
            <a href=""><i class="fab fa-facebook"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>

        </div>
        <div class="footerNav nav_links">
            <ul>
                <li><a href="/">HOME</a></li>
            </ul>
        </div>
        <div class="footerBottom">
            <p>COPYRIGHT &copy; 2023;</p>
        </div>

    </div>


</footer>
</html>

