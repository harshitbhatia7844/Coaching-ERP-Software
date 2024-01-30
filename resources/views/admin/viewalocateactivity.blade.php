@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Activity</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Activity</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Centre ID</th>
                            <th>Centre Name</th>
                            <th>Activity Name</th>
                            <th>Activity Type</th>
                            <th>Activity Image</th>
                            <th>Activity Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->centre_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->a_name }}</td>
                                <td>{{ $item->type }}</td>
                                <td><img src="/images/activity/{{$item->image}}" alt="" style="height: 50px"></td>
                                @if ($item->centre_id)
                                    <td class="table-success">Active</td>
                                @else
                                    <td class="table-warning">Inactive</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
