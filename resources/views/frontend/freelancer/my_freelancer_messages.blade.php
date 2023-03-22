@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')


		<!-- Title Start -->
		<div class="t
itle-bar">			
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
						<div class="messages-sec">
							<div class="row no-gutters">
								<div class="col-xl-4">
									<div class="msgs-list mb30">
										<div class="msg-title1">
											<div class="srch_br">
												<input class="list_search" type="text" placeholder="Search">
												<i class="fas fa-search list_srch_icon"></i>											
											</div>
										</div><!--msg-title end-->
										<div class="messages-list scrollstyle_4">
											<ul>
												<li class="active">
													<div class="usr-msg-details">
														<div class="usr-ms-img">
															<img src="images/messages/dp-1.jpg" alt="">
															<span class="msg-status"></span>
														</div>
														<div class="usr-mg-info">
															<h3>Johnson Smith</h3>
															<p>Thanks for the hired me...</p>
														</div><!--usr-mg-info end-->
														<span class="posted_time">1:55 PM</span>
														<span class="msg-notifc">1</span>
													</div><!--usr-msg-details end-->
												</li>
												<li>
													<div class="usr-msg-details">
														<div class="usr-ms-img">
															<img src="images/messages/dp-2.jpg" alt="">
															<span class="msg-status"></span>
														</div>
														<div class="usr-mg-info">
															<h3>Rock William</h3>
															<p>Thanks</p>
														</div><!--usr-mg-info end-->
														<span class="posted_time">1:55 PM</span>
													</div><!--usr-msg-details end-->
												</li>
												<li>
													<div class="usr-msg-details">
														<div class="usr-ms-img">
															<img src="images/messages/dp-3.jpg" alt="">
															<span class="msg-status"></span>
														</div>
														<div class="usr-mg-info">
															<h3>Jass Singh</h3>
															<p>Payment Received?</p>
														</div><!--usr-mg-info end-->
														<span class="posted_time">1:55 PM</span>
													</div><!--usr-msg-details end-->
												</li>
												<li>
													<div class="usr-msg-details">
														<div class="usr-ms-img">
															<img src="images/messages/dp-4.jpg" alt="">
															<span class="msg-status"></span>
														</div>
														<div class="usr-mg-info">
															<h3>Norman Kenney</h3>
															<p>Hi! How are you?</p>
														</div><!--usr-mg-info end-->
														<span class="posted_time">1:55 PM</span>
													</div><!--usr-msg-details end-->
												</li>												
											</ul>
										</div><!--messages-list end-->
									</div><!--msgs-list end-->
								</div>
								<div class="col-xl-8 col-md-12 mission-slider">
									<div class="main-conversation-box">
										<div class="message-bar-head">
											<div class="usr-msg-details">
												<div class="usr-ms-img">
													<img src="images/messages/dp-1.jpg" alt="">
												</div>
												<div class="usr-mg-info">
													<h3>John Doe</h3>
													<p>Online</p>
												</div><!--usr-mg-info end-->
											</div>
											<a href="#" title="" class="ed-opts-open"><i class="far fa-trash-alt"></i></a>											
										</div><!--message-bar-head end-->
										<div class="messages-line scrollstyle_4">											
											<div class="mCustomScrollbar">											
												<div class="main-message-box ta-right">
													<div class="message-dt">
														<div class="message-inner-dt">
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
														</div><!--message-inner-dt end-->
														<span>Sat, Aug 23, 1:08 PM</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
												<div class="main-message-box st3">
													<div class="message-dt st3">
														<div class="message-inner-dt">
															<p>Cras ultricies ligula.</p>
														</div><!--message-inner-dt end-->
														<span>5 minutes ago</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
												<div class="main-message-box ta-right">
													<div class="message-dt">
														<div class="message-inner-dt">
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
														</div><!--message-inner-dt end-->
														<span>Sat, Aug 23, 1:08 PM</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
												<div class="main-message-box st3">
													<div class="message-dt st3">
														<div class="message-inner-dt">
															<p>Lorem ipsum dolor sit amet</p>
														</div><!--message-inner-dt end-->
														<span>2 minutes ago</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
												<div class="main-message-box ta-right">
													<div class="message-dt">
														<div class="message-inner-dt">
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
														</div><!--message-inner-dt end-->
														<span>Sat, Aug 23, 1:08 PM</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
												<div class="main-message-box st3">
													<div class="message-dt st3">
														<div class="message-inner-dt">
															<p>....</p>
														</div><!--message-inner-dt end-->
														<span>Typing...</span>
													</div><!--message-dt end-->
												</div><!--main-message-box end-->
											</div>
										</div><!--messages-line end-->
										<div class="message-send-area">
											<form>
												<div class="mf-field">
													<input type="text" name="message" placeholder="Type a message here">
													<button type="submit">Send</button>
												</div>
											</form>
										</div><!--message-send-area end-->
									</div><!--main-conversation-box end-->
								</div>
							</div>
						</div><!--messages-sec end-->
				
					</div>																																						
				</div>
			</div>					
		</main>
@endsection
