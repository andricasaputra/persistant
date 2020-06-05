@include('layouts.header')

<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
          <h1>500</h1>
          <h2 class="text-uppercase">HALAMAN YANG ANDA TUJU TIDAK TERSEDIA UNTUK SAAT INI  !</h2>
          <p class="text-muted m-t-30 m-b-30">
            <b>JIKA ANDA BARU SAJA MENDAFTAR, KEMUNGKINAN EMAIL ATAU PASSWORD ANDA DAFTARKAN TIDAK COCOK DENGAN E-PERSONAL ANDA</b>
          </p>
          <p>APABILA ANDA PENGGUNA LAMA, SILAHKAN PERIKSA KEMBALI KONEKSI INTERNET ANDA!</p>
          <p>Untuk memperbaiki hal ini coba lakukan langkah-langkah berikut :</p>
          <div style="margin: auto;">
              - Pastikan anda tersambung dengan intenet, kemudian lakukan logout <br>
              - Klik lupa password pada halaman login untuk mengganti password anda <br>
              - Buka email pertanian (mail.pertanian.go.id) yang anda daftarkan dan ikuti panduan selanjutnya <br>
              - Jika masih terdapat kendala hubungi admin di dric.dev@gmail.com <br>
          </div>
          <br>
            <div style="margin: auto;">

                 <a href="{{ route('home') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a>

                 <br>

                 <a href="{{ route('logout') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a> 
     
            </div>  
        </div>
        <footer class="footer text-center">2019 | Dric</footer>
    </div>
</section>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

@include('layouts.script')

