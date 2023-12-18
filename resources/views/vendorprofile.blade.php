@extends('master')

@section('content')
    <div class="container my-5" style="padding-top: 7rem">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <p>Error!</p>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow h-100 ">
                    <div class="card-body text-center">
                        @if(!$user->image)
                            <i class="bx bx-user-circle" style="font-size: 10rem;"></i>
                        @endif
                        @if ($user->image)
                            <img class="rounded-circle border" src="{{Storage::url($user->image)}}" alt="" style="width: 10rem; height:10rem;">
                        @endif
                        <h5 class="my-3">{{$user->name}}</h5>
                        @if ($editMode)
                            <a href="/vendor/editprofpic" class="btn btn-outline-primary mt-3" type="submit" onclick="">Edit profile picture</a>
                        @endif
                        @if ($editprofpic)
                        <form action="/vendor/editprofpic" method="POST" class="pt-3 text-center" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="form-group">
                                <input id="image" name="image" type="file" class="form-control">
                            </div>
                            <div class="mt-3">
                                <a onclick="return confirm('Are you sure?')" href="/vendor/removeprofpic" class="btn btn-outline-danger">Remove current</a>
                                <button class="btn btn-outline-primary" type="submit">Save new</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow h-100">
                    <div class="card-body">
                        @if(!$editMode)
                            <form action="/vendor/profile" method="POST" class="pb-3" enctype="multipart/form-data">

                            <div class="px-5">
                                <h3 class="text-center mb-3">Profile</h3>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0"><strong>Name</strong></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0"><strong>Email</strong></p>
                                        </div>
                                        <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0"><strong>Description</strong></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->description ?: "Not provided" }}</p>
                                        </div>
                                    </div>
                        @else
                            <form action="/vendor/editprofile" method="POST" class="pb-3" enctype="multipart/form-data">
                                {{ method_field('PUT') }}
                            <div class="px-5">
                                <h3 class="text-center mb-3">Edit Your Profile</h3>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="title"><strong> Name</strong></label>
                                    <div class="col-sm-9">
                                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="title"><strong>Email</strong></label>
                                    <div class="col-sm-9">
                                        <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="title">Description:</label>
                                    <div class="col-sm-9">
                                        <textarea id="description" name="description" class="form-control" placeholder="Not provided" rows="4">{{ $user->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="title"><strong>New Pasword</strong></label>
                                    <div class="col-sm-9">
                                        <input id="password" name="password" type="password" class="form-control" value="" placeholder="Leave empty if no changes!">
                                    </div>
                                </div>
                        @endif
                            @csrf
                                <div class="mt-4 px-5">
                                    @if(!$editMode)
                                        <button class="btn-outline-primary form-control" type="submit" onclick="">Edit Profile Information</button>
                                    @else
                                        <div class="row text-center mt-3">
                                            <button class="col-sm-5 btn btn-outline-danger mx-2" type="button" onclick="javascript:history.back()">Cancel</button>
                                            <button class="col-sm-5 btn btn-outline-primary mx-2" type="submit" onclick="">Save Changes</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="card mt-3 shadow col-md-12">
                    <div class="card-body">
                        <div class="px-5">
                            <h3 class="text-center mb-3">Membership</h3>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    @if ($isMember)
                                        <p class="text-center">Your membership expires in {{ \Carbon\Carbon::parse($membership->endPeriod)->format('d M Y') }}</p>
                                        <a href="#" id="membership" class="form-control btn btn-outline-danger" style="text-decoration: none" data-toggle="modal" data-target="#cancelMembershipModal">Cancel member subscription</a>
                                    @else
                                        <p class="text-center">You are not registered as a member</p>
                                        <a href="/registermembership" class="form-control btn btn-outline-success" style="text-decoration: none">Register as a member now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="cancelMembershipModal" tabindex="-1" role="dialog" aria-labelledby="cancelMembershipModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelMembershipModalLabel">Cancel Membership Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to cancel your membership?</p>
                                    <p class="card-text text-danger">You will immediately lost your privelege as member</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="/vendor/cancelmembership" method="post">
                                        @csrf
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Yes, cancel membership</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

