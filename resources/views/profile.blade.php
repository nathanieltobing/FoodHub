@extends('master')

@section('content')
    @if ($errors->any())
    <div class="container">
        <div class="alert alert-danger">
            <ul>
                <p>Error!</p>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    @if(session('message'))
    <div class="container">
        <div class="d-grid gap-2 mt-3">
            <div class="btn btn-success" type="">{{session('message')}}</div>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="text-center pt-3">
            <div class="my-3">
              @if(!$user->image)
                    <i class="bx bx-user-circle text-center" role="button" aria-expanded="false" style="font-size:10rem"> </i>
                @endif
                @if ($user->image)
                    <img class="rounded-circle border" src="{{url('storage/images/'.$user->image)}}" alt="" style="width: 10rem; height:10rem;">
                @endif
            </div>
            @if ($editMode)
                <a href="/editprofpic/{{$user->id}}" class="btn btn-primary" type="submit" onclick="">Edit profile picture</a>
            @endif
            @if ($editprofpic)
            <form action="/editprofpic/{{$user->id}}" method="POST" class="pt-3 text-center" enctype="multipart/form-data">
                {{method_field('PUT')}}
                @csrf
                <div class="form-group px-5 text-center" style="margin: 0 30%">
                        <input id="image" name="image" type="file" class="form-control" value="">
                </div>
                <div class="mt-3">
                    <a onclick="return confirm('Are you sure?')" href="/removeprofpic/{{$user->id}}" class="btn btn-danger">Remove current</a>
                    <button class="btn btn-primary" type="submit" onclick="">Save new </button>
                </div>
            </form>
            @endif
        </div>
        <hr class="bg-dark">
        @if(Auth::guard('webvendor')->check())
        aaa
        @endif
        @if(!$editMode)
        <form action="/profile/{{$user->id}}" method="POST" class="pb-5 pt-3" enctype="multipart/form-data">
        @csrf
        <div class="px-5" style="margin: 0 10%">
            <h3 class="text-center mb-3">Profile</h3>
            <div class="form-group px-5 my-1 row">
                <label class="col-sm-3 my-1" for="title">Name:</label>
                <div class="col-sm-9">
                    <input id="name" type="text" class="form-control" value="{{ $user->name }}" readonly>
                </div>
            </div>
            @if (Auth::guard('webcustomer')->check())
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">Phone:</label>
                    <div class="col-sm-9">
                        <input id="email" type="text" class="form-control" value="{{ $user->phone }}" placeholder="you haven't set phone number" readonly>
                    </div>
                </div>
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">Date of Birth:</label>
                    <div class="col-sm-9">
                        <input id="email" type="date" class="form-control" value="{{ $user->dob }}" readonly>
                    </div>
                </div>
            @elseif (Auth::guard('webvendor')->check())
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">Description:</label>
                    <div class="col-sm-9">
                        <textarea id="description" name="description" class="form-control" placeholder="you haven't set description" rows="4" readonly>{{ $user->description }}</textarea>
                    </div>
                </div>
            @endif
            <div class="form-group px-5 my-1 row">
                <label class="col-sm-3 my-1" for="title">Email:</label>
                <div class="col-sm-9">
                    <input id="email" type="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
            </div>
            <div class="d-grid gap-2 mt-3 px-5">
                <button class="btn btn-primary" type="submit" onclick="">Edit Profile Information</button>
            </div>
        </div>
        </form>
        @else

        <form action="/editprofile/{{$user->id}}" method="POST" class="pb-5 pt-3" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="px-5" style="margin: 0 10%">
                <h3 class="text-center mb-3">Edit Your Profile</h3>
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">Name:</label>
                    <div class="col-sm-9">
                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>
                @if (Auth::guard('webcustomer')->check())
                    <div class="form-group px-5 my-1 row">
                        <label class="col-sm-3 my-1" for="title">Phone Number:</label>
                        <div class="col-sm-9">
                            <input id="phone" name="phone" type="text" pattern="[0-9]*" inputmode="numeric" class="form-control" value="{{ $user->phone }}" placeholder="you haven't set phone number">
                        </div>
                    </div>
                    <div class="form-group px-5 my-1 row">
                        <label class="col-sm-3 my-1" for="title">Date of Birth:</label>
                        <div class="col-sm-9">
                            <input id="dob" name="dob" type="date" class="form-control" value="{{ $user->dob }}">
                        </div>
                    </div>
                @elseif (Auth::guard('webvendor')->check())
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">Description:</label>
                    <div class="col-sm-9">
                        <textarea id="description" name="description" class="form-control" placeholder="you haven't set description" rows="4">{{ $user->description }}</textarea>
                    </div>
                </div>
                @endif
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">Email:</label>
                    <div class="col-sm-9">
                        <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}">
                    </div>
                </div>
                <div class="form-group px-5 my-1 row">
                    <label class="col-sm-3 my-1" for="title">New Pasword:</label>
                    <div class="col-sm-9">
                        <input id="password" name="password" type="password" class="form-control" value="" placeholder="Leave empty if no changes!">
                    </div>
                </div>
                <div class="row text-center mt-3 justify-content-center px-5">
                    <button class="col-sm-5 btn btn-danger mx-2" type="button" onclick="javascript:history.back()">Cancel</button>
                    <button class="col-sm-5 btn btn-primary mx-2" type="submit" onclick="">Save Changes</button>
                </div>
            </div>
        </form>
        @endif

    </div>

@endsection
