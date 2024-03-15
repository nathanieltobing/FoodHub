@extends('master')

@section('content')


  <section class="content">
    <main>
        <div class="" style="margin-top: 5%">

            <p style="font-size: 30px;font-family: Poppins; font-weight:700;text-align:center;margin-right:100px">Admin </p>
      </div>


      <div class="box-info" style="margin-top: 5%; margin-right:3%">
        <li>
            <i class="fas fa-people-group"></i>
            <span class="texts" style="line-height: 1.0;
            margin-bottom: -25px">
              <h3 style="font-size: 30px">{{$totalCustomer}}</h3>
              <p>Customers</p>
            </span>
          </li>
        <li>
          <i class="fas fa-people-group"></i>
          <span class="texts" style="line-height: 1.0;
          margin-bottom: -25px">
            <h3 style="font-size: 30px">{{$totalVendor}}</h3>
            <p>Vendors</p>
          </span>
        </li>

      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3 style="font-size: 20px">Customers</h3>

          </div>

          <table>
            <thead>
              <tr class="fontstyle">
                <th style="font-size: 16px">User</th>
                <th style="font-size: 16px">Created Date</th>
                <th style="font-size: 16px">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($customers as $c)
                <tr>
                  <td>
                    @if ($c->image !=null)
                      <img src="/storage/{{$c->image}}" alt="" />
                    @else
                      <i class="bx bx-user-circle text-center mb-2" role="button" aria-expanded="false" style="font-size:2rem"> </i>
                    @endif
                    <p class="fontstyle">{{$c->name}}</p>
                  </td>
                  <td class="fontstyle">{{\Carbon\Carbon::parse($c->created_at)->format('d-m-Y')}}</td>
                  @if ($c->status == 'ACTIVE')
                  <form action="/deactivate/{{$c->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="CUSTOMER">

                    <td><button class="status complete" style="border:none">Active</button></td>
                  </form>


                  @else
                  <form action="/activate/{{$c->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="CUSTOMER">
                    <td><button class="status pending" style="border:none;">Inactive</button></td>
                  </form>
                  @endif

                </tr>
              @empty

              @endforelse
            </tbody>
          </table>
            <div class = "d-flex justify-content-center mt-4">
              {{$customers->appends(['vendors' => $vendors->currentPage()])->links()}}
            </div>
        </div>

        <div class="order" style="margin-right: 3%">
            <div class="head">
              <h3 style="font-size: 20px">Vendors</h3>
              {{-- <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i> --}}
            </div>

            <table>
              <thead>
                <tr class="fontstyle">
                  <th style="font-size: 16px">User</th>
                  <th style="font-size: 16px">Status</th>
                  <th style="font-size: 16px">Number Of Transaction</th>
                  <th style="font-size: 16px">Total Sales</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($vendors as $v)
                <tr>
                  <td>
                    <img src="/storage/{{$v->image}}" alt="" />
                    <p class="fontstyle">{{$v->name}}</p>
                  </td>

                  @if ($v->status == 'ACTIVE')
                  <form action="/deactivate/{{$v->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="VENDOR">
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status complete " style="border:none">Active</button></td>
                  </form>
                  @else
                  <form action="/activate/{{$v->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    <input type="hidden" id="hidden1" name="role" value="VENDOR">
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status pending" style="border:none;">Inactive</button></td>
                  </form>
                  @endif
                  <td>
                    <p class="fontstyle">{{$v->name}}</p>
                  </td>
                  <td>
                    <p class="fontstyle">{{$v->name}}</p>
                  </td>
                </tr>
              @empty

              @endforelse
              </tbody>
            </table>
            <div class = "d-flex justify-content-center mt-4">
              {{$vendors->appends(['customers' => $customers->currentPage()])->links()}}
            </div>


          </div>

      </div>
      <div class="box-info" style="margin-top: 5%; margin-right:3%;background:none">
        <li style="background:none">

           <span class="texts" style="line-height: 1.0;margin-left: 43%;margin-bottom: 215px ">
            <p  style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 66px">Top Category</p>
            <div class="card shadow text-center" style="border-radius: 15px;">
                <div class="card-body" style="height: 23.5rem;">
                <p style="padding-top :0%;font-size:24px;font-weight:700;font-family:Poppins;">MAIN COURSE</p>
                <hr class="bg-dark" style="    margin-bottom: 25px">
                <p  class="testimonials" style="font-size:20px;font-weight:700;font-family:Poppins;margin-left: -2px ;padding: 10px 10px;backdrop-filter:blur(0px);box-shadow:none"> Number Of Transaction: 200</p>
                <hr class="bg-dark" style="    margin-bottom: 25px">
                <p class="testimonials "style="font-size:20px;font-weight:700;font-family:Poppins;padding: 10px 10px;backdrop-filter:blur(0px);box-shadow:none"> Total Income: Rp17.000.000</p>
                <hr class="bg-dark"style="    margin-bottom: 40px">
                <p class="testimonials "style="font-size:20px;font-weight:700;font-family:Poppins;padding: 10px 10px;backdrop-filter:blur(0px);box-shadow:none"> Products Sold: 117</p>
                </div>
            </div>
                    {{-- <img style="width: 200px" src="/storage/{{$v->image}}" alt="" />
                    <span  style="font-size:30px;font-weight:700;font-family:Poppins;"  class="fontstyle">{{$v->name}} </span>
                    <span style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 215px"> Total Earning: Rp 20.000.000</span> --}}


        </li>
        <li style="background:none">
          <span class="texts" style="line-height: 1.0;margin-left: 43%;margin-bottom: 210px">
            <p  style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 66px">Top Vendor</p>
            <div  class="card shadow text-center" style="border-radius: 15px">

                <img src="/storage/{{$v->image}}" class="card-img-top" alt="Product Image" style="border-top-left-radius: 15px; border-top-right-radius: 15px; object-fit:cover; height: 14.5rem;">
                <div class="card-body" style="height: 8.5rem; overflow: hidden;">
                    <h5  style="font-size:30px;font-weight:700;font-family:Poppins;"class="card-title fontstyle">Salama Catering</h5>
                    <hr class="bg-dark">
                    <h6 style="font-size:24px;font-weight:700;font-family:Poppins;">Product Sold: 120</h6>
                    {{-- <p class="card-text fontstyle" style="height:5rem; overflow:hidden;" >Makanan Ringan yang blabalbal</p> --}}
                </div>
            </div>
                    {{-- <img style="width: 200px" src="/storage/{{$v->image}}" alt="" />
                    <span  style="font-size:30px;font-weight:700;font-family:Poppins;"  class="fontstyle">{{$v->name}} </span>
                    <span style="font-size:30px;font-weight:700;font-family:Poppins;margin-left: 215px"> Total Earning: Rp 20.000.000</span> --}}
          </span>
        </li>

      </div>
    </main>
  </section>


@endsection
