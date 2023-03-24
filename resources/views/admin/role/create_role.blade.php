@extends('layouts.frontend.master')
@section('title', 'Create Role')



@section('content')


    <main class="browse-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-heading bids_heading">
                        <h2>Create Role</h2>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <div class="post501">
                        <form action="{{route('role.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="label15">Role</label>
                                        <input type="text" name="name" class="job-input" placeholder="Role Name Here">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="post_jp_btn" type="submit">Submit Role</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection


