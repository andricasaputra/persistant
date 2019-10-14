@include('layouts.header')

<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>500</h1>
            <h2 class="text-uppercase">HALAMAN YANG ANDA TUJU TIDAK TERSEDIA UNTUK SAAT INI  !</h2>
            <p class="text-muted m-t-30 m-b-30">
            JIKA ANDA BARU SAJA MENDAFTAR, KEMUNGKINAN EMAIL ATAU PASSWORD ANDA DAFTARKAN TIDAK COCOK DENGAN E-PERSONAL ANDA
        	</p>
        	<p>APABILA ANDA PENGGUNA LAMA, SILAHKAN PERIKSA KEMBALI KONEKSI INTERNET ANDA!</p>
            <a href="{{ route('home') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
        <footer class="footer text-center">2019 | Dric</footer>
    </div>
</section>

@include('layouts.script')

