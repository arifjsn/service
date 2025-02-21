@extends('templates.main-global')

@section('title')
Set Up New Password
@endsection

@section('body')
<div class="login-box">

    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <img src="{{ asset('dist/img/logo-jasanet.png') }}" alt="logo" height="70">
        </div>
        <div class="card-body">

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form action="{{ route('new_password_submit') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control" value="{{ request()->segment(3) }}" readonly>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="text-danger ml-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-6">
                        <button type="submit" class="btn btn-success btn-block">Change Password</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                Password minimal 8 karakter, 1 huruf kapital, 1 karakter unik, dan angka.
            </p>
        </div>

    </div>

</div>

@endsection