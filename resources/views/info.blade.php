@extends('layouts.main')

@section('title', 'Home')

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">General Info</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">General Info</li>
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
    <div class="row">
        <div class="col-md-6 text-center">
            <h3>Unduh Format Excel</h3>
            <a href="{{ route('download.format') }}" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Unduh</a>
        </div>
        <div class="col-md-6 text-center">
            <h3>Contact Person</h3>
            <a href="https://api.whatsapp.com/send?phone=6281238422099" class="btn btn-primary" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> 0812 3842 2099</a>
        </div>
    </div>
@endsection