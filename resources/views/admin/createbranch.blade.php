@extends('layout.adminlayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">Create New Branch</h1>
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
                    <form action="{{ route('admin.addbranch') }}" method="post">
                        @csrf
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Branch ID</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder=""
                                            name="branch_id" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Branch Name</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder=""
                                            name="name" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center pt-4 pb-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Branch Address</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder=""
                                            name="location" />

                                    </div>
                                </div>

                                <hr class="mx-n3">


                                <div class="px-5 py-4">
                                    <input type="text" class="form-control form-control-lg" name="longitude"
                                        id="lng" value="" hidden />
                                    <input type="text" class="form-control form-control-lg" name="latitude"
                                        id="lat" value="" hidden />
                                    <h6>Mark the Location in the map</h6>
                                    <div id="map" style="height:50vh; width: 100%;" class="my-3"></div>
                                </div>
                                <script>
                                    let map;

                                    function initMap() {
                                        map = new google.maps.Map(document.getElementById("map"), {
                                            center: {
                                                lat: 28.704,
                                                lng: 77.102
                                            },
                                            zoom: 8,
                                            scrollwheel: true,
                                        });

                                        const uluru = {
                                            lat: 28.704,
                                            lng: 77.102
                                        };
                                        let marker = new google.maps.Marker({
                                            position: uluru,
                                            map: map,
                                            draggable: true
                                        });

                                        google.maps.event.addListener(marker, 'position_changed',
                                            function() {
                                                let lat = marker.position.lat()
                                                let lng = marker.position.lng()
                                                $('#lat').val(lat)
                                                $('#lng').val(lng)
                                            })

                                        google.maps.event.addListener(map, 'click',
                                            function(event) {
                                                pos = event.latLng
                                                marker.setPosition(pos)
                                            })
                                    }
                                </script>
                                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLs7HxdrlNnOSFVbxF8cmTGqdURAG0uyQ&callback=initMap" type="text/javascript"></script>

                                <div class="row align-items-center py-3">
                                    <div class="col-md-3 ps-5">

                                        <h6 class="mb-0">Centre ID</h6>

                                    </div>
                                    <div class="col-md-9 pe-5">

                                        <input type="text" class="form-control form-control-lg" placeholder=""
                                            name="centre_id" />

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="px-5 py-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Create Branch</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
