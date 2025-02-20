@extends('templates.main')

@section('title')
Service Center
@endsection

@section('body')

<div class="card">
    <div class="card-body" style="display: block;">
        <div class="text-center">
            <img class="img-fluid img-thumbnail" width="400px" src="{{ asset('dist/img/claim-garansi.png') }}" alt="Claim Garansi">
        </div>
        <br>
        <h2>Service Center</h2>
        <p class="text-bold">Produk cacat/rusak dari pabrik</p>
        <ul>
            <li>Batalnya jaminan/garansi produk akibat kelalaian pengguna seperti masuk air, jatuh, pernah servis ditempat lain atau bongkar sendiri dan akibat bencana alam.</li>
            <li>Untuk proses Claim barang rusak akan digantikan dengan barang baru dalam waktu maksimal 30 hari Kerja.</li>
            <li>Produk yang dibeli harus bergaransi resmi PT. Galaxy Ion Technology</li>
            <br>
            <p>Untuk pengiriman barang garansi bisa dikirim ke : </p>
            <p>PT. GALAXY ION TECHNOLOGY</p>
            <p>PT .GIT Head Office</p>
            <p>Alamat : Green Sedayu Business Park Blok G5 No. 12, Cengkareng Barat, Kecamatan Cengkareng, Kota Jakarta Barat, DKI Jakarta 11730</p>
            <p>No. Telpon (WhatsApp Chat Only) : <a href="https://wa.me/6281382636014">081382636014</a> (CS Claim Warranty)</p>
            <p>Email : <a href="mailto:customercare@winkey.id">customercare@winkey.id</a></p>
            <br><br>
            <p>* Note : untuk referensi S&K Claim Garansi bisa dilihat melalui : <a href="{{ route('registrasi-garansi.index') }}">https://winkey.id/warranty/registrasi-garansi</a></p>
        </ul>
    </div>

    <a href="{{ route('claim-garansi.form') }}">
        <div class="card-footer text-center bg-orange text-bold" style="display: block; color: #fff !important;">
            SELANJUTNYA
        </div>
    </a>

</div>

@endsection