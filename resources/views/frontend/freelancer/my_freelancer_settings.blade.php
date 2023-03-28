@extends('layouts.frontend.master')
@section('title', 'Home')



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
						<div class="jobs_manage">
							<div class="row">
								<div class="col-lg-3">
									<div class="jobs_tabs">
										<ul class="nav job_nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" href="#my_profile" id="my-profile-tab" data-toggle="tab">My Profile</a>
											</li>
											<li class="nav-item job_nav_item">
												<a class="nav-link" href="#social_accounts" id="social-accounts-tab" data-toggle="tab">Social Accounts</a>
											</li>
											<li class="nav-item job_nav_item">
												<a class="nav-link" href="#change_password" id="change-password-tab" data-toggle="tab">Change Password</a>
											</li>
											<li class="nav-item job_nav_item">
												<a class="nav-link" href="#delete_account" id="delete-account-tab" data-toggle="tab">Deactivate Account</a>
											</li>
										</ul>

									</div>
								</div>
								<div class="col-lg-9">
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="my_profile" role="tabpanel">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>My Profile</h4>
												</div>

												<div class="post_job_body">
												@if (session('alert'))
													<div class="alert alert-danger">
														{{ session('alert') }}
													</div>
												@endif
												<form method="POST" action="{{route('freelancesignup')}}" enctype="multipart/form-data">
														@csrf
														<div class="row">
															<div class="col-lg-12">

																<div class="form-group">
																									<label class="label15">Profile Avtar*</label>
																									<div class="avtar_dp">

																	<img src="{{asset(auth()->user()->profile_image)}}" alt="">
																									</div>
																									<div class="image-upload-wrap1 ml5">

																						<input class="file-upload-input1" name="file" id="file3" type="file" onchange="readURL(this);" accept="image/*">
																										<div class="drag-text1">
																											Upload Files


																				</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">First Name*</label>
																	<input type="text" name="first_name"class="job-input" value="{{auth()->user()->first_name}}">
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Last Name*</label>
																	<input type="text" name="last_name" class="job-input" value="{{auth()->user()->last_name}}">
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Email Address</label>
																	<input type="email" name="email" class="job-input" value="{{auth()->user()->email}}">
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Birthday</label>
																	<div class="smm_input">
																		<input type="text" name="birthday" class="job-input datepicker-here" data-language="en" value="{{auth()->user()->birthday}}">
																		<div class="mix_max"><i class="fas fa-calendar-alt"></i></div>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<label class="label15">Description</label>
																	<div class="description_dtu">

																		<textarea class="textarea70" name="description" >{{auth()->user()->description}}</textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<label class="label15">Tagline</label>
																	<input type="text" name="tagline" class="job-input" value="{{auth()->user()->tagline}}">
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label class="label15">Pay Rate ($/hr)</label>
																	<div class="smm_input">
																		<input type="text" class="job-input"  name="pay_rate" value="{{auth()->user()->pay_rate}}">
																		<div class="mix_max">Usd</div>
																	</div>
																</div>
															</div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="label15">Profession Category*</label>
                                                                    <div class="smm_input">
                                                                        <select name="online_or_in_person" class="job-input">
                                                                            <option value="online">Designing</option>
                                                                            <option value="in_person">Marketing</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

															<div class="col-lg-12">
																<div class="form-group">
																	<label class="label15">Location</label>
																	<div class="smm_input">
																		<input id="location" type="text" name="location" class="job-input" value="{{auth()->user()->location}}">
																		<div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
																	</div>
																</div>
															</div>

															
															<div class="col-lg-12">
																<button class="post_jp_btn" type="submit">Save Changes</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="social_accounts">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Social Accounts</h4>
												</div>
												<div class="social200">
													<form method="post" action="{{route('update_freelancer_social_media_links')}}">
														@csrf
														<ul>
															<li>
																<div class="social201">
																	<input class="scl_input" name="facebook_link" type="text" value="{{auth()->user()->facebook_link}}">
																	<div class="icon143 f1"><i class="fab fa-facebook-f"></i></div>
																</div>
															</li>
															<li>
																<div class="social201">
																	<input class="scl_input"name="twitter_link" type="text"  value="{{auth()->user()->twitter_link}}">
																	<div class="icon143 t1"><i class="fab fa-twitter"></i></div>
																</div>
															</li>
															<li>
																<div class="social201">
																	<input class="scl_input" name="google_link" type="text"  value="{{auth()->user()->google_link}}">
																	<div class="icon143 go1"><i class="fab fa-google-plus-g"></i></div>
																</div>
															</li>
															<li>
																<div class="social201">
																	<input class="scl_input" name="youtube_link" type="text"  value="{{auth()->user()->youtube_link}}">
																	<div class="icon143 y1"><i class="fab fa-youtube"></i></div>
																</div>
															</li>
															<li>
																<div class="social201">
																	<input class="scl_input" name="linkedin_link" type="text"  value="{{auth()->user()->linkedin_link}}">
																	<div class="icon143 l1"><i class="fab fa-linkedin-in l1"></i></div>
																</div>
															</li>
															<li>
																<div class="social201">
																	<input class="scl_input" name="instagram_link" type="text"  value="{{auth()->user()->instagram_link}}">
																	<div class="icon143 i1"><i class="fab fa-instagram"></i></div>
																</div>
															</li>

														</ul>
														<button class="post_jp_btn" type="submit">SAVE CHANGES</button>
													</form>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="change_password">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Change Password</h4>
												</div>
												<div class="post_job_body">
													<form method="post" action="{{route('change_freelancer_password')}}">
														@csrf
													    <div class="form-group">
															<label class="label15">Old Password*</label>
															<input type="password" name="current_password" class="job-input" placeholder="Enter Old Password">
														</div>
														<div class="form-group">
															<label class="label15">New Password*</label>
															<input type="password" name="new_password" class="job-input" placeholder="Enter New Password">
														</div>
														<div class="form-group">
															<label class="label15">Repeat New Password*</label>
															<input type="password" name="new_password_confirmation" class="job-input" placeholder="Enter Repeat New Password">
														</div>
														<button class="post_jp_btn" type="submit">Change Password</button>
													</form>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="delete_account" role="tabpanel">
											<div class="view_chart">
												<div class="view_chart_header">
													<h4>Deactivate Account</h4>
												</div>
												<div class="post_job_body">
													<form>
														<div class="form-group">
															<label class="label15">Please Explain Further**</label>
															<textarea class="textarea_input" placeholder="Type"></textarea>
														</div>
														<div class="form-group">
															<label class="label15">Password*</label>
															<input type="password" class="job-input" placeholder="Enter Password">
														</div>
														<div class="email_chk">
															<div class="ui checkbox apply_check">
																<input type="checkbox">
																<label style="color:#242424 !important;">Email Option Out.</label>
															</div>
														</div>
														<button class="post_jp_btn" type="submit">Deactivate Account</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&libraries=places"></script>
<script>
    var searchInput = 'location';

    const autocomplete = new google.maps.places.Autocomplete(
        document.getElementById(searchInput),
        {
            types: ['address'],
            // componentRestrictions: { country: 'US' } // optional
        }
    );

    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        console.log(place); //
    });




</script>
@endsection
