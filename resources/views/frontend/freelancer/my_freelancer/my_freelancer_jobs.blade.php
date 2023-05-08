@extends('layouts.frontend.master')
@section('title', 'Freelancer Jobs')



@section('content')

		<!-- Title Start -->
		<div class="title-bar">
			<div class="
container">
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
                                                                    <a href="#">{{$Order->title}}</a>
                                                                    <ul class="view_dt_job">
                                                                        <li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$Order->location}}</div></li>
                                                                        <li><div class="vw1254"><i class="fas fa-briefcase"></i>{{$Order->online_or_in_person}}</div></li>
                                                                        <li><div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$Order->negotiated_price}}</div></li>
                                                                        <li><div class="vw1254"><i class="far fa-clock"></i>{{$Order->created_at}}</div></li>
                                                                    </ul>
                                                                    <p style="color: black; padding-top: 60px;">
                                                                        {{$Order->negotiated_description}}
                                                                    </p>
                                                                    <div class="btn_link23">
                                                                        @if($Order->Ostatus == 'active')
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Active</button>
                                                                        @elseif($Order->Ostatus == 'completed')
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>Completed</button>
                                                                        @elseif($Order->Ostatus == 'late-completed')
                                                                            <button class="apled_btn50" style="pointer-events: none;" disabled>OverDue Completion</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
													</ul>
												</div>
											</div>
										</div>
										<div class="tab-pane fade show" id="manage_jobs" role="tabpanel">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Manage Jobs</h4>
												</div>
												<div class="job_bid_body">
													<ul class="all_applied_jobs jobs_bookmarks">
														<li>
															<div class="applied_item">
																<a href="#">Wordpress Developer</a>
																<span class="badge_alrt">Pending Approval</span>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 3 August 2018</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>Expiring on 3 September 2018</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn60"><span class="badge badge-light">0</span>APPLIED CANDIDATES</button>
																	<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_item">
																<a href="#">Front End Developer</a>
																<span class="badge_alrt">Approved</span>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 29 July 2018</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>Expiring on 29 August 2018</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn60"><span class="badge badge-light">3</span>APPLIED CANDIDATES</button>
																	<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_item">
																<a href="#">Graphic Designer</a>
																<span class="badge_alrt">Expiring</span>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 24 July 2018</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 24 August 2018</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn60"><span class="badge badge-light">4</span>APPLIED CANDIDATES</button>
																	<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_item">
																<a href="#">Ruby Designer</a>
																<span class="badge_alrt">Expiried</span>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="far fa-clock"></i>Posted on 26 July 2018</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn60"><span class="badge badge-light">8</span>APPLIED CANDIDATES</button>
																	<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="applied_jobs">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Applied Jobs</h4>
												</div>
												<div class="job_bid_body">
													<ul class="all_applied_jobs jobs_bookmarks">
														<li>
															<div class="applied_item">
																<a href="#">Wordpress Developer</a>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>Australia</div></li>
																	<li><div class="vw1254"><i class="fas fa-briefcase"></i>Full Time</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$599 - Manual</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>1 day ago</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn50">Applied</button>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_item">
																<a href="#">Front End Developer</a>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>Australia</div></li>
																	<li><div class="vw1254"><i class="fas fa-briefcase"></i>Part Time</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$50 / hr</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>2 day ago</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn50">Applied</button>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_item">
																<a href="#">Back End Developer</a>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>India</div></li>
																	<li><div class="vw1254"><i class="fas fa-briefcase"></i>Full Time</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$1200 - Fixed</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>4 day ago</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn50">Applied</button>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_item">
																<a href="#">Ui / UX Designer</a>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>Australia</div></li>
																	<li><div class="vw1254"><i class="fas fa-briefcase"></i>Part Time</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$50 / hr</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>2 day ago</div></li>
																</ul>
																<div class="btn_link23">
																	<button class="apled_btn50">Applied</button>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="applied_candidates">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Applied Candidates</h4>
												</div>
												<div class="job_bid_body">
													<ul class="all_applied_jobs jobs_bookmarks">
														<li>
															<div class="applied_candidates_item">
																<div class="applied_candidates_dt">
																	<div class="candi_img">
																		<img src="images/homepage/candidates/img-1.jpg" alt="">
																	</div>
																	<div class="candi_dt">
																		<a href="#">John Doe</a>
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
																<div class="btn_link24">
																	<button class="apled_btn50">Download CV</button>
																	<button class="apled_btn70">Message</button>
																	<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
																</div>
															</div>
														</li>
														<li>
															<div class="applied_candidates_item">
																<div class="applied_candidates_dt">
																	<div class="candi_img">
																		<img src="images/homepage/candidates/img-2.jpg" alt="">
																	</div>
																	<div class="candi_dt">
																		<a href="#">Rock William</a>
																		<div class="candi_cate">Front End Developer</div>
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
																<div class="btn_link24">
																	<button class="apled_btn50">Download CV</button>
																	<button class="apled_btn70">Message</button>
																	<a href="#" class="delete_icon1"><i class="far fa-trash-alt"></i></a>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="post_job" role="tabpanel">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Post a Job</h4>
												</div>
												<div class="post_job_body">
													<form>
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<label class="label15">Job Name*</label>
																	<input type="text" class="job-input" placeholder="Job Name Here">
																</div>
																<div class="form-group">
																	<label class="label15">Job Description*</label>
																	<textarea class="textarea_input" placeholder="Type Description"></textarea>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="requires">
																	What are the job requirements
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Job Type*</label>
																	<div class="ui fluid search selection dropdown skills-search">
																		<input name="tags" type="hidden" value="">
																		<i class="dropdown icon"></i>
																		<input class="search" autocomplete="off" tabindex="0">
																		<span class="sizer" style=""></span>
																		<div class="default text">Select a job</div>
																		<div class="menu transition hidden" tabindex="-1">
																			<div class="item selected" data-value="Job1">Job Type 01</div>
																			<div class="item" data-value="Job2">Job Type 02</div>
																			<div class="item" data-value="Job3">Job Type 03</div>
																			<div class="item" data-value="Job4">Job Type 04</div>
																			<div class="item" data-value="Job5">Job Type 05</div>
																			<div class="item" data-value="Job6">Job Type 06</div>
																			<div class="item" data-value="Job7">Job Type 07</div>
																			<div class="item" data-value="Job8">Job Type 08</div>
																			<div class="item" data-value="Job9">Job Type 09</div>
																			<div class="item" data-value="Job10">Job Type 10</div>
																			<div class="item" data-value="Job11">Job Type 11</div>
																			<div class="item" data-value="Job12">Job Type 12</div>
																			<div class="item" data-value="Job13">Job Type 13</div>
																			<div class="item" data-value="Job14">Job Type 14</div>
																			<div class="item" data-value="Job15">Job Type 15</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Job Category*</label>
																	<div class="ui fluid search selection dropdown skills-search">
																		<input name="tags" type="hidden" value="">
																		<i class="dropdown icon"></i>
																		<input class="search" autocomplete="off" tabindex="0">
																		<span class="sizer" style=""></span>
																		<div class="default text">Select Category</div>
																		<div class="menu transition hidden" tabindex="-1">
																			<div class="item selected" data-value="Job1">Category 01</div>
																			<div class="item" data-value="Category2">Category 02</div>
																			<div class="item" data-value="Category3">Category 03</div>
																			<div class="item" data-value="Category4">Category 04</div>
																			<div class="item" data-value="Category5">Category 05</div>
																			<div class="item" data-value="Category6">Category 06</div>
																			<div class="item" data-value="Category7">Category 07</div>
																			<div class="item" data-value="Category8">Category 08</div>
																			<div class="item" data-value="Category9">Category 09</div>
																			<div class="item" data-value="Category10">Category 10</div>
																			<div class="item" data-value="Category11">Category 11</div>
																			<div class="item" data-value="Category12">Category 12</div>
																			<div class="item" data-value="Category13">Category 13</div>
																			<div class="item" data-value="Category14">Category 14</div>
																			<div class="item" data-value="Category15">Category 15</div>
																		</div>
																	</div>
																</div>
															</div>

															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Salary Min*</label>
																	<div class="smm_input">
																		<input type="text" class="job-input" placeholder="Min">
																		<div class="mix_max">Usd</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Salary Max*</label>
																	<div class="smm_input">
																		<input type="text" class="job-input" placeholder="Max">
																		<div class="mix_max">Usd</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Location*</label>
																	<div class="smm_input">
																		<input type="text" class="job-input" placeholder="Type Address">
																		<div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
																	</div>
																</div>
															</div>

															<div class="col-lg-12">
																<div class="form-group">
																	<label class="label15">Upload Files*</label>
																	<div class="image-upload-wrap1">
																		<input class="file-upload-input1" id="file2" type="file" onchange="readURL(this);" accept="image/*">
																		<div class="drag-text1">
																			Upload Files
																		</div>
																	</div>
																	<p class="upload_dt">Images, Pdf and MS Word Filess</p>
																</div>
															</div>
															<div class="col-lg-12">
																<button class="post_jp_btn" type="submit">Post a Job</button>
															</div>
														</div>
													</form>
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
