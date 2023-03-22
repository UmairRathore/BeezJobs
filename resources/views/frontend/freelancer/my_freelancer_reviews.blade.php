@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')
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
                        <ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_dashboard')}}">Dashboard</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_profile')}}">Profile</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_portfolio')}}">Portfolio</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_notifications')}}">Notifications</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_messages')}}">Messages</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_bookmarks')}}">Bookmarks</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_jobs')}}">Jobs</a>
								</li>
								<li class="nav-item">
									<a class="nav-link active" href="{{route('my_freelancer_bids')}}">Bids</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_reviews')}}">Reviews</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_payments')}}">Payment</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{route('my_freelancer_setting')}}"><i class="fas fa-cog"></i></a>
								</li>
							</ul>
						</div>
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
@endsection
