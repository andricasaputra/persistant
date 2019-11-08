@extends('layouts.main')

@section('title', 'Failed Upload')

@section('content')
<style>
    table th{
        text-align: center;
    }
</style>
    @section('breadcrumb')

    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Failed upload aktivitas</li>
            </ol>
        </div>
    </div>

    @endsection
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
                    <table id="failed-table" class="table table-dark table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Data</th>
                                <th>Error</th>
                                <th>Action</th>
                            </tr>   
                        </thead>
                        <tbody>
                            @php $no = 1  @endphp
                            @foreach($fails as $fail)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>

                                        <table>
                                            @foreach($fail['datas'] as $title => $data)
                                               <tr>
                                                   <td>
                                                        Tanggal : {{ $data['tanggal'] }}</br>
                                                        Waktu : {{ $data['waktu'] }}</br>
                                                        Waktu s/d : {{ $data['waktu_sd'] }}</br>
                                                        Jenis tugas : {{ $data['jenis_tugas'] }}</br>
                                                        Kegiatan : {{ $data['kegiatan'] }}</br>
                                                        Output : {{ $data['output'] }}</br>
                                                        Kuantitas : {{ $data['kuantitas_skp'] }}</br>
                                                    </td>
                                               </tr>
                                            @endforeach
                                        </table>
                                        
                                    </td>
                                    <td><b style="color: red"><i>{{ $fail['exception'] }}</i></b></td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-id="{{ $fail->failed_job_id }}" data-type="retry">Retry</a>
                                        <a href="#" class="btn btn-danger" data-id="{{ $fail->failed_job_id }}" data-type="forget">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Row -->
@endsection

@section('extra_script')

    <script>
        $('#failed-table').DataTable();

        $('.btn').click(function(e){
            e.preventDefault();

            $.post('{{ route('failed.action') }}', { 
                _method: "POST", 
                _token: "{{ csrf_token() }}",
                id: $(this).data('id'),
                type: $(this).data('type'),
            }).done(function( data ) {
               //console.log(data)
               location.reload()
            }); 
        });
    </script>

@endsection


