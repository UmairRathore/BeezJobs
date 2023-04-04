@extends('layouts.backend.master')
@section('title', 'Update Privacy Policy')
@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Update Privacy Policy</h6>
            <a href="{{route('backend.privacypolicy-list')}}" class="btn btn-primary ms-text-primary">Privacy Policy List</a>
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

            <form  method="POST" action="{{ route ('backend.update-privacypolicy', $show->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$show->id}}">

                <div class="row">
                    <div class="col mb-3">
                        <label for="paragraph">Paragraph</label>
                        <div class="input-group">
                            <textarea id="ckeditor" class="form-control @error('description') is-invalid @enderror"  style="height:150px" name="description" placeholder="Type Paragraph">{{ $show->description ,old('description') }}</textarea>
                            @error('description')
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

@section('ckeditor')
    <script>
        ClassicEditor
            .create( document.querySelector( '#ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection


