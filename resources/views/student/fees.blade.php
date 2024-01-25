@extends('layout.studentlayout')
@section('content')
    <h1 class="text-primary">View Fees Details</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Fees</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Batch Name</th>
                            <th>Fee Amount</th>
                            <th>Date of Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $f)
                            <tr>
                                <td>{{ $f->title }}</td>
                                <td>{{ $f->name }}</td>
                                <td>Rs: {{ $f->amount }}</td>
                                <td>{{ $f->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
