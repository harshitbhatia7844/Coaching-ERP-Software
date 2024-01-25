@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">Buy New Branch</h1>
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
                    <form action="{{ route('centre.paynow') }}" method="post">
                        @csrf
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Branch ID</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder="" name="branch_id" />

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Branch Name</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder="" name="name" />

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Branch Location</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder=""
                                            name="location" />

                                    </div>
                                </div>

                                {{-- <hr class="mx-n3"> --}}

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h5 class="mb-0">Price</h5>

                                    </div>
                                    <div class="col-md-9 pe-3">

                                        <h5 class="text-primary">Rs: 1000</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">


                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Buy Branch</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
