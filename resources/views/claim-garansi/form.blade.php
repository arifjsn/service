@extends('templates.main')

@section('title')
Form Service Center WINKEY
@endsection

@section('body')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form method="POST" action="{{ route('claim-garansi.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nomor_garansi">Nomor Garansi Anda<span class="text-danger">*</span></label>
                        {{-- <input type="text" class="form-control" id="nomor_garansi" name="nomor_garansi" value="{{ old('nomor_garansi') }}" placeholder="Nomor Garansi Anda" required> --}}
                        <select name="nomor_garansi" id="nomor_garansi" class="form-control selectpicker" data-live-search="true" required>
                            <option value="">Pilih</option>
                            @foreach ($registrasiGaransi as $i)
                            <option value="{{ $i->nomor_garansi }}">{{ $i->nomor_garansi }}</option>
                            @endforeach
                        </select>
                        @error('nomor_garansi')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Anda<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->name) }}" placeholder="Nama Anda" required>
                        @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP Anda<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $user->no_hp) }}" placeholder="Nomor HP Anda" required>
                        @error('nomor_hp')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email Anda<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Anda" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_penerima">Alamat Lengkap Penerima<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alamat_penerima" name="alamat_penerima" value="{{ old('alamat_penerima') }}" placeholder="Alamat Penerima" required>
                        @error('alamat_penerima')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi<span class="text-danger">*</span></label>
                        <select name="provinsi" id="provinsi" class="form-control selectpicker" data-live-search="true" required>
                            <option value="{{ old('provinsi') }}">Pilih</option>
                        </select>
                        @error('provinsi')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota<span class="text-danger">*</span></label>
                        <select name="kota" id="kota" class="form-control selectpicker" data-live-search="true" required>
                            <option value="{{ old('kota') }}">Pilih</option>
                        </select>
                        @error('kota')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan<span class="text-danger">*</span></label>
                        <select name="kecamatan" id="kecamatan" class="form-control selectpicker" data-live-search="true" required>
                            <option value="{{ old('kecamatan') }}">Pilih</option>
                        </select>
                        @error('kecamatan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kelurahan">Kelurahan<span class="text-danger">*</span></label>
                        <select name="kelurahan" id="kelurahan" class="form-control selectpicker" data-live-search="true" required>
                            <option value="{{ old('kelurahan') }}">Pilih</option>
                        </select>
                        @error('kelurahan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="rt_rw">RT/RW<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="rt_rw" name="rt_rw" placeholder="RT/RW" value="{{ old('rt_rw') }}">
                        @error('rt_rw')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode POS<span class="text-danger">*</span></label>
                        <input type="string" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode POS" value="{{ old('kode_pos') }}" min="5" max="5" required>
                        @error('kode_pos')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand<span class="text-danger">*</span></label>
                        <select name="brand" id="brand" class="form-control" required>
                            <option value="WINKEY">WINKEY</option>
                            <option value="ESR">ESR</option>
                            <option value="QUINCY">QUINCY</option>
                            <option value="JISULIFE">JISULIFE</option>
                          </select>
                        @error('brand')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_tipe_barang">Foto Tipe Barang<span class="text-danger">*</span></label>
                        <span class="info">Ukuran maksimum file: 10MB</span>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept="image/png, image/gif, image/jpeg" class="custom-file-input" id="foto_tipe_barang" name="foto_tipe_barang" required>
                                <label class="custom-file-label" name="foto_tipe_barang" for="foto_tipe_barang">Unggah File</label>
                            </div>
                        </div>
                        @error('foto_tipe_barang')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_stiker">Foto Sticker Box Garansi Resmi PT. GIT<span class="text-danger">*</span></label>
                        <span class="info">Ukuran maksimum file: 10MB</span>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept="image/png, image/gif, image/jpeg" class="custom-file-input" id="foto_stiker" name="foto_stiker" required>
                                <label class="custom-file-label" for="foto_stiker">Unggah File</label>
                            </div>
                        </div>
                        @error('foto_stiker')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alasan_kerusakan">Alasan Kerusakan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="alasan_kerusakan" name="alasan_kerusakan" value="{{ old('alasan_kerusakan') }}" placeholder="Alasan Kerusakan" required>
                        @error('alasan_kerusakan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_kerusakan">Upload foto kerusakan Anda<span class="text-danger">*</span></label>
                        <span class="info">Ukuran maksimum file: 10MB</span>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" accept="image/png, image/gif, image/jpeg" class="custom-file-input" id="foto_kerusakan" name="foto_kerusakan" required>
                                <label class="custom-file-label" for="foto_kerusakan">Unggah File</label>
                            </div>
                        </div>
                        @error('foto_kerusakan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_struk_pembelian">Upload struk/invoice pembelian Anda<span class="text-danger">*</span></label>
                        <span class="info">Ukuran maksimum file: 10MB</span>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="foto_struk_pembelian" class="custom-file-input" id="foto_struk_pembelian" accept="image/png, image/gif, image/jpeg" required>
                                <label class="custom-file-label" for="foto_struk_pembelian">Unggah File</label>
                                @error('foto_struk_pembelian')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_invoice">Nomor Invoice<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_invoice" name="no_invoice" placeholder="Nomor Invoice" value="{{ old('no_invoice') }}" required>
                        @error('no_invoice')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="model_barang">Model Barang (Model barang terdapat diatas barcode packaging barang)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="model_barang" name="model_barang" value="{{ old('model_barang') }}" placeholder="Model Barang" required>
                        @error('model_barang')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_barang">Jenis Barang (Power Bank, Cable, Charger, Car Charger, dan lainnya)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="{{ old('jenis_barang') }}" placeholder="Jenis Barang" required>
                        @error('jenis_barang')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembelian">Tanggal Pembelian Barang<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ old('tanggal_pembelian') }}" required>
                        @error('tanggal_pembelian')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metode_pembelian">Pembelian barang melalui Online/Offline?<span class="text-danger">*</span></label>
                        <div class="form-group clearfix">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-warning custom-control-input-outline" type="radio" id="online" name="metode_pembelian" @if (old('metode_pembelian')=='Online' ) checked @endif value="Online">
                                <label for="online" class="custom-control-label">Online</label>
                                </div>
                            <br>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-warning custom-control-input-outline" type="radio" id="offline" name="metode_pembelian" @if (old('metode_pembelian')=='Offline' ) checked @endif value="Offline">
                                <label for="offline" class="custom-control-label">Offline</label>
                                </div>
                            <br>
                        </div>
                        @error('metode_pembelian')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" placeholder="Nama Toko" value="{{ old('nama_toko') }}" required>
                        @error('nama_toko')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan_tambahan">Keterangan Tambahan</label>
                        <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" placeholder="Keterangan Tambahan">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="qr_code">Scan QR</label>
                        <div id="reader" width="100px"></div>
                        <input type="text" class="form-control" id="qr_code" placeholder="Scan QR" name="qr_code" value="{{ old('qr_code') }}" required readonly>
                    </div> --}}
                </div>

                <button style="all: unset; width: 100%;" type="submit" onclick="return confirm('Apakah anda yakin?')">
                    <div class="card-footer text-center bg-orange text-bold" style="display: block; color: #fff !important">
                        KIRIM
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    $(function() {
        bsCustomFileInput.init()
    });
</script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        $('#qr_code').val(decodedText)
    }

    let config = {
        fps: 10,
        qrbox: {
            width: 100,
            height: 100
        },
        rememberLastUsedCamera: true,
        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", config, false)
    html5QrcodeScanner.render(onScanSuccess)
</script>
<script>
    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
        .then(res => res.json())
        .then(v => {
            let data = '<option>Pilih</option>'
            v.forEach(e => {
                data += `<option data-reg="${e.id}" value="${e.name}">${e.name}</option>`
            })
            document.getElementById('provinsi').innerHTML = data
            $('.selectpicker').selectpicker('refresh')
        })
    const pilihProvinsi = document.getElementById('provinsi')
    pilihProvinsi.addEventListener('change', (e) => {
        let provinsi = e.target.options[e.target.selectedIndex].dataset.reg
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
            .then(res => res.json())
            .then(v => {
                let data = '<option>Pilih</option>'
                v.forEach(e => {
                    data += `<option data-dis="${e.id}" value="${e.name}">${e.name}</option>`
                })
                document.getElementById('kota').innerHTML = data
                $('.selectpicker').selectpicker('refresh')
            });
    })

    const pilihKota = document.getElementById('kota')
    pilihKota.addEventListener('change', (e) => {
        let kota = e.target.options[e.target.selectedIndex].dataset.dis
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kota}.json`)
            .then(res => res.json())
            .then(v => {
                let data = '<option>Pilih</option>'
                v.forEach(e => {
                    data += `<option data-vil="${e.id}" value="${e.name}">${e.name}</option>`
                })
                document.getElementById('kecamatan').innerHTML = data
                $('.selectpicker').selectpicker('refresh')
            })
    })

    const pilihKecamatan = document.getElementById('kecamatan')
    pilihKecamatan.addEventListener('change', (e) => {
        let kelurahan = e.target.options[e.target.selectedIndex].dataset.vil
        fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kelurahan}.json`)
            .then(res => res.json())
            .then(v => {
                let data = '<option>Pilih</option>'
                v.forEach(e => {
                    data += `<option data-reg="${e.id}" value="${e.name}">${e.name}</option>`
                })
                document.getElementById('kelurahan').innerHTML = data
                $('.selectpicker').selectpicker('refresh')
            })
    })
</script>
@endpush