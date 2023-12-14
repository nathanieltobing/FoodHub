@extends('master')

@section('content')
<div class="container my-5" style="padding-top: 7rem">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Membership Cancellation</h3>

            <p class="card-text">Are you sure you want to cancel your membership?</p>
            <p class="card-text text-danger">You will immediately lost your privelege as member</p>

            @if (Auth::guard('webcustomer')->check())
                <form action="/customer/cancelmembership" method="post">
                    @csrf
                    <a href="customer/profile" class="btn btn-primary">Back to profile</a>
                    <button type="submit" class="btn btn-danger">Yes, cancel membership</button>
                </form>
            @elseif (Auth::guard('webvendor')->check())
                <form action="/vendor/cancelmembership" method="post">
                    @csrf
                    <a href="vendor/profile" class="btn btn-primary">Back to profile</a>
                    <button type="submit" class="btn btn-danger">Yes, cancel membership</button>
                </form>
            @endif

        </div>
    </div>
</div>
@endsection
