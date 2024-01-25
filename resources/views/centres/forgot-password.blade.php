@extends('layout.mainlayout')
@section('content')
    <section class="h-100 py-3 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">

                            <form action={{ route('centre.reset') }} method="post">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <img src="../images/montage.png" alt="">
                                    <h2 class="fw-bold my-3 pb-5 text-uppercase text-info">Reset Password</h2>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" placeholder="Email"
                                            class="form-control form-control-lg" name="email" />
                                        <!-- <label class="form-label" for="typeEmailX">Email</label> -->
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typeoldPasswordX" placeholder="Old Password"
                                            class="form-control form-control-lg" name="oldpassword" />
                                        <!-- <label class="form-label" for="typeoldPasswordX">Old Password</label> -->
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="typenewPasswordX" placeholder="New Password"
                                            class="form-control form-control-lg" name="newpassword" />
                                        <!-- <label class="form-label" for="typenewPasswordX">New Password</label> -->
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Reset
                                        Password</button>

                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account? <a href={{ route('centre.register') }}
                                            class="text-white-50 fw-bold">Sign Up</a>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
