@extends('layouts.frontend.master')
@section('title', 'Freelancer Profile')



@section('content')

<!-- Header End -->
		<!-- Title Start -->
		<div class="title-bar">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<ol class="title-bar-text">
							<li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
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

					@include('frontend.freelancer.other_freelancer.other_freelancer_sidebar')

					<div class="col-lg-9 col-md-8 mainpage">
@include('frontend.freelancer.other_freelancer.other_freelancer_nav')
                        <div class="view_chart">
							<div class="view_chart_header">
								<h4>About</h4>
							</div>
							<div class="view_chart_body">
								<p class="user_about_des">
                                    {{$users->description}}
                                </p>
							</div>
						</div>


					</div>
				</div>
			</div>
		</main>
@endsection
