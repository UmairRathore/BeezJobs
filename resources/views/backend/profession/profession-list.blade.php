@extends('layouts.backend.master')
@section('title', 'List Profession')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Profession List</h6>
                    <a href="{{route('backend.add-profession')}}" class="btn btn-primary ms-text-primary">Add Profession</a>
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
                <table id="professionlist" class="table table-striped thead-primary w-100">
                    @if(Session('info_deleted'))
                        <div class="alert alert-danger" role="alert">
                            {{Session('info_deleted')}}
                        </div>

                    @endif
                    <thead>
                    <th>ID</th>
                    <th>Image</th>
                    <th>profession</th>
                    <th>Detail</th>
                    <th>Action</th>
                    </thead>
                    <tbody>

                    @foreach($show as $items)
                        {{--{{dd($show)}}--}}

                        <tr>
                            <td>{{$items->id}}</td>
                            <td>
                                @if($items->p_image)
                                    <img src="{{ asset($items->p_image) }}" width="70px" height="70px"
                                         class="img-thumbnail img-fluid blog-img" alt="Image">
                                @else
                                    <img src="default_image.png" width="70px" height="70px"
                                         class="img-thumbnail img-fluid blog-img" alt="no image">
                                @endif
                            </td>
                            <td>{{$items->profession}}</td>
                            <td>{{$items->detail}}</td>

                            <td>

                                <a href="{{route('backend.delete-profession',$items->id)}}" onclick="return confirm('Are you sure?')" data-toggle="tooltip" data-placement="top" title="delete" class="far fa-trash-alt ms-text-danger"></a>

                                <a href="{{route('backend.edit-profession',$items->id)}}" data-toggle="tooltip" data-placement="top" title="edit" class="fas fa-pencil-alt ms-text-primary"></a>

                            </td>


                    @endforeach

                    {{--



                                                        {{--<i class="fas fa-pencil-alt ms-text-primary"></i>--}}
                    {{--<i href="#"  class="far fa-trash-alt ms-text-danger"></i>--}}

                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
