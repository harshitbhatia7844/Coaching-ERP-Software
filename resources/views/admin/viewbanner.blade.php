@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Banner</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Banner</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Banner Image</th>
                            <th>Banner Status</th>
                            <th>Banner Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td><img src="/images/banner/{{$item->banner}}" alt="" style="height: 60px"></td>
                                @if ($item->type)
                                    <td>Lower</td>
                                @else
                                    <td>Upper</td>
                                @endif
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
