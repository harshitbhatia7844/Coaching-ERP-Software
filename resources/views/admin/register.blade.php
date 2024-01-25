@extends('layout.mainlayout')
@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">
                            <form action="{{ route('admin.signup') }}" method="post">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="../images/montage.png" alt="">
                                    <h2 class="fw-bold my-2 text-uppercase text-info">Admin Register</h2>
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
                                        <input type="text" id="typeNameX" placeholder="Name"
                                            class="form-control form-control-lg" name="name" />
                                        <!-- <label class="form-label" for="typeNameX">Name</label> -->
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" placeholder="Email"
                                            class="form-control form-control-lg" name="email" />
                                        <!-- <label class="form-label" for="typeEmailX">Email</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeMobileX" placeholder="Mobile No."
                                            class="form-control form-control-lg" name="mobile_no" />
                                        <!-- <label class="form-label" for="typeMobileX">Mobile NO.</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" placeholder="Password"
                                            class="form-control form-control-lg" name="password" />
                                        <!-- <label class="form-label" for="typePasswordX">Password</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeCityX" placeholder="City"
                                            class="form-control form-control-lg" name="city" />
                                        <!-- <label class="form-label" for="typeMobileX">City</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeStateX" placeholder="State"
                                            class="form-control form-control-lg" name="state" />
                                        <!-- <label class="form-label" for="typeMobileX">State</label> -->
                                    </div>


                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>

                                </div>

                                <div>
                                    <p class="mb-0">Already have an account? <a href="{{ route('admin.login') }}"
                                            class="text-white-50 fw-bold">Login</a>
                                    </p>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
