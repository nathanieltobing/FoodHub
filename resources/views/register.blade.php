@extends('master-clean')

@section('content')
<section class="vh-100" style="background-color: #eee;margin-bottom: -50px;">
    <div class="container h-100 ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black mb-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
                <a href="/"> <i class="fa-solid fa-arrow-left fa-xl me-3 fa-fw"></i></a>
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins;">Sign up as Customer</p>

                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                    <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 " style=" font-weight: 700; color:#222; font-family: Poppins;">FH</p>

                    <h2 class="text-center  fw-bold  mx-1 mx-md-4 " style=" font-size:20px; font-weight: 700; color:#222; font-family: Poppins;">WELCOME TO FOODHUB</h2>
                    <h2 class="text-center  fw-bold mb-5 mx-1 mx-md-4 " style="font-size:20px; font-weight: 700; color:#222; font-family: Poppins;">LET'S GET STARTED</h2>

                  {{-- <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins;">Sign up</p> --}}

                  <form action="/register/customer" method="POST" enctype="multipart/form-data" class="mx-1 mx-md-4">
                    @csrf
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" name="name" class="form-control" />
                        <label class="form-label" for="form3Example1c" style="font-family: Poppins">Your Name</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" id="form3Example3c" name="email" class="form-control" />
                        <label class="form-label" for="form3Example3c" style="font-family: Poppins">Your Email</label>
                      </div>
                    </div>
                    <input type="hidden" name="role" value="CUSTOMER">
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" name="password" class="form-control" />
                        <label class="form-label" for="form3Example4c" style="font-family: Poppins">Password</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4cd" name="password_confirmation" class="form-control" />
                        <label class="form-label" for="form3Example4cd" style="font-family: Poppins">Repeat your password</label>
                      </div>
                    </div>

                    {{-- <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                      <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="#!">Terms of service</a>
                      </label>
                    </div> --}}

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg" style="line-height :1.66; font-weight: 400; font-family: Poppins;background-color:var(--indigo-500)">Register</button>
                    </div>

                    <div class="row text-danger">
                      @if(session()->has('error'))
                              <p>{{ session()->get('error') }}</p>
                          @endif
                          @if ($errors->any())
                          <ul class="ps-5">
                              @foreach ($errors->all() as $error)
                                  <li class="text-danger">{{ $error }}</li>
                              @endforeach
                          </ul>
                          @endif
                  </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex flex-column align-items-center order-1 order-lg-2" style="margin-top: -5px">
                    <div class="d-flex flex-row align-items-center mb-4 text-center h1 fw-bold">
                        <h1 style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins; margin-top:55px">PLEASE SELECT YOUR ROLE</h1>

                      </div>

                        <div class="d-flex flex-row align-items-center mb-4" style="gap: 10px;">




                            <a href="/register/customer" class="card-body fullwidth" style="width: 10rem; background: #fff; padding: 27px; border-radius: 15px; box-shadow: 0px 8px 15px #4F68C41A; border:1px solid gray">CUSTOMER</a>



                            <a href="/register/vendor" class="card-body fullwidth" style="width: 10rem; background: #fff; padding: 27px; border-radius: 15px; box-shadow: 0px 8px 15px #4F68C41A;">VENDOR</a>




                        {{-- <div class="testimonial" style="width: 10rem;">
                          <img src="..." class="card-img-top" alt="...">
                          <div class="card-body">

                            <a href="" class="card-title">ADMIN</a>

                          </div>

                        </div> --}}
                    </div>
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                    class="img-fluid" alt="Sample image">
                    <a href="/login" class="signup-image-link" style="text-decoration: underline;">I am already member</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
