@extends('layout.studentlayout')
@section('content')
    <h1 class="text-primary">My Recent Batch</h1>

    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-10">
                @foreach ($batches as $item)
                    <div class="card card-body">
                        <div
                            class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                            <div class="mr-2 mb-3 mb-lg-0">

                                <img src="../images/courses/course.jpg" width="250" height="auto" alt="">

                            </div>

                            <div class="media-body">
                                <h6 class="media-title font-weight-semibold">
                                    <a href="#" data-abc="true">{{ $item->title }} {{$item->name}} </a>
                                </h6>
                                <p class="mb-3">Course Validity: <br>{{ $item->start_time }} - {{ $item->end_time }}</p>
                                <p class="mb-3">{{ $item->description }}</p>
                            </div>

                            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                <h3 class="mb-0 font-weight-semibold text-primary">₹ {{ $item->price }}</h3>

                                <div class="text-warning m-2">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                                <div class="d-fle justify-content-around">
                                    <a href="#" class="btn btn-outline-primary w-100 mb-1">Explore</a>
                                    <a class="btn btn-success w-100 ">Purchased</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
