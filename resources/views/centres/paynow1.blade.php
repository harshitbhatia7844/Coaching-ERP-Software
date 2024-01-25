@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
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

                                    <h5 class="mb-0">Centre ID</h5>

                                </div>
                                <div class="col-md-9 pe-3">

                                    <h5>{{ Auth::user()->id }}</h5>

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

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Amount</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $amount }} </h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-2">
                                <div class="col-md-3 ps-5">

                                    <h5 class="mb-0">Price</h5>

                                </div>
                                <div class="col-md-9 pe-3">

                                    {{-- <h5>Rs: {{ $price }}</h5> --}}
                                    <h5 class="btn">
                                        <form action="{{ route('razorpay.make.payment') }}" method="post">
                                            @csrf
                                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_API_KEY') }}"
                                                data-amount="{{ $amount * 100 }}" data-buttontext="Proceed To Pay" data-name="Monteage"
                                                data-description="A demo razorpay payment" data-image="https://monteage.in/img/favicon.png"
                                                data-prefill.name="Monteage" data-prefill.email="montage@info.in" data-theme.color="#2969ff"></script>

                                            <input type="text" name="centre_id" value="{{ Auth::user()->id }}" hidden />
                                            <input type="text" name="amount" value="{{ $amount }}" hidden />
                                        </form>
                                    </h5>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
