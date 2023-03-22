@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')
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
						<a href="{{route('my_freelancer_setting')}}" class="edit_link_profile"><i class="far fa-edit"></i>Edit Profile</a>
						<div class="view_chart">
							<div class="view_chart_header">
								<h4>About</h4>
							</div>
							<div class="view_chart_body">
								<p class="user_about_des">{{auth()->user()->description}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
@endsection

