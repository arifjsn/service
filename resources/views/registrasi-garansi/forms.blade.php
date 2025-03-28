@extends('templates.main')

@section('title')
Your Forms
@endsection

@section('body')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form>
                    <div class="row">
                        <div class="col-auto">
                            <input class="form-control form-control-sm" name="tgl_awal" value="{{ request()->tgl_awal }}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Tgl Awal">
                        </div>
                        <div class="col-auto">
                            <input class="form-control form-control-sm" name="tgl_akhir" value="{{ request()->tgl_akhir }}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Tgl Akhir">
                        </div>
                        <div class="card-tools">
                            <div class="input-group col-auto">
                                <input type="text" name="pencarian" class="form-control form-control-sm float-right" value="{{ request()->pencarian }}" placeholder="Pencarian">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <p class="card-title">
                        @if (request()->pencarian)
                        Menampilkan hasil pencarian "{{ request()->pencarian }}"
                        @endif

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
                    </p>
                </form>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Dibuat</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>No Garansi</th>
                            <th>Model Barang</th>
                            <th>Jenis Barang</th>
                            <th>Tanggal Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forms as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ explode(" ", $item->created_at)[0] }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nomor_hp }}</td>
                            <td>{{ $item->nomor_garansi }}</td>
                            <td>{{ $item->model_barang }}</td>
                            <td>{{ $item->jenis_barang }}</td>
                            <td>{{ $item->tanggal_pembelian }}</td>
                            <td>
                                <button style="pointer-events: none; border-radius: 20px;" class="btn btn-block btn-{{ $item->status === 'PENDING' ? 'warning' : ($item->status === 'APPROVED' ? 'success' : 'danger') }}">
                                    {{ $item->status }}
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('registrasi-garansi.detail', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end m-3">
                    {{ $forms->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection