@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">My Profile</h1>
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Centre ID</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$centre_id}}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Company Name</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$name}}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Company Email</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$email}}</h5>

                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Company Number</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$mobile_no}}</h5>
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">
                                
                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Contact Person</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$contact_person}}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Person's Email</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                          <h5>{{$contact_email}}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Contact Number</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                       <h5>{{$contact_no}}</h5>
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">City</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$city}}</h5>
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">State</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$state}}</h5>
                                        
                                    </div>
                                </div>
                                
                            </div>

                </div>
            </div>
        </div>
    </section>
@endsection
