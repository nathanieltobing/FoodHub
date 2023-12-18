@extends('master')

@section('content')
@php
    use App\Models\Product;
@endphp
<div class="container pt-5" style="margin-top: 3rem">
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
                        @foreach ($o->order_details as $index=>$od)
                        @if ($index == 0)
                        <img class="img-thumbnail ms-2 me-3" src="{{Storage::url(Product::where('id',$od->product_id)->value('product_picture'))}}" alt="" style="width:80px">
                        <div>
                            <ul class="list-unstyled">
                                        <li class="card-text payment-summary-price" style="font-size:18px;font-weight: 700;" >{{ $od->product_name }}</li>
                                        <span style="font-weight : 700;" class="card-text payment-summary-name"> QTY:</span> <span style="margin-left:10px;font-weight : 700;" class="card-text payment-summary-name">x{{ $od->quantity }}</span>
                            </ul>
                            <div class="actionBtn">   
                                <a href="/orderdetail/{{$o->id}}" style="text-decoration: none;"> <button>View Detail</button></a>                             
                               
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-text d-flex flex-column">
                    <span class="payment-summary-price" style="font-size:18px;font-weight: 700;margin-left:8px;margin-top:10px;justify-content-start">Total Belanja</span>
                    <p class="payment-summary-name" style="font-weight : 700;margin-left:8px;justify-content-start">Rp{{number_format($o->total_price,2,",",".")}}</p>
                        @if($o->status == 'ON GOING' && Auth::guard('webcustomer')->check())
                        <div class="d-flex justify-content-end" style="gap:10px;margin-right: 35px;margin-top: -60px">
                            <span ><a href="#" class="btn btn-primary" style="width: 100%;margin-right:80px" data-toggle="modal" data-target="#FinishOrderModal{{$o->id}}">Finish Order</a> </span>
                        </div>
                        <div class="modal fade" id="FinishOrderModal{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="FinishOrderModal{{$o->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelMembershipModalLabel">Give your review!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/addreview/{{$o->id}}">
                                            @csrf
                                            <div class="form-group mt-3">
                                                <label for="rating">Rating:</label>
                                                <select class="form-control" id="rating" name="rating">
                                                    <option value="" disabled selected>Select a rating</option>
                                                    <option value="5">5 stars</option>
                                                    <option value="4">4 stars</option>
                                                    <option value="3">3 stars</option>
                                                    <option value="2">2 stars</option>
                                                    <option value="1">1 star</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="review">Review:</label>
                                                <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit and finish order</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
