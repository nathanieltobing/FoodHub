@extends('master-clean')

@section('content')
<section style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black mb-5" style="border-radius: 25px;">
            <div class="card-body p-md-5">
                <a href="{{url()->previous()}}"> <i class="fa-solid fa-arrow-left fa-xl me-3 fa-fw"></i></a>
              <div class="row justify-content-center">
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins;">FH</p>

                <div class="col-md-12 col-lg-12 col-xl-12 order-2 order-lg-1">
                    <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 " style=" font-weight: 700; color:#222; font-family: Poppins;">Edit Product</p>

                    {{-- <h2 class="text-center  fw-bold  mx-1 mx-md-4 " style=" font-size:18px; font-weight: 700; color:#222; font-family: Poppins;">WELCOME TO FOODHUB</h2>
                    <h2 class="text-center  fw-bold mb-5 mx-1 mx-md-4 " style="font-size:18px; font-weight: 700; color:#222; font-family: Poppins;">LET'S GET STARTED</h2> --}}

                  {{-- <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="line-height :1.66; font-weight: 700; color:#222; font-family: Poppins;">Sign up</p> --}}

                  <form action="/product/vendor/{{$product->id}}" method="POST" enctype="multipart/form-data" class="mx-1 mx-md-4">
                    {{method_field('PUT')}}
                    @csrf
                    <div class="d-flex justify-content-center">
                      <img src="{{Storage::url($product->product_picture)}}" class="card-img-top" alt="..." style="height:300px; margin-bottom:3%; width:40%">
                    </div>
                    {{-- <div class="d-flex flex-row align-items-center mb-4">
                      <img src="{{url($product->product_picture)}}" class="card-img-top" alt="..." style="height:500px">
                      </div>

                    </div> --}}
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa-solid fa-pen-to-square fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" name="name" class="form-control" style="border: 1px solid;font-size:16 px;font-weight:500" value="{{$product->name}}">
                        <label class="form-label" for="form3Example1c" style="font-size:16 px;font-weight:700">Product Name</label>
                      </div>



                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa-solid fa-square-poll-vertical fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="number" id="form3Example3c" name="quantity" class="form-control" style="border: 1px solid;font-size:16 px;font-weight:500"" value={{$product->stock}}>
                        <label class="form-label" for="form3Example3c" style="font-size:16 px;font-weight:700">Quantity</label>
                      </div>
                    </div>

                    <input type="hidden" name="role" value="CUSTOMER">
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa-solid fa-tags fa-lg me-3 fa-fw" style="margin-bottom: 30px"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example4c" name="price" class="form-control" style="border: 1px solid;font-size:16 px;font-weight:500"" value={{$product->price}}>
                        <label class="form-label" for="form3Example4c" style="font-size:16 px;font-weight:700">Price</label>
                      </div>

                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa-solid fa-list fa-lg me-3 fa-fw" style="margin-bottom: 30px;"></i>
                      <div class="form-outline flex-fill mb-0">
                        <select class="select" name="category" id="format">
                          <option value="Main Course" {{strcmp($product->categories->name,"Main Course") == 0 ? 'selected' : ''}}>Main Course</option>
                          <option value="Appetizer" {{strcmp($product->categories->name,"Appetizer") == 0 ? 'selected' : ''}}>Appetizer</option>
                          <option value="Desserts" {{strcmp($product->categories->name,"Desserts") == 0 ? 'selected' : ''}}>Desserts</option>
                        </select>
                        <label class="form-label" style="display: flex;font-size:16 px;font-weight:700" for="form3Example3c">Category</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa-solid fa-square-pen fa-lg me-3 fa-fw" style="margin-bottom: 30px;"></i>
                      <div class="form-outline flex-fill mb-0">
                        <textarea rows="3" cols="22" name="desc" placeholder="" class="form-control" style="border: 1px solid ;font-size:16 px;font-weight:500"">{{$product->description}}</textarea>
                        <label class="form-label" for="form3Example1c" style="font-size:16 px;font-weight:700">Description</label>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-image fa-lg me-3 fa-fw" style="margin-bottom: 30px;"></i>
                        <div class="form-outline flex-fill mb-0" style="font-size:16 px;font-weight:700">
                            <input class="form-control" name="dp" type="file" id="formFile"  style="border: 1px solid;font-size:16 px;font-weight:500">
                          <label class="form-label" for="form3Example1c" style="font-size:16 px;font-weight:700">Upload your product's picture</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" class="btn btn-primary btn-lg payment-form-submit-button" style="line-height :1.66; font-weight: 400; font-family: Poppins;width: 35%">Edit Product</button>                    </div>

                    <div class="row text-danger">
                      @if(session()->has('error'))
                              <p>{{ session()->get('error') }}</p>
                          @endif
                          @if ($errors->any())
                          <ul class="ps-5">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                          @endif
                  </div>

                  </form>

                </div>
                {{-- <div class="col-md-2 col-lg-2 col-xl-7 d-flex flex-column align-items-center order-1 order-lg-2" style="margin-top: -5px">
                    <div class="d-flex flex-row align-items-center mb-4 text-center h1 fw-bold">

                    </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
