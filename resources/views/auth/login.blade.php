@extends('layouts.app')

@section('content')

<style>
    .wrap-login100 {
        padding: 0;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container-login100">
    <div class="wrap-login100">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">

            @csrf

            @include('layouts.message')

            <div class="alert alert-success text-center" style="font-weight: 500; margin-top: 5%">
                <b><a href="{{ route('register') }}">klik disini untuk registrasi</a></b>
            </div>

            <span class="login100-form-title">
                Epersonal Asistant Member Login
            </span>

            <div class="wrap-input100 validate-input">
                <input class="input100" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required  autofocus placeholder="Username Atau Email">
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
                <a class="txt2" href="{{ route('register') }}">
                    Register disini
                    <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
