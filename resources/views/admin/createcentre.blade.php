@extends('layout.adminlayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">Create New Centre</h1>
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
                    <form action="{{ route('admin.store') }}" method="post">
                        @csrf
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Centre ID</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder="CIND1000002"
                                            name="centre_id" />

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Company Name</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder="Montage IT Solutions Pvt Ltd"
                                            name="name" />

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        
                                        <h6 class="mb-0">Company Email</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        
                                        <input type="email" class="form-control form-control-lg"
                                        placeholder="montage@info.in" name="email" />
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        
                                        <h6 class="mb-0">Company Number</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        
                                        <input type="text" class="form-control form-control-lg"
                                        placeholder="Company Phone Number" name="mobile_no" />
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Contact Person</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder="Contact Person Name"
                                            name="contact_person" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Person's Email</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="email" class="form-control form-control-lg"
                                            placeholder="example@gmail.com" name="contact_email" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        
                                        <h6 class="mb-0">Contact Number</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        
                                        <input type="text" class="form-control form-control-lg"
                                        placeholder="Employee Phone Number" name="contact_no" />
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        
                                        <h6 class="mb-0">City</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        
                                        <input type="text" class="form-control form-control-lg"
                                        placeholder="City" name="city" />
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">
                                        
                                        <h6 class="mb-0">State</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-5">
                                        
                                        <input type="text" class="form-control form-control-lg"
                                        placeholder="State" name="state" />
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Password</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="password" class="form-control form-control-lg"
                                            placeholder="Password" name="password" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Confirm Password</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="password" class="form-control form-control-lg"
                                            placeholder="Password" name="password_confirmation" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-primary btn-lg"> Create Centre </button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
