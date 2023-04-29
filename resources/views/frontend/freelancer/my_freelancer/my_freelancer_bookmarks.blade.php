@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')


<!-- Title Start -->
<div class="tit
le-bar">
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
						<div class="all_bookmarks">
							<div class="add-ons-dt accordion" id="accordionExample">
								<div class="bookmark_card">
									<button class="bookmark_collapse" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">Bookmarked Jobs</button>
									<div id="collapse1" class="collapse show">
										<div class="card-body">
											<ul class="all_applied_jobs jobs_bookmarks">
												<li>
													<div class="row">
														<div class="col-md-10">
															<div class="applied_item">
																<h4>Wordpress Developer</h4>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>Australia</div></li>
																	<li><div class="vw1254"><i class="fas fa-briefcase"></i>Full Time</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$599 - Manual</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>1 day ago</div></li>
																</ul>
															</div>
														</div>
														<div class="col-md-2">
															<a href="#" class="delete_icon"><i class="far fa-trash-alt"></i></a>
														</div>
													</div>
												</li>
												<li>
													<div class="row">
														<div class="col-md-10">
															<div class="applied_item">
																<h4>Php Developer</h4>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>Australia</div></li>
																	<li><div class="vw1254"><i class="fas fa-briefcase"></i>Full Time</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$50 / hr</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>1 day ago</div></li>
																</ul>
															</div>
														</div>
														<div class="col-md-2">
															<a href="#" class="delete_icon"><i class="far fa-trash-alt"></i></a>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="bookmark_card">
									<button class="bookmark_collapse" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">Bookmarked Projetcs</button>
									<div id="collapse2" class="collapse show">
										<div class="card-body">
											<ul class="all_applied_jobs jobs_bookmarks">
												<li>
													<div class="row">
														<div class="col-md-10">
															<div class="applied_item">
																<h4>I Need a Travel Wordpress Theme</h4>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>New York</div></li>
																	<li><div class="vw1254"><i class="fas fa-shield-alt"></i>Verified</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$599 - $2500</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>1 day ago</div></li>
																</ul>
															</div>
														</div>
														<div class="col-md-2">
															<a href="#" class="delete_icon"><i class="far fa-trash-alt"></i></a>
														</div>
													</div>
												</li>
												<li>
													<div class="row">
														<div class="col-md-10">
															<div class="applied_item">
																<h4>I Need a Real Estate Psd Template</h4>
																<ul class="view_dt_job">
																	<li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>New York</div></li>
																	<li><div class="vw1254"><i class="fas fa-shield-alt"></i>Verified</div></li>
																	<li><div class="vw1254"><i class="far fa-money-bill-alt"></i>$200 - $1000</div></li>
																	<li><div class="vw1254"><i class="far fa-clock"></i>2 day ago</div></li>
																</ul>
															</div>
														</div>
														<div class="col-md-2">
															<a href="#" class="delete_icon"><i class="far fa-trash-alt"></i></a>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="bookmark_card">
									<button class="bookmark_collapse" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">Bookmarked Freelancers</button>
									<div id="collapse3" class="collapse show">
										<div class="card-body">
											<ul class="all_applied_jobs jobs_bookmarks">
												<li>
													<div class="job-center-dt">
														<div class="row">
															<div class="col-lg-2 bookmark_img">
																<img src="images/homepage/candidates/img-1.jpg" alt="">
															</div>
															<div class="col-lg-3">
																<div class="job-urs-dts tt_left">
																	<a href="#"><h4>John Doe</h4></a>
																	<span>UX Designer</span>
																	<div class="avialable">Available Full Time</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="rating-location ff_rating">
																	<div class="left-rating">
																		<div class="rtitle">Rating</div>
																		<div class="star">
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<span>4.9</span>
																		</div>
																	</div>
																	<div class="right-location">
																		<div class="text-left">
																			<div class="rtitle">Location</div>
																			<span><i class="fas fa-map-marker-alt"></i> New York City</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<a href="#" class="delete_icon mtb_4"><i class="far fa-trash-alt"></i></a>
															</div>
														</div>
													</div>
												</li>
												<li>
													<div class="job-center-dt">
														<div class="row">
															<div class="col-lg-2 bookmark_img">
																<img src="images/homepage/candidates/img-2.jpg" alt="">
															</div>
															<div class="col-lg-3">
																<div class="job-urs-dts tt_left">
																	<a href="#"><h4>Albert Dua</h4></a>
																	<span>Wordpress Developer</span>
																	<div class="avialable">Available Part Time</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="rating-location ff_rating">
																	<div class="left-rating">
																		<div class="rtitle">Rating</div>
																		<div class="star">
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<i class="fas fa-star"></i>
																			<span>4.9</span>
																		</div>
																	</div>
																	<div class="right-location">
																		<div class="text-left">
																			<div class="rtitle">Location</div>
																			<span><i class="fas fa-map-marker-alt"></i> New York City</span>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-1">
																<a href="#" class="delete_icon mtb_4"><i class="far fa-trash-alt"></i></a>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="bookmark_card">
									<button class="bookmark_collapse" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">Bookmarked Companies</button>
									<div id="collapse4" class="collapse show">
										<div class="card-body">
											<p class="cmpny_saved">No Company Bookmarked</p>
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
