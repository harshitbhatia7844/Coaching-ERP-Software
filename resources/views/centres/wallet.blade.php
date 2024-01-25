@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">Wallet</h1>
                    <div class="card" style="border-radius: 15px;">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (session()->has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{{ session()->get('success') }}</li>
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Wallet Balance</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5 class="text-primary">Rs: {{ $balance }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">
                            <form action="{{ route('centre.paynow1') }}" method="post">
                                @csrf
                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Amount</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5><input class="form-control form-control-lg" type="text" name="amount"
                                                id=""></h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Deposit Balance</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5><button class="btn btn-outline-primary">Add Balance</button></h5>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
