@extends('layout.centrelayout')
@section('content')
    <h1 class="text-primary">Notifications</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">General Notification</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($notification)
                            @foreach ($general as $g)
                                <tr>
                                    <div>
                                        <td class="small text-gray w-25">{{ $g->date }} </td>
                                        <td class="font-weight-bold">{{ $g->notification }} </td>
                                    </div>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Batch Notification</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($notification)
                            @foreach ($notification as $n)
                                <tr>
                                    <div>
                                        <td class="small text-gray w-25">{{ $n->date }} </td>
                                        <td class="font-weight-bold">{{ $n->notification }} </td>
                                    </div>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
