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
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createTransactionModal">Create Transaction</button>
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
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editTransactionModal{{ $item->id }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTransactionModal{{ $item->id }}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>

                        <!-- Edit Transaction Modal -->
                        <div class="modal fade" id="editTransactionModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editTransactionModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editTransactionModalLabel{{ $item->id }}">Edit Transaction</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.transactions.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Form fields for editing transaction -->
                                            <div class="form-group">
                                                <label for="user_id">User</label>
                                                <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
                                                    @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $user->id == $item->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="input_date">Input Date</label>
                                                <input type="date" name="input_date" id="input_date" class="form-control" value="{{ $item->input_date }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="item_name">Item Name</label>
                                                <input type="text" name="item_name" id="item_name" class="form-control" value="{{ $item->item_name }}" placeholder="Item Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="item_user">Item User</label>
                                                <input type="text" name="item_user" id="item_user" class="form-control" value="{{ $item->item_user }}" placeholder="Item User">
                                            </div>
                                            <div class="form-group">
                                                <label for="serial_number">Serial Number</label>
                                                <input type="text" name="serial_number" id="serial_number" class="form-control text-uppercase" value="{{ $item->serial_number }}" placeholder="Serial Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="equipment">Equipment</label>
                                                <input type="text" name="equipment" id="equipment" class="form-control" value="{{ $item->equipment }}" placeholder="Equipment">
                                            </div>
                                            <div class="form-group">
                                                <label for="complaint">Complaint</label>
                                                <input type="text" name="complaint" id="complaint" class="form-control" value="{{ $item->complaint }}" placeholder="Complaint">
                                            </div>
                                            <div class="form-group">
                                                <label for="information">Information</label>
                                                <input type="text" name="information" id="information" class="form-control" value="{{ $item->information }}" placeholder="Information">
                                            </div>
                                            <div class="form-group">
                                                <label for="technician">Technician</label>
                                                <input type="text" name="technician" id="technician" class="form-control" value="{{ $item->technician }}" placeholder="Technician">
                                            </div>
                                            <div class="form-group">
                                                <label for="taker">Taker</label>
                                                <input type="text" name="taker" id="taker" class="form-control" value="{{ $item->taker }}" placeholder="Taker">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="Not Started" {{ $item->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                                                    <option value="In Progress" {{ $item->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Done" {{ $item->status == 'Done' ? 'selected' : '' }}>Done</option>
                                                    <option value="Cancelled" {{ $item->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Transaction Modal -->
                        <div class="modal fade" id="deleteTransactionModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTransactionModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteTransactionModalLabel{{ $item->id }}">Delete Transaction</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.transactions.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            Are you sure you want to delete this transaction?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

<!-- Create Transaction Modal -->
<div class="modal fade" id="createTransactionModal" tabindex="-1" role="dialog" aria-labelledby="createTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTransactionModalLabel">Create Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form fields for creating transaction -->
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="input_date">Input Date</label>
                        <input type="date" name="input_date" id="input_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="output_date">Output Date</label>
                        <input type="date" name="output_date" id="output_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" name="item_name" id="item_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="item_user">Item User</label>
                        <input type="text" name="item_user" id="item_user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="serial_number">Serial Number</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="equipment">Equipment</label>
                        <input type="text" name="equipment" id="equipment" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="complaint">Complaint</label>
                        <input type="text" name="complaint" id="complaint" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="information">Information</label>
                        <input type="text" name="information" id="information" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="technician">Technician</label>
                        <input type="text" name="technician" id="technician" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="taker">Taker</label>
                        <input type="text" name="taker" id="taker" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sender">Sender</label>
                        <input type="text" name="sender" id="sender" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Pending">Pending</option>
                            <option value="Done">Done</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection