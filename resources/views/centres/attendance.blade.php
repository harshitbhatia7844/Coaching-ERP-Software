@extends('layout.centrelayout')
@section('content')
    <section class="h-100">
        <h1 class="text-primary">Attendance</h1>
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
        <form class="d-flex justify-content-center w-75 my-4" action="">
            <input type="text" class="form-control form-control-lg mx-3" name="batch_id" placeholder="Batch ID">
            <button class="btn btn-primary mx-3" type="submit">Search</button>
        </form>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Attendance</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('centre.attendance') }}" method="post">
                        @csrf
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $s)
                                    <tr>
                                        <td>{{ $s->id }}</td>
                                        <td>{{ $s->name }}</td>
                                        <td>
                                            <select name="status" class="form-control">
                                                <option value="" selected disabled hidden>Select Status</option>
                                                <option value="0">Absent</option>
                                                <option value="1">Present</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="student_id" value="{{ $s->id }}">
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-5 py-4">
                            <button type="submit" class="btn btn-primary btn-lg">Create Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
