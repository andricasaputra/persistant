function fetchDatatableUrl(bulan = new Date().getMonth() + 1){
    const nip = $('input[name=nip]').val();
    return proxy + baseUrl + `/jsonTugasJabatan?bulan=${bulan}&nip=${nip}`;
}

$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
    };
};

function loadtable(url) {

    var t = $("#mytable").dataTable({
      initComplete: function() {
          var api = this.api();
          $('#mytable_filter input')
                  .off('.DT')
                  .on('keyup.DT', function(e) {
                      if (e.keyCode == 13) {
                          api.search(this.value).draw();
              }
          });
      },
      oLanguage: {
          sProcessing: "loading..."
      },
      destroy: true,
      processing: true,
      serverSide: true,
      ajax: {
        "url": url, 
        "type": "POST"
      },
      columns: [
          {"data": "id","orderable": false},
          {"data": "tj_tanggal"},
          {"data": "tj_jam_dari"},
          {"data": "tb_kuantitas"},
          {"data": "tj_realisasi"},
          {"data": "tb_tt_tugasjabatan"},
          {"data": "tj_deskripsi"},
          {"data": "tj_output"},
          {"data": "tj_file_laporan"},
          {"data": "tj_file_laporan_harian"},
          {"data": "tj_created_at"},
          {"data": "id"},
      ],
      order: [[1, 'desc']],
      // scrollX: true, 
      columnDefs : [ 
          { targets : [1],
            render : function (data, type, row, meta) {
                  var htmls = timeIndonesia(row['tj_tanggal']);
                  return htmls;
              }
          },
          { targets : [2],
            render : function (data, type, row, meta) {
                var htmls = row['tj_jam_dari']+' s/d '+row['tj_jam_sampai'];
                htmls += '<div style="display:none;">'+row['tj_loc_address']+'</div>';
                return htmls;
              }
          },
          { targets : [8],
            render : function (data, type, row, meta) {
                var htmls = '';
                if (row['tj_file_laporan']=='' || row['tj_file_laporan']==null) {
                  htmls = '<center>-</center>';
                } else {
                  htmls = '<center><a href="http://epersonal.pertanian.go.id/'+row['tj_file_laporan']+'" data-toggle="tooltip" title="Download" target="_blank"><i class="fa fa-check text-success"></i></a></center>';
                }
                return htmls;
              }
          },
          { targets : [9],
            render : function (data, type, row, meta) {
                var htmls = '';
                if (row['tj_file_laporan_harian']=='' || row['tj_file_laporan_harian']==null) {
                  htmls = '<center>-</center>';
                } else {
                  htmls = '<center><a href="http://epersonal.pertanian.go.id/'+row['tj_file_laporan_harian']+'" data-toggle="tooltip" title="Download" target="_blank"><i class="fa fa-check text-success"></i></a></center>';
                }
                return htmls;
              }
          },
          { targets : [10],
            render : function (data, type, row, meta) {
              if (row['tj_isdirumah']=='YA') {
                var kerjadirumah = 'Ya';
              } else {
                var kerjadirumah = 'Tidak';
              }
                var htmls = '<span style="white-space:nowrap;">Waktu input : '+row['tj_created_at']+'</span><br>';
                // htmls += 'Kerja Dirumah : '+kerjadirumah+'<br>';
                htmls += 'Jenis Penjadwalan Kerja : '+row['tj_jenispenjadwalankerja']+'<br>';
                // if (row['tj_isdirumah']=='YA') {
                //   htmls += 'Swafoto : <a href="http://epersonal.pertanian.go.id/'+row['tj_swafoto']+'" data-toggle="tooltip" title="Swafoto" target="_blank"><i class="fa fa-eye"></i> Lihat</a>';
                // }
                return htmls;
              }
          },
      ],
   
      rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
      }
  });
}

function timeIndonesia(tanggal){
    var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    var gettgl = new Date(tanggal);

    var tanggal = gettgl.getDate();
    var xhari = gettgl.getDay();
    var xbulan = gettgl.getMonth();
    var xtahun = gettgl.getYear();

    var hari = hari[xhari];
    var bulan = bulan[xbulan];
    var tahun = (xtahun < 1000) ? xtahun + 1900 : xtahun;

    var html = (hari +', ' + tanggal + ' ' + bulan + ' ' + tahun);
    return html;
}

const options = $('select[name="bln"]').children();

options.map(function(key, option) {
    if(option.value == new Date().getMonth() + 1){
        option.setAttribute('selected', true);
    }
});

$('select[name="bln"]').change(function(){
    loadtable(fetchDatatableUrl($(this).val()));
});

loadtable(fetchDatatableUrl());