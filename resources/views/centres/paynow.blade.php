@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1></h1>
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
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Branch ID</h6>

                                </div>
                                <div class="col-md-9 pe-5">
                                    <h5>{{ $branch_id }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Branch Name</h6>

                                </div>
                                <div class="col-md-9 pe-5">
                                    <h5>{{ $name }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Branch Location</h6>

                                </div>
                                <div class="col-md-9 pe-5">
                                    <h5>{{ $location }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h5 class="mb-0">Centre ID</h5>

                                </div>
                                <div class="col-md-9 pe-3">

                                    <h5>{{ Auth::user()->centre_id }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h5 class="mb-0">Centre Name</h5>

                                </div>
                                <div class="col-md-9 pe-3">

                                    <h5>{{ Auth::user()->name }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h5 class="mb-0">Price</h5>

                                </div>
                                <div class="col-md-9 pe-3">
                                    <h5>
                                        <a class="btn btn-info" href="#" data-toggle="modal" data-target="#Modal">
                                            Pay Rs: 1000
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Pay?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Pay Rs: 1000" below if you are ready to pay for the branch.<br> 
                    Amount Rs: 1000 will automatically deducted from Your Wallet. <br><br>
                    <span class="text-primary">Your Current Wallet Balance: {{ Auth::user()->wallet_balance }}</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('centre.withdraw') }}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Pay Rs: 1000</button>
                        <input type="text" name="branch_id" value="{{ $branch_id }}" hidden />
                        <input type="text" name="name" value="{{ $name }}" hidden />
                        <input type="text" name="location" value="{{ $location }}" hidden />
                        <input type="text" name="centre_id" value="{{ Auth::user()->centre_id }}" hidden />
                        <input type="text" name="price" value="{{ $price }}" hidden />
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
