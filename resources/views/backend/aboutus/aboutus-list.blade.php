@extends('layouts.backend.master')
@section('title', 'List About us')

@section('datatableCSS')
    <link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css')}}">
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">About us List</h6>
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
                    <th>Description</th>
                    <th>Action</th>
                    </thead>
                    <tbody>

                    @foreach($show as $items)

                        <tr>
                            <td>{{$items->id}}</td>
                            <td>{{$items->description}}</td>

                            <td>
                                <a href="{{route('backend.edit-aboutus',$items->id)}}" data-toggle="tooltip" data-placement="top" title="edit" class="fas fa-pencil-alt ms-text-primary"></a>
                            </td>
                    @endforeach
                    </tbody>
                </table>
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
