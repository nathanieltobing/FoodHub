<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giant Book Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        {{-- <img class ="logo" src ="{{ asset('assets/images/logo.png') }}" alt ="logo"> --}}
        <nav>
            <ul class="nav_links">
             <li><a href="#"> Home</a></li>
             <li><a href="#"> About Us</a></li>
             <li><a href="#"> Vendor List</a></li>
             <li> <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form></li>
              <li> <a class= "cta" href="#"><button>Login</button></a></li>
            </ul>
        </nav>
    </header>

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

