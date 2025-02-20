@extends('templates.main')

@section('title')
   Detail Registrasi Garansi
@endsection

@section('body')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body">
            <p class="card-text">
            <table>
                <tr>
                    <td>
                      <h5><b>Nama &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->nama }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>No Hp &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->nomor_hp }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Email &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->email }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Tanggal Lahir &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->tanggal_lahir }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Alamat &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->alamat }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Struk Pembelian &nbsp;</b></h5>
                    </td>
                    <td>
                        <h5> : <a href="{{ asset($registrasiGaransi->struk_pembelian) }}" data-toggle="lightbox" data-title="Struk Pembelian">
                          <img src="{{ asset($registrasiGaransi->struk_pembelian) }}" alt="struk pembelian" width="200px">
                        </a>
                      </h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Nomor Invoice &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->no_invoice }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Brand &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->brand }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Model Barang &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->model_barang }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Jenis Barang &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->jenis_barang }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Nomor Garansi &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->nomor_garansi }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Tanggal Pembelian &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->tanggal_pembelian }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Metode Pembelian &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->metode_pembelian }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Nama Toko &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->nama_toko }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Keterangan Tambahan &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->keterangan_tambahan }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>QR Code &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $registrasiGaransi->qr_code }}</h5>
                    </td>
                </tr>
                <tr>
                  <td>
                    <h5><b>Status &nbsp;</b></h5>
                  </td>
                  <td>
                    <h5> : {{ $registrasiGaransi->status }}</h5>
                  </td>
                </tr>
            </table>
          </p>
            </div>
            </div>
    </div>
</div>

@endsection