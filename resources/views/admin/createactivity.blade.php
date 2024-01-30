@extends('layout.adminlayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">Add Activity</h1>
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
                    <form action="{{ route('admin.addactivity') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-5" style="border-radius: 15px;">
                            <div class="card-body">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Activity Name</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input class="form-control form-control-lg" type="text" name="name" placeholder="Activity Name" />

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Activity Type</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <select name="type" class="form-control form-control-lg" id="">
                                            <option default hidden>Select</option>
                                            <option value="sports">Sports</option>
                                            <option value="education">Education/Learning</option>
                                        </select>

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Activity Image</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input class="form-control form-control-lg" type="file" name="image" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Add Activity</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
