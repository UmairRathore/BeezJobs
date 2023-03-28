@extends('layouts.backend.master')
@section('title', 'Update Admin')
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

            <form  method="POST" action="{{ route ('backend.update-admin', $show->id) }}" enctype="multipart/form-data">
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
                <div>

                    <input type="Submit" class="btn btn-primary" value="Update">

                </div>

            </form>



        </div>
    </div>

    @yield('status')
@endsection


@section('status')
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
                            // toastr.error("Oops something went wrong");
                        }
                    }, error: function () {
                        toastr.success("Status updated Successfully");
                        // toastr.error("Oops something went wrong");

                    },
                });
            }
        });

    </script>
@endsection
