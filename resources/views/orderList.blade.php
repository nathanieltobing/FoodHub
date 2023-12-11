@extends('master')

@section('content')
<div class="container">
    @if(session('message'))
    <div class="container">
        <div class="d-grid gap-2 mt-3">
            <div class="btn btn-success" type="">{{session('message')}}</div>
        </div>
    </div>
    @endif
    <div class="p-5" style="background-color: #black">
    <h1>Order List</h1>
    <hr>
    <br>
      @foreach ($order as $key => $o)
      <div class="d-flex justify-content-around align-items-center">
          <div class="col-8">
              <div class="card card-body">
                <div class="card-title d-flex pb-1">
                    <h3 class="">{{ \Carbon\Carbon::parse($o->treansactionDate)->format('d M Y')}}</h3>
                    <p class="{{$o->status=='OPEN'? ''
                        : ($o->status=='ON GOING'? 'btn-warning'
                        : ($o->status=='REJECTED'? 'btn-danger'
                        : 'btn-success'))}} mx-3 btn active">{{$o->status}}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="img-thumbnail ms-2 me-3" src="{{url('storage/images/book1.jpg')}}" alt="" style="width:100px">
                        <div>
                            <h3 class="">Order #{{$o->id}}</h3>
                            <h5 class="card-text mx-1">{{$o->vendors->name}}</h5>
                            <ul class="list-unstyled">
                                @foreach ($o->order_details as $od)
                                    <li class="card-text">- {{ $od->product_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="div mx-5">
                        <p class="card-text">Total <br> Rp{{number_format($o->total_price)}}</p>
                        @if(in_array($o->status, ['OPEN', 'ON GOING']))
                            <a href="/finishorder/{{$o->id}}" class="btn btn-primary text-light">Finish Order</a>
                        @endif
                    </div>
                  </div>
              </div>
          </div>
          <div class="col-3">
            @if (Auth::guard('webvendor')->check())
                @if ($o->status == "OPEN")
                <form class="d-flex" method="post" action="/editstatus/{{$o->id}}">
                @csrf
                <div class="col-3">
                    <button type="submit" class="btn btn-success m-3 fs-5" value="1" name="status" id="status">Accept</button>
                    <button type="submit" class="btn btn-danger m-3 fs-5"value="2" name="status" id="status">Decline</button>
                </div>
                </form>
                @endif
            @endif
        </div>
       </div>
       <br>
      @endforeach
    </div>
</div>

@endsection
