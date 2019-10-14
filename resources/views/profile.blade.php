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
                        <h6 class="card-subtitle">{{ $profile['unit_kerja'] }}</h6>
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
                        <div class="form-group">
                            <label class="col-md-12">Tempat/Tanggal Lahir</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['tempat/tanggal_lahir'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Pendidikan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['pendidikan'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Masa Kerja Golongan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['masa_kerja_golongan'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jabatan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['jabatan'] }}" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Alamat</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['alamat'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['no._hp'] }}" readonly>
                            </div>
                        </div>
                       {{--  <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div> --}}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-6 col-xlg-6 col-md-6">
            <div class="card">
                <div class="card-block">
                    {{-- <form class="form-horizontal form-material"> --}}
                        <div class="form-group">
                            <label class="col-md-12">NIP</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['nip'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Agama</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['agama'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Pangkat/Golongan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['pangkat/golongan'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Angka Kredit</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['angka_kredit'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Unit Kerja</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['unit_kerja'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" class="form-control form-control-line" value="{{ $profile['email'] }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" value="{{ $profile['no._hp'] }}" readonly>
                            </div>
                        </div>
                       {{--  <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div> --}}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

@endsection

