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
      @if ($order != null)
      @foreach ($order as $key => $o)
      <div class="d-flex justify-content-around align-items-center">
          <div class="col-10" >
              <div class="card card-body"style=" border-radius: 15px; box-shadow: 0px 8px 15px #4F68C41A;">

                <div class="card-title d-flex pb-1">
                    <i style="font-size:30px; margin-top:20px;margin-right:20px;margin-left:9px" class="fa">&#xf290;</i>
                    <div class="" style="margin-top:10px">
                        <p class="payment-summary-price justify-content-start" style="font-size:18px;font-weight: 700;margin-bottom:0;"> Belanja</p>
                        <p class="payment-summary-name justify-content-start">{{ \Carbon\Carbon::parse($o->treansactionDate)->format('d M Y')}}</p>
                    </div>

                    {{-- <span style="justify-content: end" class="{{$o->status=='OPEN'? ''
                        : ($o->status=='ON GOING'? 'btn-warning'
                        : ($o->status=='REJECTED'? 'btn-danger'
                        : 'btn-success'))}} mx-3 btn active">{{$o->status}}</span> --}}
                </div>

                <div class="d-flex justify-content-end" style="gap:10px;margin-right: 20px;margin-top: -70px">
                    <span style="justify-content: end" class="{{$o->status=='OPEN'? ''
                        : ($o->status=='ON GOING'? 'btn-warning'
                        : ($o->status=='REJECTED'? 'btn-danger'
                        : 'btn-success'))}} mx-3 btn active">{{$o->status}}</span>

                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img class="img-thumbnail ms-2 me-3" src="{{url('storage/images/book1.jpg')}}" alt="" style="width:80px">
                        <div>
                            {{-- <h3 class="">Order #{{$o->id}}</h3> --}}
                            {{-- <h5 class="card-text mx-1">{{$o->vendors->name}}</h5> --}}
                            <ul class="list-unstyled">
                                @foreach ($o->order_details as $od)

               

                                    <li class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;" >- {{ $od->product_name }}</li>
                                    <span style="margin-left:10px;font-weight : 700;" class="card-text payment-summary-name"> QTY:</span> <span style="margin-left:10px;font-weight : 700;" class="card-text payment-summary-name"> x2 </span>

                                @endforeach
                            </ul>
                            <div class="actionBtn">
                                <button>View Detail</button>
                            </div>
                        </div>

                    </div>
                    <div class="div mx-5 d-flex flex-column justify-content-end">
                        {{-- <div class="card-text d-flex flex-column justify-content-start">
                            <p class="" style="font-weight: 700;">Total</p>
                            <p class="" style="font-weight : 700">Rp{{number_format($o->total_price)}}</p>
                        </div> --}}
                        {{-- <p class="card-text d-flex justify-content-end" style="font-weight: 700">Total</p>
                        <p class="card-text d-flex justify-content-end" style="margin-top: -7%; font-weight : 700">Rp{{number_format($o->total_price)}}</p> --}}
                        {{-- @if(in_array($o->status, ['ON GOING']))
                        <div class="d-flex" style="gap:10px;">
                            <span ><a href="/finishorder/{{$o->id}}" class="btn btn-primary text-light">Finish Order</a> </span>
                            <span ><a href="/finishorder/{{$o->id}}" class="btn btn-primary text-light">Finish Order</a> </span>
                        </div>
                        @endif --}}
                    </div>


                </div>
                    <div class="card-text d-flex flex-column">
                        <span class="payment-summary-price" style="font-size:18px;font-weight: 700;margin-left:8px;margin-top:10px;justify-content-start">Total Belanja</span>
                        <p class="payment-summary-name" style="font-weight : 700;margin-left:8px;justify-content-start">Rp{{number_format($o->total_price)}}</p>
                        @if(in_array($o->status, ['ON GOING']))
                        <div class="d-flex justify-content-end" style="gap:10px;margin-right: 35px;margin-top: -60px">
                            <span ><a href="/finishorder/{{$o->id}}" class="btn btn-danger" style="width: 100%;margin-right:80px">Finish Order</a> </span>
                            {{-- <span ><a href="/finishorder/{{$o->id}}" class="btn btn-success" style="width: 100%;margin-right:80px">Accept</a> </span> --}}
                            {{-- <span ><a href="/finishorder/{{$o->id}}" class="btn btn-danger" style="width: 200%">Reject</a> </span> --}}
                        </div>
                        @endif
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
      @else
        <p>You have no orders yet!</p>
      @endif
    </div>
</div>

@endsection
