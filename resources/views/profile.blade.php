@extends('layouts.main')

@section('title', 'Profile')

@section('content')

    <style>
        input[readonly]
        {
            background-color:transparent!important;
        }
    </style>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-block">
                    <center class="m-t-30"> <img src="{{ $profile['foto'] }}"  width="100" />
                        <h4 class="card-title m-t-10">{{ $profile['nama'] }}</h4>
                        <h6 class="card-subtitle">{{ $profile['nip'] }}</h6>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    {{-- <form class="form-horizontal form-material"> --}}
                    <div class="form-group">
                        <label class="col-md-12">Nama</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control form-control-line" value="{{ $profile['nama'] }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="form-group">
                        <label class="col-md-12">Jabatan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control form-control-line" value="{{ $profile['jabatan'] }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

@endsection

