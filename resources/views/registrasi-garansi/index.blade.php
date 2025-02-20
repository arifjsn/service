@extends('templates.main')

@section('title')
Registrasikan Garansi Produk Anda disini
@endsection

@section('body')

<div class="card">
    <div class="card-body" style="display: block;">
        <div class="text-center">
            <img class="img-fluid img-thumbnail" width="400px" src="{{ asset('dist/img/registrasi-garansi.png') }}" alt="Registrasi Garansi">
        </div>
        <br>
        <h2>Registrasikan Garansi Produk Anda disini</h2>
        <p>
T&C Winkey:
<ol>
    <li>Registrasi di 30 hari sejak pembelian untuk mendapatkan garansi 24 bulan. Apabila waktu registrasi membership pada website melebihi 30 hari dari waktu pembelian, maka Customer hanya bisa memperoleh Garansi Purna Jual selama 18 bulan.</li>
    <li>Klaim garansi berlaku satu kali selama masa garansi.</li>
    <li>Produk yang baru diterima di 30 hari pertama dan produk berkendala akan langsung digantikan unit baru tanpa mengurangi masa garansi 24 bulan namun tetap dibutuhkan registrasi.</li>
    <li>Setelah registrasi dan sebelum pengiriman barang perlu konfirmasi dengan customer care di nomor Whatsapp <a href="https://wa.me/6281382636014" target="_blank">+62 813-8263-6014</a>.</li>
</ol>
    

T&C ESR, Quincy dan Jisulife:
<ol>
    <li>Registrasi untuk mendapatkan garansi 12 bulan.</li>
    <li>Untuk produk non elektrikal pada brand ESR hanya mendapatkan garansi 1 bulan.</li>
<li>Klaim garansi berlaku satu kali selama masa garansi.</li>
<li>Setelah registrasi dan sebelum pengiriman barang perlu konfirmasi dengan customer care di nomor Whatsapp <a href="https://wa.me/6281382636014" target="_blank">+62 813-8263-6014</a>.</li>
</ol>
        </p>
    </div>

    <a href="{{ route('registrasi-garansi.form') }}">
        <div class="card-footer text-center bg-orange text-bold" style="display: block; color: #fff !important">
            SELANJUTNYA
        </div>
    </a>

</div>

@endsection