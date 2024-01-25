@extends('layout.centrelayout')
@section('content')
    <h1 class="text-primary">View All Batches</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Batches</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Batch Id</th>
                            <th>Batch Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Students</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->course_id }}</td>
                                <td>{{ $item->batch_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->end_time }}</td>
                                <td>
                                    <a href="{{ route('centre.viewstudents') }}?batch_id={{ $item->batch_id }}">
                                        Students
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
