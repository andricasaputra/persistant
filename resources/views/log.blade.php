@extends('layouts.main')

@section('title', 'Log Aktifitas Harian')

@section('content')

<style>
    input[readonly]
    {
        background-color:transparent!important;
    }

    table tbody tr td{
        color: #000;
        font-weight: 400;
    }
    .form-group{
        padding-right: 1%
    }

    .dt-buttons{
        float: right;
    }
    .dt-buttons > .buttons-print {
        display: inline-block;
        font-weight: 400;
        line-height: 1.25;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        background: #7460ee;
        border: 1px solid #7460ee;
        padding: 5px 10px;
    }
</style>


    <div class="row">
        {{-- <div class="col-md-6">
            <div class="form-group" >
                <a id="cetakAktivitas" data-src="{{ $profile['nip'] }}" target="_blank">
                    <button type="button" class="btn btn-default" >Cetak Aktivitas Harian <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                </a>
            </div>
        </div> --}}

        <div class="col-md-6 offset-md-6">
            <form class="form-inline" id="searchLog">
                <input type="hidden" value="{{ $profile['nip'] }}" name="nip">

                <div class="form-group">
                    <select name="bln" class="form-control">
                        <option value="">--Semua Bulan--</option>
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

                <div class="form-group"> 
                    <select name="tahun" class="form-control">
                        @for($i = date('Y') - 3; $i < date('Y') + 2 ; $i++)

                          @if($i == date('Y'))

                            <option value="{{ $i }}" selected>{{ $i }}</option>

                          @else

                            <option value="{{ $i }}">{{ $i }}</option>

                          @endif

                        @endfor
                    </select>                               
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="key" placeholder="Cari SKP Bulan, Kegiatan, Output" value="">
                </div>

                <div class="form-group">
                    <button class="btn btn-success" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <table id="log" class="table table-dark table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th><div style="width: 100px;">SKP Bulan</div></th>
                                <th>Kegiatan</th>
                                <th>Output</th>
                                <th>File SPT</th>
                                <th>File Laporan</th>
                                <th>Action</th>
                            </tr>   
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

@endsection

@section('extra_script')

    <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('js/buttons.print.min.js') }}"></script>
    
    <script src="{{ asset('js/logtable.js') }}"></script>

@endsection

