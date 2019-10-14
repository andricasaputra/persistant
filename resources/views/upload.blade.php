@extends('layouts.main')

@section('title', 'Upload')

@section('breadcrumb')

<div class="row page-titles">
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Upload</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Tambah Aktivitas Harian</li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <button class="btn pull-right hidden-sm-down btn-success">
            Tipe file harus berupa excel
        </button>
    </div>
</div>

@endsection

@section('content')
    
    <style>
        label{
            font-weight: bold!important;
        }
    </style>

    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7 mx-auto">
            <div class="card">
                <div class="card-block">
                     <form enctype='multipart/form-data' action="{{ route('create') }}" method="post" class="form-horizontal form-material">
                        @csrf
                        <div class="form-group">
                            <label class="col-md-12 m-b-30">Tanggal (Butir Kegiatan Pada Bulan Tertentu)</label>
                            <input type="date" class="form-control" name="bulan" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 m-b-30">Pilih Butir Kegiatan</label>
                            <select id="butir_kegiatan" class="form-control" name="butir_kegiatan" style="width:auto;">
                                <option value="-">Pilih Butir</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <div id="detail_nilai" class="form-group form-inline col-md-12"></div>
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
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
@endsection

@section('extra_script')

<script>

    const baseUrl = 'http://ekinerja.pertanian.go.id/epersonalv2/ekinerjav2/mlog/';

    const skpBulanUrl = baseUrl + 'getSkpBulan.php';

    const kuantitasUrl = baseUrl + 'getKuantitas.php';

    const proxy = 'https://cors-anywhere.herokuapp.com/';

    let nip = $('a#profileNav').data('src');

    let tanggal = $('input[name="bulan"]');

    function getSkpBulanNew(tanggal) {

        $.ajax({
            url: proxy + skpBulanUrl,
            data: {"tanggal": tanggal,"nip": nip},
            type: "GET",
            success: function(data){
                $('#butir_kegiatan').empty();
                
                $('#butir_kegiatan').html(data);
            }
        });

    }

    getSkpBulanNew(tanggal.val());

    // Panggil butir kergiatan sesuai tanggal yang dipilih
    $(tanggal).on('change', function(){

        getSkpBulanNew($(this).val());

    });

    // Panggil kuantitas sesuai butir kegiatan yang dipilih
    $('#butir_kegiatan').on('change', function(){

        let id = $(this).val();

        $('#detail_nilai')
        .html('<div style="margin: auto"><i class="fa fa-spin fa-spinner"></i></div>')
        .load(proxy + kuantitasUrl + '?id=' + id);

    });

</script>

@endsection
