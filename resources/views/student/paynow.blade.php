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

                                    <h6 class="mb-0">Title</h6>

                                </div>
                                <div class="col-md-9 pe-5">
                                    <h5>{{ $title }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Description</h6>

                                </div>
                                <div class="col-md-9 pe-5">
                                    <h5>{{ $description }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">


                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h5 class="mb-0">Price</h5>

                                </div>
                                <div class="col-md-9 pe-3">

                                    <h5>Rs: {{ $price }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            
                                <div class="row align-items-center py-2">
                                    <div class="col-md-3 ps-5">

                                        <h5 class="mb-0">Batch</h5>

                                    </div>
                                    <div class="col-md-9 pe-3">

                                        <select name="batch_id" id="batch_id" class="form-control form-control-lg">
                                            @foreach ($batches as $item)
                                                <option value="{{ $item->batch_id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#Modal">
                                    Pay Rs: {{ $price }}
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
                <div class="modal-body">Select "Pay Rs: {{ $price }} " below if you are ready to pay for the
                    branch.<br>
                    Amount Rs: {{ $price }} will automatically deducted from Your Wallet.<br><br>

                    <span class="text-primary">Your Current Wallet Balance: {{ Auth::user()->wallet_balance }}</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Pay Rs: {{ $price }} </button>
                    <input type="text" name="student_id" value="{{ Auth::user()->id }}" hidden />
                    <input type="text" name="amount" value="{{ $price }}" hidden />
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
