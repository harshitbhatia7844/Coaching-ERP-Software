@extends('layout.mainlayout')
@section('content')
    <section class="h-100 py-3 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">

                            <form action="{{ route('admin.signin') }}" method="post">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="../images/montage.png" alt="">
                                    <h2 class="fw-bold my-3 text-uppercase text-info">Admin Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>
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
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" placeholder="Email"
                                            class="form-control form-control-lg" name="email" />
                                        <!-- <label class="form-label" for="typeEmailX">Email</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" placeholder="Password"
                                            class="form-control form-control-lg" name="password" />
                                        <!-- <label class="form-label" for="typePasswordX">Password</label> -->
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50"
                                            href="{{ route('admin.forgotpassword') }}">Forgot password?</a></p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                </div>
                                <div>
                                    {{-- <p class="mb-0">Don't have an account? <a href="{{ route('admin.register') }}"
                                            class="text-white-50 fw-bold">Sign Up</a>
                                        </p> --}}
                                    <p class="small mb-2 pb-lg-2"><a class="text-white-50"
                                            href="{{ route('welcome') }}">&larr; Back to Home</a></p>
                                </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
