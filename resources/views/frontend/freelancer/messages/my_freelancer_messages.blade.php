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


                                                    @foreach($leftwallmessages as $data)
												<li class="active">
													<div class="usr-msg-details">
                                                        <a href="{{route('freelancer_texting',[$data->id])}}">
														<div class="usr-ms-img">
															<img src="images/messages/dp-1.jpg" alt="">
															<span class="msg-status"></span>
														</div>
														<div class="usr-mg-info">
{{--															<h3>Johnson Smith</h3>--}}
                                                            <h3>{{$data->first_name}} </h3>
                                                            <p>{{$latestMessage}} <p>
{{--															<p>Thanks for the hired me...</p>--}}
														</div><!--usr-mg-info end-->
														<span class="posted_time">1:55 PM</span>
														<span class="msg-notifc">1</span>
													</div><!--usr-msg-details end-->
												</li>
                                                    @endforeach
											</ul>
										</div><!--messages-list end-->
									</div><!--msgs-list end-->
								</div>
							</div>
						</div><!--messages-sec end-->

					</div>
				</div>
			</div>
		</main>
@endsection
