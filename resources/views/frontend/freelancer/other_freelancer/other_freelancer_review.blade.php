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
                @include('frontend.freelancer.other_freelancer.other_freelancer_sidebar')
                <div class="col-lg-9 col-md-8 mainpage">
                    @include('frontend.freelancer.other_freelancer.other_freelancer_nav')

                    <div class="view_chart">
                        <div class="view_chart_header">
                            <h4 class="mt-1">All Reviews</h4>
                            <div class="review_right">
                                <button class="add_review_btn" type="button" data-toggle="modal" data-target="#addreviewModal">Add Review</button>
                            </div>
                        </div>
                        <div class="job_bid_body">
                            <ul class="all_applied_jobs jobs_bookmarks">
                                <li>
                                    <div class="applied_candidates_item">
                                        <div class="row">
                                            <div class="col-xl-7">
                                                <div class="applied_candidates_dt">
                                                    <div class="candi_img">
                                                        <img src="images/homepage/candidates/img-2.jpg" alt="">
                                                    </div>
                                                    <div class="candi_dt">
                                                        <a href="#">Johnson Dua</a>
                                                        <div class="candi_cate">UX Designer</div>
                                                        <div class="rating_candi">Rating
                                                            <div class="star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span>4.9</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn_link24 review_user">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean elementum, nibh et aliquam pellentesque, risus libero aliquet dolor, quis hendrerit nisi augue et purus.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="applied_candidates_item">
                                        <div class="row">
                                            <div class="col-xl-7">
                                                <div class="applied_candidates_dt">
                                                    <div class="candi_img">
                                                        <img src="images/homepage/candidates/img-5.jpg" alt="">
                                                    </div>
                                                    <div class="candi_dt">
                                                        <a href="#">Jassica William</a>
                                                        <div class="candi_cate">Freelancer</div>
                                                        <div class="rating_candi">Rating
                                                            <div class="star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span>5.0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn_link24 review_user">
                                            <p>Awesome work, definitely will rehire. Poject was completed not only with the requirements, but on time, within our small budget.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="applied_candidates_item">
                                        <div class="row">
                                            <div class="col-xl-7">
                                                <div class="applied_candidates_dt">
                                                    <div class="candi_img">
                                                        <img src="images/homepage/candidates/img-3.jpg" alt="">
                                                    </div>
                                                    <div class="candi_dt">
                                                        <a href="#">Joginder Singh</a>
                                                        <div class="candi_cate">Employer</div>
                                                        <div class="rating_candi">Rating
                                                            <div class="star">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span>4.5</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn_link24 review_user">
                                            <p>Fusce sodales consectetur lacus eu vestibulum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean consequat velit aliquet tortor scelerisque</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Body Start -->
@endsection
