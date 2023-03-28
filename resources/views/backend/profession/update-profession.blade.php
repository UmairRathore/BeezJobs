@extends('layouts.backend.master')
@section('title', 'Update Profession')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Update Profession</h6>
            <a href="{{route('backend.profession-list')}}" class="btn btn-primary ms-text-primary">Profession List</a>
        </div>
        <div class="card-body">
            @if(Session('info_updated'))
                <div class="alert alert-success" role="alert">
                    {{Session('info_updated')}}

                </div>
            @endif
            @if(Session('required_fields_empty'))
                <div class="alert alert-danger" role="alert">
                    {{Session('required_fields_empty')}}

                </div>
            @endif

                <form  method="POST" action="{{ route ('backend.update-profession', $show->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$show->id}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="profession">Profession</label>
                            <div class="input-group">
                                <input type="text" name="profession" class="form-control @error('profession') is-invalid @enderror"  value="{{$show->profession}}" placeholder="Enter profession">
                                @error('profession')
                                <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="detail">Detail</label>
                            <div class="input-group">
                                <input type="text" name="detail" class="form-control @error('detail') is-invalid @enderror" value="{{$show->detail}}"  placeholder="Enter Detail">
                                @error('detail')
                                <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            @if($show->p_image)
                                <img src="{{ asset($show->p_image) }}" width="70px" height="70px" class="img-thumbnail img-fluid blog-img" alt="Image">
                            @else
                                <img src="default_image.jpg" width="70px" height="70px" class="img-thumbnail img-fluid blog-img" alt="no image">
                            @endif

                            <label for="image">Profession Image</label>
                            <input type="file" name="p_image" class="form-control @error('p_image') is-invalid @enderror">
                            @error('p_image')
                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>

                    </div>

                    <div>

                        <input type="Submit" class="btn btn-primary" value="Update">

                    </div>

                </form>

        </div>
    </div>

@endsection
