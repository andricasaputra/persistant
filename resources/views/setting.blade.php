@extends('layouts.main')

@section('title', 'Setting')

@section('content')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
            <div class="card">
                <div class="row">
                    <form action="{{ route('setting.store') }}" method="POST">

                        @csrf

                        <div class="card-block">
                            <div class="form-group">
                                <label><h3>Upload Proses</h3></label>
                                <div class="alert alert-success" role="alert">
                                  <b>Info!</b> Pilih bagaimana proses upload yang akan berjalan sesuai keinginan anda, penjelasannya sbb :<br><br>

                                  <b>Sync :</b> Data yang anda upload akan langsung tampil pada e-personal anda (direct) tetapi proses upload ini akan memakan waktu load halaman lebih lama sampai proses upload selesai.<br><br>

                                  <b>Async :</b> Data yang anda upload tidak akan langsung tampil pada e-personal, dalam prosesnya data akan ditampung sementara pada storage kami dan akan diupload ke e-personal saat server dalam keadaan sepi, sehingga proses ini lebih ramah untuk server dan waktu upload lebih cepat daripada proses sync. <br><br>
                                  <i><b>Default proses : {{ $user->upload_setting }}</b></i>
                                </div>
                                <select class="form-control" name="upload_setting">
                                    @if($user->upload_setting == 'sync')
                                    <option value="sync" selected>Sync</option>
                                    <option value="async">Async</option>
                                    @else
                                    <option value="async" selected>Async</option>
                                    <option value="sync">Sync</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success">Pilih</button>
                            </div>
                        </div>  
                    </form>
                </div> 

                <div class="row">
                    <div class="form-group">
                        <div class="card-block">
                            <h3>Bersihkan Cache</h3>
                            <div class="alert alert-danger" role="alert">
                              <b>Info!</b> Membersihkan cache akan memperlambat reload data anda diawal, harap lakukan pembersihan apabila anda mengharapkan data terupdate/terbaru dari e-personal anda
                            </div>
                           <a href="{{ route('setting.clearCache') }}" class="btn btn-primary">Clear Cache</a> 
                        </div>
                    </div> 
                </div>   
            </div>
        </div>
        <!-- Column -->
    </div>

@endsection

