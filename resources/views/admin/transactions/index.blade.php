@extends('templates.main')

@section('title')
Transactions
@endsection

@section('body')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <form>
                    <div class="row">
                        <div class="col-auto" style="width: 150px;">
                            <input class="form-control form-control-sm" name="start_date" value="{{ request()->start_date }}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Start Date">
                        </div>
                        <div class="col-auto" style="width: 150px;">
                            <input class="form-control form-control-sm" name="end_date" value="{{ request()->end_date }}" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="End Date">
                        </div>
                        <div class="card-tools">
                            <div class="input-group col-auto">
                                <input type="text" name="search" class="form-control form-control-sm float-right" value="{{ request()->search }}" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 input-group">
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="{{ app('request')->input('status') }}">Now: {{ app('request')->input('status') == "" ? 'Show All' : app('request')->input('status') }}</option>
                                <option value="">Show All</option>
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Pending">Pending</option>
                                <option value="Done">Done</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-2 input-group">
                            <select name="user" id="user" class="form-control form-control-sm">
                                <option value="{{ app('request')->input('user') }}">Now: {{ app('request')->input('user') == "" ? 'Show All' : app('request')->input('user') }}</option>
                                <option value="">Show All</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
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
                            <th>Invoice</th>
                            <th>Input Date</th>
                            <th>Item Name</th>
                            <th>Serial Number</th>
                            <th>Complaint</th>
                            <th>Information</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>{{ $item->input_date }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->serial_number }}</td>
                            <td>{{ $item->complaint }}</td>
                            <td>{{ $item->information }}</td>
                            <td>
                                <button style="pointer-events: none; border-radius: 20px;" class="btn btn-sm btn-{{ $item->status === 'Not Started' ? 'info' : ($item->status === 'In Progress' ? 'primary' : ($item->status === 'Pending' ? 'warning' : ($item->status === 'Done' ? 'success' : 'danger'))) }}">
                                    {{ $item->status }}
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('admin.registrasi-garansi.detail', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-info"></i></a>
                                @if ($item->status === 'IN PROGRESS')
                                <a href="{{ route('admin.registrasi-garansi.tolak', $item->id) }}" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                <a href="{{ route('admin.registrasi-garansi.terima', $item->id) }}" onclick="return confirm('Apakah anda yakin?')" class="btn btn-success btn-sm edit-pt"><i class="fa fa-check"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end m-3">
                    {{ $transactions->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection