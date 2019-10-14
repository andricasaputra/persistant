@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <button class="btn pull-right hidden-sm-down btn-success">
            Paket {{ ucwords($package->name) }} <br>
            {{ $package->name == 'expired' ? '' : 'Berlaku Sampai ' . $package->valid_until }}
        </button>
    </div>
</div>

@endsection

@section('content')
    Selamat Datang {{ $profile['nama'] }}
@endsection