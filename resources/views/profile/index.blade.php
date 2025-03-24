@extends('templates.main')

@section('title')
Profile
@endsection

@section('body')

<div class="card-body">

    <div class="row ">

        <div class="container-fluid mb-3">
            @if (session('error'))
            <span class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </span>
            @endif

            @if (session('success'))
            <span class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </span>
            @endif
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4">

                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center fw-bold">Profile</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Name</b> <a class="float-right text-body">{{ $user->name ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right text-body">{{ $user->email ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right text-body">{{ $user->address ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Contact</b> <a class="float-right text-body">{{ $user->phone_number ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Roles</b><a class="float-right text-body">{{ $user->roles->pluck('name')->join(', ') ?? '-' }}</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card card-success card-outline">
                        <div class="card-header p-2">
                            <h3 class="profile-username text-center fw-bold">Edit</h3>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="settings">
                                    <form method="POST" action="{{ route('profile.update') }}" class="form-horizontal">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                                                @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $user->phone_number }}">
                                                @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection