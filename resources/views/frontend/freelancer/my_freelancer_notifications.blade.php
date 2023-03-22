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
								<h4>Notification</h4>								
							</div>
							<div class="notification_body">
								<div class="user-request-list">
									<div class="request-users">
										<div class="user-request-dt">
											<div class="noti-icon"><i class="fas fa-users"></i></div>
											<div class="dash_noti">
												<div class="user-title3">Rock William </div>
												<p>applied for a <a href="#" class="noti-p-link">Php Developer</a>.</p>
											</div>															
										</div>
										<div class="time5">2 min ago</div>
									</div>											
								</div>
								<div class="user-request-list">
									<div class="request-users">
										<div class="user-request-dt">
											<div class="noti-icon"><i class="fas fa-exclamation"></i></div>
											<div class="dash_noti">
												<p class="mt-2">Your job listing<a href="#" class="noti-p-link">Wordpress Developer</a>is expiring.</p>
											</div>															
										</div>
										<div class="time5">2 min ago</div>
									</div>											
								</div>
								<div class="user-request-list">
									<div class="request-users">
										<div class="user-request-dt">
											<div class="noti-icon"><i class="fas fa-bullseye"></i></div>
											<div class="dash_noti">
												<div class="user-title3">Johnson Smith</div>
												<p>placed a bid on your <a href="#" class="noti-p-link">I Need Travel Wordpress Theme</a>project.</p>
											</div>															
										</div>
										<div class="time5">2 min ago</div>
									</div>											
								</div>
								<div class="user-request-list">
									<div class="request-users">
										<div class="user-request-dt">
											<div class="noti-icon"><i class="fas fa-hands-helping"></i></div>
											<div class="dash_noti">
												<div class="user-title3">Joy Doe</div>
												<p>hired you for a<a href="#" class="noti-p-link">Web App Development</a>project.</p>
											</div>															
										</div>
										<div class="time5">2 min ago</div>
									</div>											
								</div>
								<div class="user-request-list">
									<div class="request-users">
										<div class="user-request-dt">
											<div class="noti-icon"><i class="fas fa-star"></i></div>
											<div class="dash_noti">
												<div class="user-title3">Jassica</div>
												<p>left you a rating after finish a<a href="#" class="noti-p-link">Real Estate Wordpress</a>project.</p>
											</div>															
										</div>
										<div class="time5">2 min ago</div>
									</div>											
								</div>
								<div class="user-request-list">
									<div class="request-users">
										<div class="user-request-dt">
											<div class="noti-icon"><i class="fas fa-bullseye"></i></div>
											<div class="dash_noti">
												<div class="user-title3">Albert Dua</div>
												<p>accpted your bid on<a href="#" class="noti-p-link">Hotel Andriod App</a>project.</p>
											</div>															
										</div>
										<div class="time5">2 min ago</div>
									</div>											
								</div>
								
							</div>
						</div>												
					</div>																																						
				</div>
			</div>					
		</main>
@endsection
