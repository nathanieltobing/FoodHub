@extends('master')

@section('content')


  <section class="content">
    <main>
      {{-- <div class="head-title">
        <div class="left">
          <h1>Dashboard</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <i class="fas fa-chevron-right"></i>
            <li>
              <a href="#" class="active">Home</a>
            </li>
          </ul>
        </div>


      </div> --}}

      <div class="box-info" style="margin-top: 5%; margin-right:3%">
        <li>
            <i class="fas fa-people-group"></i>
            <span class="texts" style="line-height: 1.0;
            margin-bottom: -25px">
              <h3>{{$totalCustomer}}</h3>
              <p>Customers</p>
            </span>
          </li>
        <li>
          <i class="fas fa-people-group"></i>
          <span class="texts" style="line-height: 1.0;
          margin-bottom: -25px">
            <h3>{{$totalVendor}}</h3>
            <p>Vendors</p>
          </span>
        </li>

      </div>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Customers</h3>
            {{-- <i class="fas fa-search"></i>
            <i class="fas fa-filter"></i> --}}
          </div>

          <table>
            <thead>
              <tr>
                <th>User</th>
                <th>Created Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($customers as $c)
                <tr>
                  <td>
                    @if ($c->image !=null)
                      <img src="{{Storage::url($c->image)}}" alt="" />                 
                    @else
                      <i class="bx bx-user-circle text-center mb-2" role="button" aria-expanded="false" style="font-size:2rem"> </i>
                    @endif
                    <p>{{$c->name}}</p>
                  </td>
                  <td>{{\Carbon\Carbon::parse($c->created_at)->format('d-m-Y')}}</td>
                  @if ($c->status == 'ACTIVE')
                  <form action="/deactivate/customer/{{$c->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status complete" style="border:none">Active</button></td>
                  </form>    

              
                  @else
                  <form action="/activate/customer/{{$c->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
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
              <h3>Vendors</h3>
              {{-- <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i> --}}
            </div>

            <table>
              <thead>
                <tr>
                  <th>User</th>
                  <th>Created Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($vendors as $v)
                <tr>
                  <td>
                    <img src="{{Storage::url($v->image)}}" alt="" />
                    <p>{{$v->name}}</p>
                  </td>
                  <td>{{\Carbon\Carbon::parse($v->created_at)->format('d-m-Y')}}</td>
                  @if ($v->status == 'ACTIVE')
                  <form action="/deactivate/vendor/{{$v->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status complete" style="border:none">Active</button></td>
                  </form>    
                  @else
                  <form action="/activate/vendor/{{$v->id}}" method="POST">
                    {{method_field('PUT')}}
                    @csrf
                    {{-- <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button>  --}}
                    <td><button class="status pending" style="border:none;">Inactive</button></td>
                  </form>    
                  @endif
                </tr>     
              @empty

              @endforelse
              </tbody>
            </table>
            <div class = "d-flex justify-content-center mt-4">
              {{$vendors->appends(['customers' => $customers->currentPage()])->links()}}
            </div>  

            {{-- <div class="modal fade" id="deactivateCustomer" tabindex="-1" role="dialog" aria-labelledby="deactivateCustomerModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="deactivateCustomerModalLabel">Are you sure you want to deactivate this user ?</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <form action="/deactivate/customer/{{$c->id}}" method="POST">
                            {{method_field('PUT')}}
                            @csrf
                            <button type="submit" style="border:0; background:none;"><span class="plus">+ </span></i></button> 
                            <td><button class="btn btn-danger">Deactivate</button></td>
                          </form>    
                      </div>
                  </div>
              </div>
            </div> --}}
          </div>
      </div>
    </main>
  </section>


@endsection
