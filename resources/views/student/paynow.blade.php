@extends('layout.studentlayout')
@section('content')
    <form action="{{ route('student.withdraw') }}" method="post">
        @csrf
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

                                        <h5 class="mb-0">Title:</h5>

                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <h5>{{ $item->title }}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-2">
                                    <div class="col-md-3 ps-5">

                                        <h5 class="mb-0">Description:</h5>

                                    </div>
                                    <div class="col-md-9 pe-5">
                                        <h5>{{ $item->description }}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">


                                <div class="row align-items-center py-2">
                                    <div class="col-md-3 ps-5">

                                        <h5 class="mb-0">Price:</h5>

                                    </div>
                                    <div class="col-md-9 pe-3">

                                        <h5>Rs: {{ $item->price }}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">


                                <div class="row align-items-center py-2">
                                    <div class="col-md-3 ps-5">

                                        <h5 class="mb-0">Batch:</h5>

                                    </div>
                                    <div class="col-md-9 pe-3">

                                        <h5>{{ $item->name }}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-2">
                                    <div class="col-md-3 ps-5">

                                        <h5 class="mb-0">Validity:</h5>

                                    </div>
                                    <div class="col-md-9 pe-3">

                                        <h5>{{ $item->start_time }} - {{ $item->end_time }}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#Modal">
                                    Pay Rs: {{ $item->price }}
                                </a>

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
                    <div class="modal-body">Select "Pay Rs: {{ $item->price }} " below if you are ready to pay for the
                        branch.<br>
                        Amount Rs: {{ $item->price }} will automatically deducted from Your Wallet.<br><br>

                        <span class="text-primary">Your Current Wallet Balance: {{ Auth::user()->wallet_balance }}</span>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Pay Rs: {{ $item->price }} </button>
                        <input type="text" name="student_id" value="{{ Auth::user()->id }}" hidden />
                        <input type="text" name="batch_id" value="{{ $item->batch_id }}" hidden />
                        <input type="text" name="amount" value="{{ $item->price }}" hidden />
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
