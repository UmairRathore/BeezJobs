@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')

<!-- Header End -->
		<!-- Title Start -->
		<div class="title-bar">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<ol class="title-bar-text">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Other Freelancer Profile</li>
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
						<div class="account_dt_left">
							<div class="job-center-dt">
								<img src="images/homepage/candidates/img-3.jpg" alt="">
								<div class="job-urs-dts">
									<h4>Rock William</h4>
									<span>UX Designer</span>
								</div>
								<ul class="user_btns">
									<li><button class="hire_btn" type="button">Hire Me</button></li>
									<li><button class="hire_btn" type="button">Message</button></li>
								</ul>
							</div>

							<div class="group_skills_bar">
								<h6>Profile Completeness</h6>
								<div class="group_bar1">
									<span>90%</span>
									<div class="progress skill_process">
										<div class="progress-bar progress_bar_skills" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="rlt_section">
								<div class="rtl_left">
									<h6>Rating</h6>
								</div>
								<div class="rtl_right">
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
							<div class="rlt_section">
								<div class="rtl_left">
									<h6>Location</h6>
								</div>
								<div class="rtl_right">
									<span><i class="fas fa-map-marker-alt lc_icon"></i> Ludhiana, India</span>
								</div>
								<div class="my_location">
									<div id="map"></div>
								</div>
								<ul class="rlt_section2">
									<li>
										<div class="rtl_left2">
											<h6>Hourly Rate</h6>
										</div>
										<div class="rtl_right2">
											<span>$50 / hr</span>
										</div>
									</li>
									<li>
										<div class="rtl_left2">
											<h6>Age</h6>
										</div>
										<div class="rtl_right2">
											<span>30</span>
										</div>
									</li>
									<li>
										<div class="rtl_left2">
											<h6>Experenice</h6>
										</div>
										<div class="rtl_right2">
											<span>5 Year</span>
										</div>
									</li>
									<li>
										<div class="rtl_left2">
											<h6>Job Done</h6>
										</div>
										<div class="rtl_right2">
											<span>85</span>
										</div>
									</li>
								</ul>
							</div>
							<div class="social_section3 mb80">
								<div class="social_leftt3">
									<h6>Contact Social Account</h6>
								</div>
								<ul class="social_accounts">
									<li><a href="#" class="social_links"><i class="fab fa-facebook-f f1"></i>http://facebook.com/johndoe</a></li>
									<li><a href="#" class="social_links"><i class="fab fa-twitter t1"></i>http://twitter.com/johndoe</a></li>
									<li><a href="#" class="social_links"><i class="fab fa-linkedin-in l1"></i>http://linkedin.com/johndoe</a></li>
									<li><a href="#" class="social_links"><i class="fab fa-dribbble d1"></i>http://dribbble.com/johndoe</a></li>
									<li><a href="#" class="social_links"><i class="fab fa-behance b1"></i>http://behance.net/johndoe</a></li>
									<li><a href="#" class="social_links"><i class="fab fa-github g1"></i>http://github.com/johndoe</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-9 col-md-8 mainpage">
						<div class="account_tabs">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" href="other_freelancer_profile.html">Profile</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="other_freelancer_portfolio.html">Portfolio</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="other_freelancer_reviews.html">Reviews</a>
								</li>
							</ul>
						</div>
						<div class="view_chart">
							<div class="view_chart_header">
								<h4>About</h4>
							</div>
							<div class="view_chart_body">
								<p class="user_about_des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis accumsan mi. Nam nulla lorem, consectetur eu augue nec, laoreet viverra augue. Curabitur quis nisi nec enim tempor tincidunt sit amet eu elit. Aliquam metus massa, vehicula vel nisi quis, eleifend hendrerit velit. Maecenas nunc nunc, ultricies non accumsan sit amet, varius non dui. Pellentesque ipsum justo, mollis et posuere at, viverra porta nisl. Cras accumsan cursus tellus luctus congue. Maecenas sed feugiat dolor. In ipsum sapien, congue vitae congue ac, cursus nec mauris. Integer fringilla mi urna, id efficitur ligula interdum quis. Ut vehicula imperdiet elit, quis condimentum est aliquam ac. Nunc tortor elit, imperdiet ac tellus ut, accumsan interdum dui. Duis fermentum tincidunt massa, sodales tempus sapien euismod quis. Vestibulum suscipit ex ex, nec euismod leo eleifend eget. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer tincidunt sodales augue, ut consequat libero blandit non. Suspendisse id dolor vel lorem bibendum luctus sit amet a odio. Vestibulum varius viverra ipsum quis rhoncus. Praesent bibendum dictum ex. Quisque eu laoreet leo.</p>
							</div>
						</div>


					</div>
				</div>
			</div>
		</main>
@endsection
