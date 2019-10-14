@extends('layouts.app')

@section('content')

<div class="container-login100">
    <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
            <img src="{{ asset('auth/images/img-01.png') }}" alt="IMG">
        </div>

        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">

            @csrf

            @include('layouts.message')

            <span class="login100-form-title">
                Member Login
            </span>

            <div class="wrap-input100 validate-input">
                <input class="input100" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required  autofocus placeholder="Username">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                <input class="input100" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>
            
            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>

            <div class="text-center p-t-12">
                <span class="txt1">
                    Forgot
                </span>
                <a class="txt2" href="{{ route('password.request') }}">
                    Username / Password?
                </a>
            </div>

            <div class="text-center p-t-136">
                <a class="txt2" href="{{ route('register') }}">
                    Create your Account
                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
