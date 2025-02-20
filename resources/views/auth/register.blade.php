@extends('templates.main-global')

@section('title')
Register
@endsection

@section('body')
<div class="login-box">

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <img src="{{ asset('dist/img/winkey.png') }}" alt="logo" height="100">
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new account</p>
            <form action="{{ route('register_submit') }}" method="post">
                @csrf
                <div class="input-group mb-2">
                    <input type="text" name="name" class="form-control" placeholder="Full name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    @error('name')
                    <span class="text-danger ml-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-2">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    @error('email')
                    <span class="text-danger ml-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    @error('password')
                    <span class="text-danger ml-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-2">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    @error('confirm_password')
                    <span class="text-danger ml-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>

                </div>
            </form>


            <p class="mb-0">
                <a href="{{ route('login') }}" class="text-center">I already have an account</a>
            </p>
            <p>
                <span class="text-danger">*</span> The password must be at least 8 characters, one uppercase letter with numbers and one symbol. 
            </p>
        </div>

    </div>
</div>

@endsection