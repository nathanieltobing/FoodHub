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
                            <ul class="list-unstyled">
                                @foreach ($o->order_details as $index=>$od)
                                    @if ($index == 0)
                                        <li class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;" >{{ $od->product_name }}</li>
                                        <span style="font-weight : 700;" class="card-text payment-summary-name"> QTY:</span> <span style="margin-left:10px;font-weight : 700;" class="card-text payment-summary-name">x{{ $od->quantity }}</span>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-text d-flex flex-column">
                    <span class="payment-summary-price" style="font-size:18px;font-weight: 700;margin-left:8px;margin-top:10px;justify-content-start">Total Belanja</span>
                    <p class="payment-summary-name" style="font-weight : 700;margin-left:8px;justify-content-start">Rp{{number_format($o->total_price)}}</p>
                        @if($o->status == 'ON GOING' && Auth::guard('webcustomer')->check())
                        <div class="d-flex justify-content-end" style="gap:10px;margin-right: 35px;margin-top: -60px">
                            <span ><a href="/finishorder/{{$o->id}}" class="btn btn-danger" style="width: 100%;margin-right:80px">Finish Order</a> </span>
                        </div>
                        @elseif($o->status == 'OPEN' && Auth::guard('webvendor')->check())
                        <form class="d-flex justify-content-end" method="post" action="/editstatus/{{$o->id}}" style="gap:10px;margin-right: 35px;margin-top: -60px">
                        @csrf
                            <button type="submit" class="btn btn-danger"value="2" name="status" id="status" style="width: 6rem;">Reject</button>
                            <button type="submit" class="btn btn-success" value="1" name="status" id="status" style="width: 6rem;">Accept</button>
                        </form>
                        @endif
                </div>
              </div>
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
