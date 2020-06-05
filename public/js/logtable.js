$(document).ready(function() {

    $.extend( true, $.fn.dataTable.defaults, {
      language: {
          "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
          "sProcessing":   "Sedang memproses...",
          "sLengthMenu":   "Tampilkan _MENU_ entri",
          "sZeroRecords":  "Tidak ditemukan data yang sesuai",
          "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
          "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "sInfoPostFix":  "",
          "sSearch":       "Cari:",
          "sUrl":          "",
          "oPaginate": {
            "sFirst":    "Pertama",
            "sPrevious": "Sebelumnya",
            "sNext":     "Selanjutnya",
            "sLast":     "Terakhir"
          }
      }
    });

    let nip = $('a#profileNav').data('src');

    let bulan = '';

    let tahun = '';

    let key = '';

    const proxy = 'https://cors-anywhere.herokuapp.com/';

    const baseUrl = 'http://ekinerja.pertanian.go.id/epersonalv2/';

    const logUrl = baseUrl + 'ekinerjav2/mlog/';

    const docUrl = 'http://ekinerja.pertanian.go.id/epersonalv2/' + 'doc/log/';

    const sptUrl = 'http://ekinerja.pertanian.go.id/epersonalv2/' + 'doc/log/spt/';

    const secureUrl = proxy + baseUrl;

    let logApiUrl = secureUrl + `ekinerjav2/mlog/index_json.php?nip=${nip}&bulan=${bulan}&tahun=${tahun}&key=${key}`;

    function logTable(url)
    {
        $('#log').DataTable( { 
            "responsive": true,
            "fixedHeader": true,
            "paging" : true,
            "searching": true,
            "ordering": false,
            "processing": true,
            "serverSide": true,
            "ajax": url,     
            "columns": [
                {"data":"id_log", orderable: false},
                {"data":"bulan"},
                {"data":"waktu"},
                {"data":"kuantitas"},
                {"data":"nilaikuantitas"},
                {"data":"subkegiatan"},
                {"data":"kegiatan"},
                {"data":"output"},
                {
                  "data": "spt", 
                  "defaultContent": ""
                },
                {"data":"lampiran"},
                {"data":"logs"},
            ],
            "columnDefs": [ 
                { targets : [1],
                  render : function (data, type, row) { 
                    if (row['tahun']!='' && row['bulan']!='' && row['tgl']!='') {
                    var html = tglIndo(row['tahun'],row['bulan'],row['tgl']);
                    } else {
                    var html = '-';
                    }
                    return html;
                  }
                },
                { targets : [2],
                  render : function (data, type, row) { 
                    var html = row['waktu']+'<br>'+row['waktu_sd'];
                    return html;
                  }
                },
                { targets : [4],
                  render : function (data, type, row) { 
                    if (row['is_dinilai']) {
                        var html = row['nilaikuantitas'];
                    } else {
                        var html = '-';
                    }
                    return html;
                  }
                },
                { targets : [8],
                  render : function (data, type, row) { 
                    // console.log(row['spt'])
                    if (row['spt'] != '') {

                        var html = `<a href="${sptUrl}${row['spt']}" target="_blank"><img src='images/cek.jpg' border='0' width='20' height='20'></a>`;

                    } else if(row['name'] !='') {

                        var html = `<center><a href="${sptUrl}${row['id_log']}" target="_blank"><img src='images/cek.jpg' border='0' width='20' height='20'></a></center>`;
                    }

                    return html;
                  } 
                },
                { targets : [9],
                  render : function (data, type, row) { 
                    if(row['lampiran'] == "") {

                        var html = "";

                    } else if(row['lampiran'] !== "") {

                        var html = `<center><a href="${docUrl}${row['lampiran']}" target="_blank"><img src='images/cek.jpg' border='0' width='20' height='20'></a></center>`;
                    }

                    return html;
                  }
                },
                { targets : [10],
                  render : function (data, type, row) { 
                    return `<div style="width: 80px;">
                        
                        <a class="btn btn-xs btn-danger btn-flat" id="deleteLog"
                        href="#" data-href="${proxy}${logUrl}QryDelLog.php?il=${row['id_log']}&d=${row['lampiran']}&skpbulan=${row['id']}"
                        >
                            <i class="fa fa-remove"></i>
                        </a>
                    </div>`
                    
                  }
                }
            ],
            dom: 'lBrtip',
            buttons: [
                'print'
            ]
        });

    }

    /*<a id="editLog" class="btn btn-xs btn-primary btn-flat" href="#" data-href="${proxy}${logUrl}FormEditLog2.php?il=${row['id_log']}">
                            <span class="fa fa-edit fa-fw"></span>Edit
                        </a>*/

    logTable(logApiUrl);

    $('#searchLog').on('submit', function(e){

        e.preventDefault();

        key = $('input[name="key"]').val();

        tahun = $('select[name="tahun"]').val();

        bulan = $('select[name="bln"]').val();

        let nip = $('input[name="nip"]').val();

        logApiUrl = secureUrl + `ekinerjav2/mlog/index_json.php?nip=${nip}&bulan=${bulan}&tahun=${tahun}&key=${key}&txtNipDari=${nip}`;

        $('#log').DataTable().destroy();

        logTable(logApiUrl);
    });

    $('#cetakAktivitas').click(function(){

        $(this).attr("href", proxy + logUrl + '?cetakLogPekerjaan.php?nip=' + nip);

    });

    // $('#log').on('click', 'tbody td:not(:first-child)', function () {
    //   var row = this.closest('tr');     //get the clicked row

    //   console.log(row)
    // });

    // Update Log
    $('#log').on('click', 'a#editLog', function(e){

        e.preventDefault();

        // $('#modalEdit').modal('show');

        nip = "199401102014031001";
        id = "6";
        year = "2019";
        tanggal = '06-09-2019';

        $.ajax({
            url : proxy + logUrl + "getSkpBulan.php",
            data: {"tanggal": tanggal,"nip": nip},
            type: "GET",
            success: function(data){
               console.log(data)
            }
        });

    });

   // Delete Log
    $('#log').on('click', 'a#deleteLog', function(e){

        if (! confirm('Apakah Anda Yakin Ingin Menghapus data ini?')){

            e.stopPropagation(); 

            return; 
        }

        e.preventDefault();

        let url = $(this).data('href');

        $.get(url, function(data, status){

            $('#log').DataTable().destroy();

            logTable(logApiUrl);

        });

    });

    $('.buttons-print > span').remove();

    $('.buttons-print').html('<span><i class="fa fa-print"></i> Cetak Aktivitas Harian</span>');

    function tglIndo(tahuns,bulans,tgls) {
        let hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        let bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        let gettgl = new Date(tahuns,bulans-Number(1),tgls);
        let tanggal = gettgl.getDate();
        let xhari = gettgl.getDay();
        let xbulan = gettgl.getMonth();
        let xtahun = gettgl.getYear();
        hari = hari[xhari];
        bulan = bulan[xbulan];
        let tahun = (xtahun < 1000) ? xtahun + 1900 : xtahun;
        let html = (hari +', ' + tanggal + ' ' + bulan + ' ' + tahun);
        return html;
    }

});/*End Ready*/