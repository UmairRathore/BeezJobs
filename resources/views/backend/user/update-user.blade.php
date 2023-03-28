@extends('layouts.backend.master')
@section('title', 'Update User')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Update User</h6>
            <a href="{{route('backend.user-list')}}" class="btn btn-primary ms-text-primary">User List</a>
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

            <form  method="POST" action="{{ route ('backend.update-user', $show->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$show->id}}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name">First Name</label>
                        <div class="input-group">
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"  value="{{$show->first_name}}" placeholder="Update First Name">
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Last Name</label>
                        <div class="input-group">
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{$show->last_name}}"  placeholder="Update Last Name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" value="{{$show->email}}" class="form-control  @error('email') is-invalid @enderror" placeholder="Update Email" readonly>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="pass" class="form-control bi-eye-slash" placeholder="Update password">
                        </div>
                        <small>Password will remain same, if not updated.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tagline">Tagline</label>
                        <div class="input-group">
                            <input type="text" name="tagline" class="form-control @error('tagline') is-invalid @enderror"  value="{{$show->tagline}}" placeholder="Update Tagline">
                            @error('tagline')
                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div>

                    <input type="Submit" class="btn btn-primary" value="Update">

                </div>

            </form>



        </div>
    </div>

@endsection
