@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Centres</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Centre</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Centre ID</th>
                            <th>Name</th>
                            <th>Company Email</th>
                            <th>Phone</th>
                            <th>Person</th>
                            <th>Person Email</th>
                            <th>Mobile</th>
                            <th>City</th>
                            <th>State</th>
                            <th>View Branch</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $items as $item)
                        <tr>
                            <td>{{$item->centre_id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->mobile_no}}</td>
                            <td>{{$item->contact_person}}</td>
                            <td>{{$item->contact_email}}</td>
                            <td>{{$item->contact_no}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->state}}</td>
                            <td><a href="{{route('admin.viewbranch')}}?centre_id={{$item->centre_id}}">Branches</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection
