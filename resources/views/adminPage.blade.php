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
                  <th style="font-size: 16px">Total Transaction</th>
                  <th style="font-size: 16px">Monthly Revenue</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($vendors as $v)
                <?php
                
                  $vendorR = \App\Models\VendorReporting::where('vendor_id', $v->id)->where('month',\Carbon\Carbon::now()->month)->first();
                ?>
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
                    @if($vendorR == null)
                      <p class="fontstyle">0</p>
                    @else 
                     <p class="fontstyle">{{$vendorR->number_of_transaction}}</p>
                     @endif
                  </td>
                  <td>
                     @if($vendorR == null)
                      <p class="fontstyle">0</p>
                     @else 
                      <p class="fontstyle">Rp{{number_format($vendorR->total_earning_monthly,2,",",".")}}</p>
                     @endif
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

      <div class="box-info">
        <div class="top-category">
            <h2>Top Category</h2>
            <div class="category-card-container">
            
                <div class="card-admin shadow text-center">
                    <div class="card-admin-body">           
                        <h3 class="category-title">{{$topCategory->categories->name}}</h3>
                        <hr class="hrs">
                        <p class="category-info">Product Sold: {{$topCategory->product_sold}}</p>
                        <hr class="hrs">
                        {{-- <p class="category-info">Total Income: Rp17.000.000</p>
                        <hr class="hrs">
                        <p class="category-info">Products Sold: 117</p> --}}
                    </div>
                </div>
                {{-- <div class="card shadow text-center">
                    <div class="card-body">
                        <h3 class="category-title">DESSERT</h3>
                        <hr class="hrs">
                        <p class="category-info">Number Of Transaction: 150</p>
                        <hr class="hrs">
                        <p class="category-info">Total Income: Rp12.000.000</p>
                        <hr class="hrs">
                        <p class="category-info">Products Sold: 90</p>
                    </div>
                </div> --}}

            </div>
        </div>
        {{-- <div class="top-category">
            <h2>Top Category</h2>
            <div class="vendor-card-container">
            <div class="card shadow text-center d-flex">
                <div class="card-body">
                    <h3 class="category-title">MAIN COURSE</h3>
                    <hr class="hrs">
                    <p class="category-info">Number Of Transaction: 200</p>
                    <hr class="hrs">
                    <p class="category-info">Total Income: Rp17.000.000</p>
                    <hr class="hrs">
                    <p class="category-info">Products Sold: 117</p>
                </div>
                <div class="card-body">
                    <h3 class="category-title">MAIN COURSE</h3>
                    <hr class="hrs">
                    <p class="category-info">Number Of Transaction: 200</p>
                    <hr class="hrs">
                    <p class="category-info">Total Income: Rp17.000.000</p>
                    <hr class="hrs">
                    <p class="category-info">Products Sold: 117</p>
                </div>
            </div>
            </div>
        </div> --}}
        <div class="top-vendor">
            <h2>Top Vendor</h2>
            <div class="vendor-card-container">
                <div class="card-admin shadow text-center">
                    <img src="/storage/{{$v->image}}" class="" alt="Product Image">
                    <div class="card-admin-body">
                        <h3 class="vendor-name">Salama Catering</h3>
                        <hr class="hrs">
                        <p class="vendor-info">Product Sold: 120</p>
                    </div>
                </div>
                {{-- <div class="card shadow text-center">
                    <img src="/storage/{{$v->image}}" class="card" alt="Product Image">
                    <div class="card-body">
                        <h3 class="vendor-name">Salama Catering</h3>
                        <hr class="hrs">
                        <p class="vendor-info">Product Sold: 120</p>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- <div class="top-vendor">
            <h2>Top Vendor</h2>
            <div class="vendor-wrapper">
            <div class="card shadow text-center">
                <img src="/storage/{{$v->image}}" class="card" alt="Product Image">
                <div class="card-body">
                    <h3 class="vendor-name">Salama Catering</h3>
                    <hr class="hrs">
                    <p class="vendor-info">Product Sold: 120</p>
                </div>
            </div>
            <div class="card shadow text-center">
                <img src="/storage/{{$v->image}}" class="card" alt="Product Image">
                <div class="card-body">
                    <h3 class="vendor-name">Salama Catering</h3>
                    <hr class="hrs">
                    <p class="vendor-info">Product Sold: 120</p>
                </div>
            </div>
            </div>
        </div> --}}

    </div>
    </main>
  </section>


@endsection
