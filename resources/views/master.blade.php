<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giant Book Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="js/YourExternalJQueryScripts.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
<header class="header">
        <a href="/" class="logo">FH</a>
        <input type="checkbox" id="check">
        <label for="check" class="icons">
            <i class="bx bx-menu" id="menu-icon"></i>
            <i class="bx bx-x" id="close-icon"></i>
        </label>
    <nav class="navbar" style="display: block">
        {{-- <a class="forms" href="#"  style="--i:4;display:inline-flex;"> <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form></a> --}}

        @if(Auth::guard('webcustomer')->check())
          <div class="justify-content-center" style="gap: 50px;display :block">
            <a href="/homepage" style="--i:3">Vendor List</a>
            <a href="/homepage" style="--i:3">Membership</a>
            <a href="/homepage" style="--i:3">Profile</a>
            <a href="/homepage" style="--i:3">Logout</a>
          </div>
          @elseif (Auth::guard('webvendor')->check())
          <div class="justify-content-center" style="gap: 50px">
            <a href="/homepage" style="--i:3">Order List</a>
            <a href="/homepage" style="--i:3">Membership</a>
            <a href="/homepage" style="--i:3">Profile</a>
            <a href="/homepage" style="--i:3">Logout</a>
          </div>
          @elseif(Auth::guard('webadmin')->check())
            {{-- Button khusus Admin --}}
            <a class="text-white" href="/home">Admin</a>
            <a href="/logout" style="--i:3">Logout</a>
          @else
            {{--Button belom login --}}
            <a href="/login" style="--i:3">Login</a>
            <a href="/register" style="--i:3">Register</a>
          @endif
    </nav>

</header>


    </header>
        @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- content --}}

{{-- end of content --}}

    {{-- <section class="container">
        <div class="inner">
            <h1 style="margin-left:40%">Promotion</h1>
            <div class="border"></div>
        </div>
        <div class="slider-wrapper">
            <div class="slider">
                <img id="slide-1" src="storage/images/foodbanner1.jpg" alt="3D rendering of an imaginary orange planet in space" />
                <img id="slide-2" src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="3D rendering of an imaginary green planet in space" />
                <img id="slide-3" src="https://images.unsplash.com/photo-1656077217715-bdaeb06bd01f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="3D rendering of an imaginary blue planet in space" />
            </div>
            <div class="slider-nav">
                <a href="#slide-1"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
            </div>
        </div>
    </section>

    <div class="testimonials">
        <div class="inner">
          <h1>Best Vendors</h1>
          <div class="border"></div>

          <div class="row">
            <div class="col">
              <div class="testimonial">
                <img src="https://images.unsplash.com/photo-1657586640569-4a3d4577328c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1200&q=80" alt="">
                <div class="name">Full name</div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>

                <p>
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                </p>
              </div>
            </div>

            <div class="col">
              <div class="testimonial">
                <img src="storage/images/foodbanner1.jpg" alt="">
                <div class="name">Full name</div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                  <i class="far fa-star"></i>
                </div>

                <p>
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                </p>
              </div>
            </div>

            <div class="col">
              <div class="testimonial">
                <img src="storage/images/foodbanner1.jpg" alt="">
                <div class="name">Full name</div>
                <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                </div>

                <p>
                  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}


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
                <li><a href="">HOME</a></li>
                <li><a href="">FEEDBACK</a></li>
                <li><a href="">CONTACT US</a></li>
            </ul>
        </div>
        <div class="footerBottom">
            <p>COPYRIGHT &copy; 2023;</p>
        </div>

    </div>


</footer>
</html>

