@extends('layouts.frontend.master')
@section('title', 'Home')

@section('content')
    <div class="all-categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="main-heading">
                        <h2>Choose Category</h2>
                        <span>Find quality talent or agencies</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="job-categories mt-30">
                        <div class="row no-gutters">
                            @foreach($professions as $profession)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="p-category">
                                            <a href="{{route('browse_freelancers')}}?category={{ $profession->id }}" title="">
                                                <img src="{{$profession->p_image}}" alt="">
                                                <span>{{$profession->profession}}</span>
                                                <?php
                                                $professioncount = \App\Models\User::where('profession_id', $profession->id)->count();
                                                ?>
                                                <p>{{$professioncount}}</p>
                                            </a>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
