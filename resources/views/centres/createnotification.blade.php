@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">Create Notification</h1>
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
                    <form action="{{ route('centre.addnotification') }}" method="post">
                        @csrf
                        <div class="card mb-5" style="border-radius: 15px;">
                            <div class="card-body">
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">General Notification</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <textarea class="form-control form-control-lg" placeholder="General Noitification for All" name="general"></textarea>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Create General Notification</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <form action="{{ route('centre.addnotification') }}" method="post">
                        @csrf
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Batch ID</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder="Batch Id"
                                            name="batch_id" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Notification</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <textarea class="form-control form-control-lg" placeholder="Noitification" name="notification"></textarea>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Create Batch Notification</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
