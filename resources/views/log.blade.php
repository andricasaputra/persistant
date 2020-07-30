@extends('layouts.main')

@section('title', 'Log Aktifitas Harian')

@section('content')

<style>
    table tbody tr td{
        color: #000;
        font-weight: 400;
        font-size: 13px;
    }

    table thead tr th{
        font-size: 12px;
    }

    table.dataTable thead th, table.dataTable thead td {
        padding: 5px;
    }

    table.dataTable thead tr th{
        text-align: center;
    }
</style>

    <div class="row">
        <div class="col-md-3 mb-4">
            <input type="hidden" value="{{ $profile['nip'] }}" name="nip">
            <div class="form-group mr-2">
                <label for="bln" class="font-weight-bold">Bulan</label>
                <select name="bln" class="form-control">
                    <option value="all">--Semua Bulan--</option>
                    <option value=1>Januari</option>
                    <option value=2>Februari</option>
                    <option value=3>Maret</option>
                    <option value=4>April</option>
                    <option value=5>Mei</option>
                    <option value=6>Juni</option>
                    <option value=7>Juli</option>
                    <option value=8>Agustus</option>
                    <option value=9>September</option>
                    <option value=10>Oktober</option>
                    <option value=11>November</option>
                    <option value=12>Desember</option>
                </select>  
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <table class="table table-bordered table-thead-center" id="mytable" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Target</th>
                        <th>Pengajuan</th>
                        <th>Tugas Bulan</th>
                        <th>Deskripsi</th>
                        <th>Output</th>
                        <th>Output Bulanan</th>
                        <th>Output harian</th>
                        <th>File Laporan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

@endsection

@section('extra_script')

    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    
    <script>

        const baseUrl = '{{ config('e-persistant.uri.log') }}';

        const proxy = '{{ config('e-persistant.uri.proxy') }}';

    </script>

    <script src="{{ asset('js/logtable.js') }}"></script>

@endsection

