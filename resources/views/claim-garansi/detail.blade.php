@extends('templates.main')

@section('title')
   Detail Claim Garansi
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
                      <h5> : {{ $claimGaransi->nama }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>No Hp &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->nomor_hp }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Email &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->email }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Alamat &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->alamat_penerima }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Nomor Garansi &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->nomor_garansi }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Brand &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->brand }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Alasan Kerusakan &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->alasan_kerusakan }}</h5>
                    </td>
                </tr>
                <tr>
                  <td>
                    <h5><b>Foto Tipe Barang &nbsp;</b></h5>
                  </td>
                  <td>
                      <h5> : <a href="{{ asset($claimGaransi->foto_tipe_barang) }}" data-toggle="lightbox" data-title="Foto Tipe Barang">
                        <img src="{{ asset($claimGaransi->foto_tipe_barang) }}" alt="Foto Tipe Barang" width="200px">
                      </a>
                      </h5>
                  </td>
              </tr>
              <tr>
                  <td>
                    <h5><b>Foto Stiker &nbsp;</b></h5>
                  </td>
                  <td>
                      <h5> : <a href="{{ asset($claimGaransi->foto_stiker) }}" data-toggle="lightbox" data-title="Foto Stiker"><img src="{{ asset($claimGaransi->foto_stiker) }}" alt="Foto Stiker" width="200px">
                      </a>
                      </h5>
                  </td>
              </tr>
              <tr>
                  <td>
                    <h5><b>Foto Kerusakan &nbsp;</b></h5>
                  </td>
                  <td>
                      <h5> : <a href="{{ asset($claimGaransi->foto_kerusakan) }}" data-toggle="lightbox" data-title="Foto Kerusakan">
                        <img src="{{ asset($claimGaransi->foto_kerusakan) }}" alt="Foto Kerusakan" width="200px">
                      </a>
                    </h5>
                  </td>
              </tr>
              <tr>
                  <td>
                    <h5><b>Foto Struk Pembelian &nbsp;</b></h5>
                  </td>
                  <td>
                      <h5> : <a href="{{ asset($claimGaransi->foto_struk_pembelian) }}" data-toggle="lightbox" data-title="Foto Struk Pembelian">
                        <img src="{{ asset($claimGaransi->foto_struk_pembelian) }}" alt="struk pembelian" width="200px">
                      </a>
                    </h5>
                  </td>
              </tr>
                <tr>
                  <td>
                    <h5><b>Nomor Invoice &nbsp;</b></h5>
                  </td>
                  <td>
                    <h5> : {{ $claimGaransi->no_invoice }}</h5>
                  </td>
              </tr>
                <tr>
                    <td>
                      <h5><b>Model Barang &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->model_barang }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Jenis Barang &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->jenis_barang }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Tanggal Pembelian &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->tanggal_pembelian }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Metode Pembelian &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->metode_pembelian }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Nama Toko &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->nama_toko }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>Keterangan Tambahan &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->keterangan_tambahan }}</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                      <h5><b>QR Code &nbsp;</b></h5>
                    </td>
                    <td>
                      <h5> : {{ $claimGaransi->qr_code }}</h5>
                    </td>
                </tr>
                <tr>
                  <td>
                    <h5><b>Status &nbsp;</b></h5>
                  </td>
                  <td>
                    <h5> : {{ $claimGaransi->status }}</h5>
                  </td>
                </tr>
                @if ($claimGaransi->status === 'APPROVED')
                <tr>
                  <td>
                    <h5><b>Proses &nbsp;</b></h5>
                  </td>
                  <td>
                    <h5> : {{ $claimGaransi->progress }}</h5>
                  </td>
                </tr>
                @endif
            </table>
          </p>
            </div>
            </div>
    </div>
</div>

@endsection