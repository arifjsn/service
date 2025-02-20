@extends('templates.main')

@section('title')
Detail Registrasi Garansi
@endsection

@section('body')

<div class="row">

  <div class="container-fluid mb-3">
    @if (session('error'))
    <span class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </span>
    @endif

    @if (session('success'))
    <span class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </span>
    @endif
  </div>

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
          @if ($registrasiGaransi->brand === 'ESR')
          <tr>
            <td>
              <h5><b>Produk Elektrikal &nbsp;</b></h5>
            </td>
            <td>
              <h5> :
                @if ($registrasiGaransi->status !== 'APPROVED')
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-electrical">
                  {{ $registrasiGaransi->isElectrical === 1 ? '✔️' : ($registrasiGaransi->isElectrical === 0 ? '❌' :
                  'Belum diatur') }} <i class="nav-icon fa fa-pencil-square"></i>
                  <div></div>
                </button>
                @else 
                {{ $registrasiGaransi->isElectrical === 1 ? '✔️' : '❌' }}
                @endif
              </h5>
            </td>
          </tr>
          @endif
          @if ($registrasiGaransi->status === 'APPROVED')
          <tr>
            <td>
              <h5><b>Expired &nbsp;</b></h5>
            </td>
            <td>
              <h5> : {{ $registrasiGaransi->expired }}</h5>
            </td>
          </tr>
          @endif
        </table>
        @if ($registrasiGaransi->status === 'PENDING' && $registrasiGaransi->brand !== 'ESR')
        <a href="{{ route('admin.registrasi-garansi.tolak', $registrasiGaransi->id) }}"
          class="btn btn-danger">Reject</a>
        <a href="{{ route('admin.registrasi-garansi.terima', $registrasiGaransi->id) }}"
          class="btn btn-primary">Approve</a>
        @elseif ($registrasiGaransi->status === 'PENDING' && $registrasiGaransi->isElectrical !== NULL &&
        $registrasiGaransi->brand === 'ESR')
        <a href="{{ route('admin.registrasi-garansi.tolak', $registrasiGaransi->id) }}"
          class="btn btn-danger">Reject</a>
        <a href="{{ route('admin.registrasi-garansi.terima', $registrasiGaransi->id) }}"
          class="btn btn-primary">Approve</a>
        @endif
        </p>
      </div>
    </div>
  </div>
</div>

{{-- Modal is Electrical --}}
<div class="modal fade" id="modal-electrical" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Produk Elektrikal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{ route('admin.registrasi-garansi.electrical', $registrasiGaransi->id) }}">
        <div class="modal-body">
          <select name="electrical" id="electrical" class="form-control form-control-sm">
            <option value="{{ $registrasiGaransi->isElectrical }}">Saat ini : <b>{{ $registrasiGaransi->isElectrical ===
                1 ? '✔️' : ($registrasiGaransi->isElectrical === 0 ? '❌' : 'Belum diatur') }}</b></option>
            <option value="1">✔️</option>
            <option value="0">❌</option>
          </select>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>

</div>

</div>

@endsection