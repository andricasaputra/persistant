@include('layouts.header')

<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>404</h1>
            <h2 class="text-uppercase">Halaman Tidak Ditemukan !</h2>
            <h3 class="text-muted m-t-30 m-b-30">SEPERTINYA ANDA TERSESAT, KLIK TAUTAN DIBAWAH UNTUK KEMBALI KE HALAMAN UTAMA</h3>
            <a href="{{ route('home') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
        <footer class="footer text-center">2019 | Dric</footer>
    </div>
</section>

@include('layouts.script')



