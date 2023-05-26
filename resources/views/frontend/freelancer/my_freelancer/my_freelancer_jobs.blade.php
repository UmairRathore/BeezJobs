@extends('layouts.frontend.master')
@section('title', 'Freelancer Jobs')



@section('content')
<style>
    .arrow-link {
        position: absolute;
        top: 40%;
        right: 20px;
        transform: translateY(-50%);
    }

    .arrow-link a {
        display: flex;
        align-items: center;
        color: black;
        text-decoration: none;
        font-size: 14px;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
    }

    .details-heading {
        margin-right: 5px;
        font-size: 14px;
    }
    .details-heading::after {
        display: inline-block;
        margin-left: 5px;
    }
</style>
<!-- Title Start -->
<div class="title-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="title-bar-text">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
					<div class="col-lg-3 col-md-4">

							@include('layouts.frontend.freelancer_sidebar')
					</div>
					<div class="col-lg-9 col-md-8 mainpage">
						<div class="account_heading">
							<div class="account_hd_left">
								<h2>Manage Your Account</h2>
							</div>
							<div class="account_hd_right">
								<a href="{{route('signout')}}" class="main_lg_btn">Logout</a>
							</div>
						</div>
                        <div class="account_tabs">
                            @include('frontend.freelancer.my_freelancer.layout.my_freelancer_navbar')                        </div>
						<div class="jobs_manage">
							<div class="row">
								<div class="col-lg-3">
									<div class="jobs_tabs">
										<ul class="nav job_nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" href="#sent_jobs" id="manage-job-tab" data-toggle="tab">Sent Offers</a>
											</li>
                                            <li class="nav-item">
												<a class="nav-link" href="#received_jobs" id="manage-job-tab" data-toggle="tab">Received Offers</a>
											</li>
                                            <li class="nav-item">
												<a class="nav-link" href="#orders" id="manage-job-tab" data-toggle="tab">Orders</a>
											</li>

{{--                                            <li class="nav-item">--}}
{{--												<a class="nav-link" href="#manage_jobs" id="manage-job-tab" data-toggle="tab">Manage Jobs</a>--}}
{{--											</li>--}}
{{--											<li class="nav-item job_nav_item">--}}
{{--												<a class="nav-link" href="#applied_jobs" id="applied-job-tab" data-toggle="tab">Applied Jobs</a>--}}
{{--											</li>--}}
{{--											<li class="nav-item job_nav_item">--}}
{{--												<a class="nav-link" href="#applied_candidates" id="applied-candidate-tab" data-toggle="tab">Applied Candidates</a>--}}
{{--											</li>--}}
{{--											<li class="nav-item job_nav_item">--}}
{{--												<a class="nav-link" href="#post_job" id="post-job-tab" data-toggle="tab">Post a Job</a>--}}
{{--											</li>--}}
										</ul>

									</div>
								</div>
								<div class="col-lg-9">
									<div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="sent_jobs" role="tabpanel">
                                            <div class="view_chart">
                                                <div class="view_chart_header">
                                                    <h4>Sent Offers</h4>
                                                </div>
                                                <div class="job_bid_body">
                                                    <ul class="all_applied_jobs jobs_bookmarks">
                                                        @foreach($SentOffers as $sentoffer)
                                                        <li>
                                                            <div class="applied_item">
                                                                <a href="#">{{$sentoffer->title}}</a>
                                                                <ul class="view_dt_job">
                                                                    <li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$sentoffer->location}}</div></li>
                                                                    <li><div class="vw1254"><i class="fas fa-briefcase"></i>{{$sentoffer->online_or_in_person}}</div></li>
                                                                    <li><div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$sentoffer->negotiated_price}}</div></li>
                                                                    <li><div class="vw1254"><i class="far fa-clock"></i>{{$sentoffer->created_at}}</div></li>
                                                                </ul>
                                                                <p style="color:black; padding-top: 60px;">
                                                                    {{$sentoffer->negotiated_description}}
                                                                </p>
                                                                <div class="btn_link23">
                                                                    @if($sentoffer->rejected == Null and $sentoffer->accepted == Null)
                                                                        <button class="apled_btn50" style="pointer-events: none;" disabled>Pending Approval</button>
                                                                    @elseif($sentoffer->rejected == 1 and $sentoffer->accepted == Null)
                                                                        <button class="apled_btn50" style="pointer-events: none;" disabled>Rejected</button>
                                                                    @elseif($sentoffer->rejected == Null and $sentoffer->accepted == 1)
                                                                        <button class="apled_btn50" style="pointer-events: none;" disabled>Accepted</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
										<div class="tab-pane fade show" id="received_jobs" role="tabpanel">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Received Offers</h4>
												</div>
                                                <div class="job_bid_body">
                                                    <ul class="all_applied_jobs jobs_bookmarks">
                                                        @foreach($RecievedOffers as $recievedOffer)
                                                            <li>
                                                                <div class="applied_item">
                                                                    <a href="#">{{$recievedOffer->title}}</a>
                                                                    <ul class="view_dt_job">
                                                                        <li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$recievedOffer->location}}</div></li>
                                                                        <li><div class="vw1254"><i class="fas fa-briefcase"></i>{{$recievedOffer->online_or_in_person}}</div></li>
                                                                        <li><div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$recievedOffer->negotiated_price}}</div></li>
                                                                        <li><div class="vw1254"><i class="far fa-clock"></i>{{$recievedOffer->created_at}}</div></li>
                                                                    </ul>
                                                                    <p  style="color: black; padding-top:60px">
                                                                        {{$recievedOffer->negotiated_description}}
                                                                    </p>
                                                                    <div class="btn_link23">
                                                                        @if($recievedOffer->rejected == Null and $recievedOffer->accepted == Null)
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Pending Approval</button>
                                                                        @elseif($recievedOffer->rejected == 1 and $recievedOffer->accepted == Null)
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Rejected</button>
                                                                        @elseif($recievedOffer->rejected == Null and $recievedOffer->accepted == 1)
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Accepted</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
											</div>
										</div>
                                        <div class="tab-pane fade show" id="orders" role="tabpanel">
                                            <div class="view_chart">
                                                <div class="view_chart_header">
                                                    <h4>Orders</h4>
                                                </div>
                                                <div class="job_bid_body">
                                                    <ul class="all_applied_jobs jobs_bookmarks">
                                                        @foreach($Orders as $Order)
                                                            <li>
                                                                <div class="applied_item">
                                                                    <div class="card-content">
                                                                        <a href="#">{{ $Order->title }}</a>
                                                                        <ul class="view_dt_job">
                                                                            <li>
                                                                                <div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{ $Order->location }}</div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="vw1254"><i class="fas fa-briefcase"></i>{{ $Order->online_or_in_person }}</div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="vw1254"><i class="far fa-money-bill-alt"></i>{{ $Order->negotiated_price }}</div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="vw1254"><i class="far fa-clock"></i>{{ $Order->created_at }}</div>
                                                                            </li>
                                                                        </ul>
                                                                        <p style="color: black; padding-top: 60px;">{{ $Order->negotiated_description }}</p>
                                                                    </div>
                                                                    <div class="btn_link23">
                                                                        @if($Order->Ostatus == 'active')
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Active</button>
                                                                        @elseif($Order->Ostatus == 'completed')
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Completed</button>
                                                                        @elseif($Order->Ostatus == 'late-completed')
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Overdue Completion</button>
                                                                        @endif
                                                                    </div>
                                                                    <div class="arrow-link">
                                                                        <a href="{{ route('my_freelancer_order_details', $Order->Order_id) }}">
                                                                            <span class="details-heading">Details</span>
                                                                            <i class="fas fa-arrow-right"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
@endsection
@section('active_tab')
    <script>
        $(document).ready(function() {
            var url = window.location.href;
            // console.log(url);
            $('.nav-item a[href="'+url+'"]').addClass('active');
        });
    </script>
@endsection
