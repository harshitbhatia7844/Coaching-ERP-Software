@extends('layout.studentlayout')
@section('content')
    <h1 class="text-primary">View All Courses</h1>

    <div class="d-flex justify-content-start flex-wrap">
        @foreach ($items as $item)
            <div class="card text-primary m-3" style="width: 18rem;">
                <img src="../images/courses/course.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <hr class="mx-n3">
                    <p class="card-text">{{ $item->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Rs: {{ $item->price }}</li>
                    {{-- <li class="list-group-item">Starts on -> 1 Feb 2024</li>
                    <li class="list-group-item">Ends on -> 31 March 2024</li> --}}
                </ul>
                <div class="d-flex justify-content-around p-0 m-2">
                    <a href="#" class="btn btn-outline-primary px-4">Explore</a>
                    <a href="#" class="btn btn-primary px-4">Buy Now</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
