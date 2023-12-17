@extends('master')


@section('content')

<div class="container">
    <div class ="row">

      <div class="col d-flex justify-content-center" style="margin-top: 10%">

         {{-- <h1 style="color: white"><b>Book List</b></h2>   --}}
            <p style="font-size: 35px">Vendor List</p>
      </div>
      <hr class="bg-dark">
      <form action="/vendorList/search" class="row justify-content-start mb-4" role="search">
          <div class="col-md-4">
              <input class="form-control me-2"  name="search" type="search" placeholder="Search" aria-label="Search">
          </div>
      </form>
    </div>
  </div>

<div class="container d-flex justify-content-center" >

    @foreach ($vendors as $vendor)
    <div class="card text-center mx-2 mt-4" style="width: 30rem;">
      <img src="{{Storage::url($vendor->image)}}" class="card-img-top" alt="..." style="height:500px">
      <div class="card-body">
        <h5 class="card-title">{{$vendor->name}}</h5>
        <div class="stars">
            @for ($i = 0; $i < $vendor->rating ; $i++)
               <i class="fas fa-star"></i>
            @endfor
        </div>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        {{-- <h5 class="card-text">Category : {{$vendor->category}}</h5>
        <h5 class="card-text">Price : Rp {{$vendor->price}}</h5>
        <h5 class="card-text">Description : {{$vendor->description}}</h5> --}}
        <div class="row">
          <a href="/products/{{$vendor->id}}" class="btn btn-primary btn-lg">Detail</a>
        </div>
     </div>
    </div>
   @endforeach
 </div>
 <div class = "d-flex justify-content-center mt-4">
   {{$vendors->links()}}
 </div>                  

</div>

@endsection
