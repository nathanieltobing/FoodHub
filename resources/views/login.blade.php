@extends('master-clean')

@section('content')
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black mb-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 " style=" font-weight: 700; color:#222; font-family: Poppins;">Login</p>
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1" style ="margin-top: 48px">
                         <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 " style=" font-weight: 700; color:#222; font-family: Poppins;">FH</p>

                  <h2 class="text-center  fw-bold  mx-1 mx-md-4 " style=" font-size:18px; font-weight: 700; color:#222; font-family: Poppins;">WELCOME TO FOODHUB</h2>
                  <h2 class="text-center  fw-bold mb-5 mx-1 mx-md-4 " style="font-size:18px; font-weight: 700; color:#222; font-family: Poppins;">LET'S GET STARTED</h2>


                  <form class="mx-1 mx-md-4 ">


                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw" style="margin-bottom: -5px;"></i>
                      <div class="form-outline flex-fill mb-0" style="margin-top: 35px">
                        <input type="email" id="form3Example3c" class="form-control" />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-2">
                      <i class="fas fa-lock fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" class="form-control" />
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4" style="margin-left:42px">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                          <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                          <label class="form-check-label" for="form2Example3">
                            Remember me
                          </label>
                        </div>

                    </div>


                     {{-- <div class="btn-group mb-3" role="group">
                      <button type="button" class="btn btn-light btn-lg" style="line-height :1.66; font-weight: 600; font-family: Poppins; font-size: 16px;">Customer</button>
                      <button type="button" class="btn btn-light btn-lg" style="line-height :1.66; font-weight: 600; font-family: Poppins; font-size: 16px;">Vendor</button>
                      <button type="button" class="btn btn-light btn-lg" style="line-height :1.66; font-weight: 600; font-family: Poppins; font-size: 16px;">Admin</button>
                      </div> --}}

                    <div class="d-grid gap-2 mb-3 mb-lg-4">
                      <button type="button" class="btn btn-primary btn-lg" style="line-height :1.66; font-weight: 500; font-family: Poppins;">Login</button>
                    </div>


                  </form>

                </div>

                <div class="col-md-10 col-lg-6 col-xl-7 d-flex flex-column align-items-center order-1 order-lg-2" >
                    <div class="d-flex flex-row align-items-center mb-4 text-center h1 fw-bold">
                        <h1 style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins; margin-top:55px">PLEASE SELECT YOUR ROLE</h1>

                      </div>

                        <div class="d-flex flex-row align-items-center mb-4" style="gap: 10px;">


                        <div class="testimonial  " style="width: 10rem;">
                          {{-- <img src="..." class="card-img-top" alt="..."> --}}
                          <div class="card-body">
                            <a href="" class="card-title" style="text-align: center">CUSTOMER</a>

                          </div>

                        </div>
                        <div class="testimonial" style="width: 10rem;">
                          {{-- <img src="..." class="card-img-top" alt="..."> --}}
                          <div class="card-body">

                            <a href="/register" class="card-title"  style="text-align: center">VENDOR</a>

                          </div>

                        </div>
                        <div class="testimonial" style="width: 10rem;">
                          {{-- <img src="..." class="card-img-top" alt="..."> --}}
                          <div class="card-body">

                            <a href="/login"class= "card-title"  style="text-align: center">ADMIN</a>

                          </div>

                        </div>
                    </div>



                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
                    <h1>Don't have an account ? <a href="/register" class="signup-image-link" style="text-decoration: underline;">Register</a></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection