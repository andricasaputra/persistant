@extends('layouts.app')

@section('content')

<style>
    select{
        outline: none;
    }
</style>

<div class="container-login100">
    <div class="wrap-login100 text-center">

        <form class="validate-form" autocomplete="off" method="POST" action="{{ route('register') }}" style="margin: auto; width: 100%; margin-left: 6%">

             @csrf

             @include('layouts.message')

            <span class="login100-form-title">
                Register
            </span>

            <div class="wrap-input100 validate-input">
                <select name="package" class="input100" required>
                    <option value="" disabled selected>-Pilih Paket-</option>
                    @foreach($packages as $package)
                        @if($package->name == 'trial')
                            <option value="{{ $package->id }}">{{ ucwords($package->name) }} - Gratis masa percobaan selama 2 bulan</option>
                        @elseif($package->name == 'tahunan')
                            <option value="{{ $package->id }}">{{ ucwords($package->name) }} - {{ rp($package->price) }} (diskon 20%)</option>
                        @else
                            <option value="{{ $package->id }}">{{ ucwords($package->name) }} - {{ rp($package->price) }}</option>
                        @endif
                        
                    @endforeach
                </select>
                <span class="symbol-input100">
                    <i class="fa fa-gift" aria-hidden="true"></i>
                </span>
            </div>


            <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                <input class="input100" id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                <input class="input100" id="password" type="password" name="password" required placeholder="Password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Password Confirmation is required">
                <input class="input100" type="password" name="password_confirmation" required  placeholder="Password Confirmation">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>
            
            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Register
                </button>
            </div>

            <div class="text-center p-t-12">
                <span class="txt1">
                    Already have account?
                </span>
                <a class="txt2" href="{{ route('login') }}">
                   Login
                </a>
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
