@extends('master')

@section('content')


<section class="h-100 h-custom mt-5" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div  class="col-lg-8 col-xl-6">
                <div class="card border-top border-bottom border-3 fontstyle" style="border-color: #f37a27 !important;">
                    <div  class="card-body p-5">
                        <a href="{{url()->previous()}}"> <i class="fa-solid fa-arrow-left fa-xl me-3 fa-fw" style="margin-left:430px; margin-bottom:5%"></i></a>
                        <p class="lead fw-bold mb-5 fontstyle" style="color: #f37a27">Show Payment Proof</p>

                        <div class="row d-flex justify-content-start">
                          <div class="col-4 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Date</p>
                            <p class="fontstyle">18 agustus</p>
                          </div>
                          <div class="col-5 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Vendor</p>
                            <p class="fontstyle">aneka snack</p>
                          </div>
                          <div class="col-3 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Order No.</p>
                            <p class="fontstyle">ODR-1</p>
                          </div>
                        </div>
                        <div class="row d-flex justify-content-start">
                          <div class="col-6 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Address</p>
                            <p class="fontstyle">jalan simanjuntak 69</p>
                          </div>
                          <div class="col-6 mb-3">
                            <p class="small text-muted mb-1 fontstyle">Total</p>
                            <p class="fontstyle">Rp 690000</p>
                          </div>
                        </div>
                        <div class="row d-flex justify-content-center ">
                          <div class="col-12 mb-3">
                            <p  class="small text-muted mb-1 fontstyle" style="text-align: center;font-weight:bold"  >Picture of Proof </p>
                          </div>
                        </div>
                    </div>

                    <div class= 'd-flex justify-content-center align-items-center' style="margin-top: -100px">
                        <div class="click-zoom">
                            <label>
                              <input type="checkbox">
                              <img onclick="window.open(this.src, '_blank')"  class="img-thumbnail ms-2 me-3" src="{{ asset('assets/images/receipt.png') }}" alt="" style="width:120px">
                            </label>
                          </div>

                    </div>

                    <form class="d-flex justify-content-center"  style="gap:100px;margin-right: -6px;margin-top: -8px;margin-bottom:20px">
                            <button type="submit" class="btn btn-danger"value="2" name="status" id="status" style="width: 6rem;">Reject</button>
                            <button type="submit" class="btn btn-success" value="1" name="status" id="status" style="width: 6rem;">Accept</button>
                     </form>



                </div>



            </div>


        </div>


    </div>


</section>
