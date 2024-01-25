@extends('layout.mainlayout')
@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">

                            <form action="{{ route('centre.signup') }}" method="post">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="../images/montage.png" alt="">
                                    <h2 class="fw-bold my-2 text-uppercase text-info">Centre Register</h2>
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
                                        <input type="text" id="typeidX" placeholder="Centre ID"
                                            class="form-control form-control-lg" name="centre_id" />
                                        <!-- <label class="form-label" for="typeidX">Centre ID</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeNameX" placeholder="Company Name"
                                            class="form-control form-control-lg" name="name" />
                                        <!-- <label class="form-label" for="typeNameX">Name</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" placeholder="Company Email"
                                            class="form-control form-control-lg" name="email" />
                                        <!-- <label class="form-label" for="typeEmailX">Email</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeNumberX" placeholder="Company Number"
                                            class="form-control form-control-lg" name="mobile_no" />
                                        <!-- <label class="form-label" for="typeNumberX">Name</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeNameX" placeholder="Contact Person"
                                            class="form-control form-control-lg" name="contact_person" />
                                        <!-- <label class="form-label" for="typeNameX">Name</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typePemailX" placeholder="Person's Email"
                                            class="form-control form-control-lg" name="contact_email" />
                                        <!-- <label class="form-label" for="typePemailX">Email</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="typeNumberX" placeholder="Contact Number"
                                            class="form-control form-control-lg" name="contact_no" />
                                        <!-- <label class="form-label" for="typeNumberX">Name</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="rX" placeholder="City"
                                            class="form-control form-control-lg" name="city" />
                                        <!-- <label class="form-label" for="rX">City</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="stateX" placeholder="State"
                                            class="form-control form-control-lg" name="state" />
                                        <!-- <label class="form-label" for="stateX">State</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" placeholder="Create Password"
                                            class="form-control form-control-lg" name="password" />
                                        <!-- <label class="form-label" for="typePasswordX">Password</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typeconfirmPasswordX" placeholder="Confirm Password"
                                            class="form-control form-control-lg" name="password_confirmation" />
                                        <!-- <label class="form-label" for="typeconfirmPasswordX">Confirm Password</label> -->
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>

                                </div>

                                <div>
                                    <p class="mb-0">Already have an account? <a href="{{ route('centre.login') }}"
                                            class="text-white-50 fw-bold"> Login</a>
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
