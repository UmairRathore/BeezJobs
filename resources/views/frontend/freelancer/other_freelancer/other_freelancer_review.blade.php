@extends('layouts.frontend.master')
@section('title', 'Freelancer Reviews')
@section('content')
    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Other Freelancer Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Start -->
    <!-- Body Start -->
    <main class="browse-section">
        <div class="container">
            <div class="row">
                @include('frontend.freelancer.other_freelancer.layout.other_freelancer_sidebar')
                <div class="col-lg-9 col-md-8 mainpage">
                    @include('frontend.freelancer.other_freelancer.layout.other_freelancer_nav')

                    <div class="view_chart">
                        <div class="view_chart_header">
                            <h4 class="mt-1">All Reviews</h4>
{{--                            <div class="review_right">--}}
{{--                                <button class="add_review_btn" type="button" data-toggle="modal" data-target="#addreviewModal">Add Review</button>--}}
{{--                            </div>--}}
                        </div>
                        <div class="job_bid_body">
                            <ul class="all_applied_jobs jobs_bookmarks">
                                @foreach($Reviews as $review)
                                    <li>
                                        <div class="applied_candidates_item">

                                            <div class="row">
                                                <div class="col-xl-7">
                                                    <div class="applied_candidates_dt">
                                                        @if($review->profile_image)
                                                            <div class="candi_img">
                                                                <img src="{{$review->profile_image}}" alt="">
                                                            </div>
                                                        @else
                                                            <div class="candi_img">
                                                                <img src="{{asset('images/homepage/candidates/img-2.jpg')}}" alt="">
                                                            </div>
                                                        @endif
                                                        <div class="candi_dt">
                                                            <a href="#">{{$review->first_name.' '.$review->last_name}}</a>
                                                            <div class="candi_cate">{{$review->profession}}</div>
                                                            <div class="rating_candi">Rating
                                                                <div class="rtl_right">
                                                                    <div class="star">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $review->rating)
                                                                                <i class="fas fa-star"></i>
                                                                            @else
                                                                                <i class="far fa-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                        <span>{{ $review->rating }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="btn_link24 review_user">
                                            <p>
                                                {{--                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean elementum, nibh et al--}}
                                                {{--                                                    iquam pellentesque, risus libero aliquet dolor, quis hendrerit nisi augue et purus.--}}
                                                {{$review->review}}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Body Start -->
@endsection
