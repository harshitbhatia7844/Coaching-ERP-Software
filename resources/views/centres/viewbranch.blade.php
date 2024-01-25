@extends('layout.centrelayout')
@section('content')
    <h1 class="text-primary">View Branches</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Branch</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Branch ID</th>
                            <th>Branch Name</th>
                            <th>Branch Location</th>
                            <th>Students</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->branch_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->location }}</td>
                                <td>
                                    <a href="{{ route('centre.viewstudents') }}?branch_id={{ $item->branch_id }}">
                                        Students
                                    </a>
                                </td>
                                @if ($item->status)
                                    <td class="table-success">Paid</td>
                                @else
                                    <td class="table-warning"><a href="#">Paynow</a></td>
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
