@extends('layouts.main')

@section('title', 'Upload')

@section('links')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Upload</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Tambah Aktivitas Harian</li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <a href="{{ route('info') }}" class="btn pull-right hidden-sm-down btn-success">Unduh Format Excel Disini</a>
    </div>
</div>

@endsection

@section('content')
    
    <style>
        label{
            font-weight: bold !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-8 col-xlg-9 col-md-7 mx-auto">
            <div class="card">
                <div class="card-block">
                     <form enctype='multipart/form-data' action="{{ route('create') }}" method="post" class="form-horizontal form-material">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12 m-b-30">Pilih Bulan</label>
                            <input type="text" class="form-control tgl-aktivitas" name="tanggal" onchange="getTugasBulan(this.value)">
                        </div>
                        <div class="form-group">
                            <div id="loader"></div>
                            <label class="col-md-12 m-b-30">Pilih Butir Kegiatan</label>
                            <select name="tj[tj_tb_id]" class="form-control select2" id="field-tugas-bulan" style="width: 100%">
                                <option value="">-- Pilih bulan terlebih dahulu --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 m-b-30">Pilih File</label>
                            <div class="col-md-12">
                                <input type="file" name="filenya" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success"><b>Upload</b></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra_script')

<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

<script>

    const baseUrl = '{{ config('e-persistant.uri.log') }}';

    const proxy = '{{ config('e-persistant.uri.proxy') }}';

    function getTugasBulan(tanggal) {
      $.ajax({
            url: `${proxy}${baseUrl}/ajaxGetTugasBulan?nip=`+ '{{ auth()->user()->nip_hashed }}',
            type: "POST",
            data: {tanggal},
            beforeSend : function(){
              $('#field-tugas-bulan').html('<option><i class="fa fa-spin fa-spinner"></i> Loading...</option>');
            },
            success: function(response) {
              res = JSON.parse(response);
              $('#field-tugas-bulan').html(res.tugasbulan);
            },
        });
    }

    $('.tgl-aktivitas').datepicker({
        autoclose: true,
        format:'yyyy-mm-dd'
    });
</script>

@endsection
