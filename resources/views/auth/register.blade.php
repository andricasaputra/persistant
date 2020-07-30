@extends('layouts.app')

@section('content')

<style>
    select{
        outline: none;
    }

    .container{
        width: 50%;
        margin-top: 100px;
    }

    @media (max-width: 600px) {
        .container{
            width: 100%;
        }
    }
</style>

<div class="container">
    <div class="col-md-12 wrapper">

        <form class="validate-form" autocomplete="off" method="POST" action="{{ route('register') }}">

             @csrf

             @include('layouts.message')

            <div class="alert alert-success text-left" style="font-weight: 500;">
                <ol>
                    <li>- Email address merupakan email pertanian anda yang digunakan pada ekinerja</li>
                    <li>- Password merupakan kata sandi ada pada ekinerja</li>
                </ol>
            </div>

            <span class="login100-form-title">
                Register
            </span>

            <div class="wrap-input100 validate-input">
                <select name="id" class="input100" required>
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
                <input class="input100" id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Email @pertanian">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Password is required">
                <input class="input100" id="password" type="password" name="password" required placeholder="Password E-kinerja">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Password Confirmation is required">
                <input class="input100" type="password" name="password_confirmation" required  placeholder="Konfirmasi Password E-kinerja">
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
                    Sudah punya akun?
                </span>
                <a class="txt2" href="{{ route('login') }}">
                   Login disini
                </a>
            </div>

            <div class="text-center mt-3">
                <a class="txt2" href="{{ route('login') }}">
                    <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                    Kembali ke login
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
