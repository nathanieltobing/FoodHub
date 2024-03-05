@extends('master')


@section('content')

<div class="container pt-5">
    <div class ="row pt-5" style="margin-top: 4rem">

            <h1 class="text-center" style="font-size: 30px;font-family: Poppins; font-weight:700;">Vendor List</h1>
            <div class="border"></div>
      <form action="/vendorList/search" class="row justify-content-start mb-4" role="search">
          <div class="col-md-4 input-group">
              <input class="form-control me-2"  name="search" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <a href="/vendorList" class="btn btn-outline-primary">Reset</a>
            </div>
          </div>
      </form>
    </div>
  </div>

<div class="container d-flex justify-content-center" >

    @if ($vendors->count()==1)
      @foreach ($vendors as $vendor)
      <div class="card text-center mx-2 mt-4" style="width: 60%;border: 1px solid rgba(0, 0, 0, .05);     border-radius: 15px;     box-shadow: 0 4px 24px rgba(0, 0, 0, .10);">
        <img src="/storage/{{$vendor->image}}" class="card-img-top" alt="..." style="height:500px;">
        <div class="card-body">
          <h5 class="card-title" style="font-weight: 600; font-family: Poppins;">{{$vendor->name}}</h5>
          <div class="stars">
              @for ($i = 0; $i < $vendor->rating ; $i++)
                <i class="fas fa-star"></i>
              @endfor
          </div>
          <p class="card-text" style="height:80px;font-weight: 600; font-family: Poppins;">{{$vendor->description}}</p>
          <div class="row">
            <a href="/products/{{$vendor->id}}" class="btn btn-primary btn-lg vendor-listbtn" style="margin-top:10px;line-height :1.66; font-weight: 400; font-family: Poppins;background-color:var(--indigo-500)">Detail</a>
          </div>
      </div>
      </div>

      @endforeach
    @else
      @foreach ($vendors as $vendor)
      <div class="card text-center mx-2 mt-4" style="width: 100%;border: 1px solid rgba(0, 0, 0, .05);     border-radius: 15px;     box-shadow: 0 4px 24px rgba(0, 0, 0, .10);">
        <img src="/storage/{{$vendor->image}}" class="card-img-top" alt="..." style="height:500px;">
        <div class="card-body">
          <h5 class="card-title" style="font-weight: 600; font-family: Poppins;">{{$vendor->name}}</h5>
          <div class="stars">
              @for ($i = 0; $i < $vendor->rating ; $i++)
                <i class="fas fa-star"></i>
              @endfor
          </div>
          <p class="card-text" style="height:80px;font-weight: 600; font-family: Poppins;">{{$vendor->description}}</p>
          <div class="row">
            <a href="/products/{{$vendor->id}}" class="btn btn-primary btn-lg vendor-listbtn" style="margin-top:10px;line-height :1.66; font-weight: 400; font-family: Poppins;background-color:var(--indigo-500)">Detail</a>
          </div>
      </div>
      </div>
    @endforeach
    @endif

 </div>
 <div class = "d-flex justify-content-center mt-4">
   {{$vendors->links()}}
 </div>

</div>

@endsection
