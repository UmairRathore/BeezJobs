@extends('layouts.backend.master')
@section('title', 'List Users')


@section('datatableCSS')
    <link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css')}}">
@endsection


@section('content')
    <link href="{{asset('vendor/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 24px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
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
                    <th>Status</th>
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
                                <label class="switch">
                                    <input type="checkbox" id="status" class="checkbox checkbox_list" data-id="{{ $items->id }}"
                                           value="{{ ($items->status == 1) ? 0 : 1 }}" data-url="{{route('status-user',$items->id)}}"
                                           name="status" {{ ($items->status == 1) ? 'checked' : '' }}>
                                    <span class="slider round" ></span>
                                </label>
                                <span style="display: none">{{ ($items->status == 1) ? 'Active' : 'false' }}</span>
                            </td>
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


    <script src="{{asset('backend/vendor/jquery/jquery.js')}}"></script>

    <script src="{{asset('vendor/toastr/js/toastr.min.js')}}"></script>
    <script>

        $(document).on("click", ".checkbox_list", function () {
            var is_checked_obj = $(this);
            var is_checked = $(this).val(); // this gives me null
            let token = $('meta[name="csrf-token"]').attr('content');

            {{--add this in head
                        "<meta name="csrf-token" content="{{ csrf_token() }}" />"
            when token mismatches --}}

            if (is_checked != null) {
                var url = $(this).attr('data-url'); // this gives me null
                var dltUrl = url;
                $.ajax({
                    url: dltUrl,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'status': is_checked,
                        '_token': token
                    },
                    success: function (response) {
                        console.log(response.statusCode);
                        if (response.statusCode == 200) {
                            is_checked = 1 - Math.abs(is_checked);
                            is_checked_obj.val(is_checked); // this gives me null
                            toastr.success(response.message);
                        } else {
                            if(is_checked){
                                is_checked_obj.removeAttribute('checked');
                            }
                            else{
                                is_checked_obj.attr('checked');
                            }
                            toastr.error("Oops something went wrong");
                        }
                    }, error: function () {
                        // toastr.success("Status updated Successfully");
                        toastr.error("Oops something went wrong");

                    },
                });
            }
        });

    </script>

@endsection

@section('datatableJs')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        } );
    </script>
@endsection
