@extends('layouts.backend.master')
@section('title', 'Home')

@section('datatableCSS')
    <link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css')}}">
@endsection

@section('content')

{{--    <!-- Page Heading -->--}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
{{--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i--}}
{{--                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
    </div>

{{--    <!-- Content Row -->--}}
{{--    <div class="row">--}}

{{--        <!-- Earnings (Monthly) Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-primary shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">--}}
{{--                                Earnings (Monthly)</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-calendar fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Earnings (Monthly) Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-success shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">--}}
{{--                                Earnings (Annual)</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Earnings (Monthly) Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-info shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks--}}
{{--                            </div>--}}
{{--                            <div class="row no-gutters align-items-center">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <div class="progress progress-sm mr-2">--}}
{{--                                        <div class="progress-bar bg-info" role="progressbar"--}}
{{--                                             style="width: 50%" aria-valuenow="50" aria-valuemin="0"--}}
{{--                                             aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Pending Requests Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-warning shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                Pending Requests</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-comments fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Users List Row -->--}}

    <div class="row">

        <div class="card shadow mb-4 col-md-12 ">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-1 font-weight-bold text-primary">User List</h6>
            </div>
            <div class="card-body">

                @if(Session('info_created'))
                    <div class="alert alert-success" role="alert">
                        {{Session('info_created')}}

                    </div>
                @endif
                @if(Session('required_fields_empty'))
                    <div class="alert alert-danger" role="alert">
                        {{Session('required_fields_empty')}}

                    </div>
                @endif

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped thead-primary w-100">
                        @if(Session('info_deleted'))
                            <div class="alert alert-danger" role="alert">
                                {{Session('info_deleted')}}
                            </div>

                        @endif
                        <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>tagline</th>
                        <th>Action</th>
                        </thead>
                        <tbody>

                        @foreach($show as $items)

                            <tr>
                                <td>{{$items->id}}</td>
                                <td>{{$items->first_name.''.$items->last_name}}</td>
                                <td>{{$items->email}}</td>
                                <td>{{$items->tagline}}</td>
                                <td>

                                    <a href="{{route('backend.delete-user',$items->id)}}" onclick="return confirm('Are you sure?')" data-toggle="tooltip" data-placement="top" title="delete" class="far fa-trash-alt ms-text-danger"></a>

                                    <a href="{{route('backend.edit-user',$items->id)}}" data-toggle="tooltip" data-placement="top" title="edit" class="fas fa-pencil-alt ms-text-primary"></a>

                                </td>


                        @endforeach



                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('datatableJs')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
@endsection
