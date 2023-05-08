@extends('layouts.frontend.master')
@section('title', 'Job')


@section('content')
    <style>


        .message-bidder {

            padding: 8px 20px;
            border-radius: 3px;
            margin-left: 30px;
            text-align: center;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            color: #fff;
            background-color: #ff4500;
            /*width: 100%;*/
            height: 40px;
            border: 0;
            margin-bottom: 30px;
        }
        .col-md-2, .col-md-10{
            padding:0;
        }

    </style>
<!-- Title Start -->
<div class="title-bar">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<ol class="title-bar-text">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item"><a href="browse_projects.html">Browser Projects</a></li>
							<li class="breadcrumb-item active" aria-current="page">Project Single View</li>
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
					<div class="col-lg-9 col-md-8">
						<div class="view_details">
							<ul>
								<li>
									<div class="vw_items">
										<i class="far fa-money-bill-alt"></i>
										<div class="vw_item_text">
											<h6>Budget</h6>
											<span>${{$job->budget}}</span>
										</div>
									</div>
								</li>
								<li>
									<div class="vw_items">
										<i class="far fa-clock"></i>
										<div class="vw_item_text">
											<h6>Posted Date</h6>
											<span>{{$job->created_at->diffForHumans()}}</span>
										</div>
									</div>
                                </li>
                            </ul>
                        </div>
                        <div class="job-item ptrl_2 mt-20">
                            {{--							@foreach($jobs as $job)--}}
                            <div class="job-top-dt">
                                <div class="job-left-dt">
                                    @if($job->profile_image)
                                        <img src="{{asset($job->profile_image)}}" alt="">
                                    @else
                                        <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                    @endif
                                    <div class="job-ut-dts">
                                        <a href="{{route('other_freelancer_profile',[$job->user_id])}}"><h4>{{$job->fname.' '.$job->lname}}</h4></a>
                                        <span><i class="fas fa-map-marker-alt"></i>{{$job->location}}</span>
                                    </div>
                                </div>
                                <div class="job-right-dt">
                                    <div class="job-price">${{$job->budget}}</div>
                                </div>
                            </div>
{{--                            @endforeach--}}
							<div class="job_dts">
								<h4>Description</h4>
<div>

								<p style="color: black">{{$job->description}}</p>
    <br>
</div>
							</div>
						</div>
						<div class="find-lts-jobs">
							<div class="main-heading bids_heading">
                                <h2>Freelancers Bidding</h2>
                                <div class="line-shape1">
                                    <img src="images/line.svg" alt="">
                                </div>
                            </div>
                            <div class="freelancers_bidings">
                                @foreach($bids as $key => $bid )
                                    <div class="job-item mt-30">
                                        <div class="job-top-dt">
                                            <div class="job-left-dt">
                                                @if($bid->profile_image)
                                                    <img src="{{asset($bid->profile_image)}}" alt="">
                                                @else
                                                    <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                                @endif
                                                <div class="job-ut-dts">
                                                    <a href="{{route('other_freelancer_profile',[$bid->user_id])}}"><h4>{{$bid->first_name.' '.$bid->last_name}}</h4></a>
                                                    <span><i class="fas fa-map-marker-alt"></i> {{$bid->location}}</span>
                                                    <div class="star mt-2">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>4.9</span>
												</div>
                                                <div>
                                                    <h4>Description</h4>
                                                    <p>{{$bid->bid_description}}</p>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="job-right-dt job-right-dt78">
                                                <div class="job-price job-price78">${{$bid->bid_budget}}</div>
                                                {{--											<div class="job-fp dy_cl">in 5 days</div>--}}
                                                <div class="job-bottom-dt job-bottom-dt78">
                                                    @if(auth()->check())
{{--                                                        <button id="chatmodalbutton{{$key}}" > Message Bidder</button>--}}
                                                    <a href="{{route('freelancer_texting',[$bid->user_id])}}" class="message-bidder job-right-dt job-right-dt78">Message Bidder</a>
                                                        {{--                                        <a href="#" id="chatmodalbutton" class="add-post job-bottom-dt job-right-dt job-right-dt78">Message Bidder</a>--}}
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mainpage">
                        <div class="total_days mtp_30">{{$job->created_at->diffForHumans()}} left</div>
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
                        @if(auth()->check())
                        <h4 class="bid_title">Bid Now This Job</h4>
                        <form method="POST" action="{{ route('backend.bid.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="job_id" value="{{ $job->id }}">

                            <div class="form-group">
                                <label for="bid_budget">Budget</label>
                                <input type="text" name="bid_budget" id="bid_budget" class="form-control" placeholder="Enter your bid amount">
                            </div>

                            <div class="form-group">
                                <label for="bid_description"> Description</label>
                                <textarea name="bid_description" id="bid_description" rows="5" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="apply_job_rt">PLACE A BID</button>

                        </form>

                        <div class="bookmark_rt">
                            <button class="bookmark1 mr-3" title="bookmark"><i class="fas fa-heart"></i></button>
                            BOOKMARK
                        </div>@endif
                        <ul class="social-links">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </main>

    <!-- Body End -->

@endsection
