@extends('layout.mainlayout')
@section('content')
    <section class="h-100 py-5 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">
                            <img src="images/montage.png" alt="">
                            <h2 class="fw-bold my-3 text-uppercase text-white">Monteage IT Solutions Pvt Ltd</h2>
                            <p class="text-white mb-3">Welcome to Our Home Page!</p>
                            <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button"
                                href={{ route('student.login') }}>
                                Student Login
                            </a>
                            <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button"
                                href={{ route('centre.login') }}>
                                Centres Login
                            </a>
                            <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button"
                                href={{ route('admin.login') }}>
                                Admin Login
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
