@extends('templates.main')

@section('title')
Dashboard
@endsection

<style>
    #greetings::after {
        content: attr(data-content);
    }
</style>

@section('body')

<div class="card-body">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row ">

        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <span data-content="Welcome!" id="greetings"></span> {{ $user->name ?? '-' }}, Welcome to <b>Service Information System</b>.
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- <div class="col-auto">
            <a href="{{ route('registrasi-garansi.index') }}">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('dist/img/registrasi-garansi.png') }}" alt="Registrasi Garansi">
                    <div class="card-body">
                        <p class="card-text font-weight-bold">Registrasikan Garansi Produk Anda disini</p>
                        {{-- <footer class="blockquote-footer">Tidak ada Kedaluwarsa</footer> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-auto">
            <a href="{{ route('claim-garansi.index') }}">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('dist/img/claim-garansi.png') }}" alt="Claim Garansi">
                    <div class="card-body">
                        <p class="card-text font-weight-bold">Service Center</p>
                        {{-- <footer class="blockquote-footer">Tidak ada Kedaluwarsa</footer> --}}
                    </div>
                </div>
            </a>
        </div> -->

    </div>
</div>

<script>
    var greetElem = document.querySelector("#greetings")
    var curHr = new Date().getHours()
    var greetMes = ["Wow! Still Up Late?",
        "Good morning!",
        "Good afternoon!",
        "Good afternoon!",
        "Good night!",
        "Haven't slept yet?"
    ]
    let greetText = ""
    if (curHr < 4) greetText = greetMes[0]
    else if (curHr < 10) greetText = greetMes[1]
    else if (curHr < 16) greetText = greetMes[2]
    else if (curHr < 18) greetText = greetMes[3]
    else if (curHr < 22) greetText = greetMes[4]
    else greetText = greetMes[5]
    greetElem.setAttribute('data-content', greetText)
</script>


@endsection