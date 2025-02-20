@extends('templates.main-global')

@section('title')
Forgot Password
@endsection

@section('body')
<div class="login-box">

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <img src="{{ asset('dist/img/winkey.png') }}" alt="logo" height="100">
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

            <form action="{{ route('forgot_password_submit') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-user"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="text-danger ml-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('login') }}">Login</a>
            </p>
        </div>

    </div>

</div>

@endsection