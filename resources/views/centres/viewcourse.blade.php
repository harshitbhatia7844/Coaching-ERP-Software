@extends('layout.centrelayout')
@section('content')
    <h1 class="text-primary">View All Courses</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Courses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>MRP</th>
                            <th>Price</th>
                            <th>Branch ID</th>
                            <th>Batch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->course_id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->mrp }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->branch_id }}</td>
                                <td>
                                    <a href="{{ route('centre.viewbatch') }}?course_id={{ $item->course_id }}">
                                        Batch
                                    </a>
                                </td>
                                @if ($item->status)
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
