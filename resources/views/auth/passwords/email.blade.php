@extends('layouts.app')

@section('content')

<div class="container-login100">
    <div class="wrap-login100">

        <form class="validate-form" method="POST" action="{{ route('password.email') }}" style="width: 100%; margin: auto;">

             @csrf

             @include('layouts.message')

              @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
             @endif

            <span class="login100-form-title">
                Reset Password
            </span>

            <div class="wrap-input100 validate-input">
                <input class="input100" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="Email Address" autocomplete="none" required>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>

             <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                     {{ __('Send Password Reset Link') }}
                </button>
            </div>

            <div class="text-center p-t-136">
                <a class="txt2" href="{{ route('login') }}">
                    <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                    Back to login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
