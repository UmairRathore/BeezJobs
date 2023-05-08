@extends('layouts.frontend.master')
@section('title', 'Freelancer Portfolio')


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
                            @include('frontend.freelancer.my_freelancer.layout.my_freelancer_navbar')                        </div>
						<div class="portfolio_heading">
							<div class="portfolio_left">
								<h4>Portfolio</h4>
							</div>
							@if (session('alert'))
								<div class="alert alert-danger">
									{{ session('alert') }}
								</div>
							@endif
							<div class="portfolio_right">
								<button class="add_portfolio_btn" type="button" data-toggle="modal" data-target="#addportfolioModal">Add Portfolio</button>
							</div>
						</div>
						<div class="dsh150">
							<div class="row">
								@foreach($portfolios as $portfolio)
								<div class="col-lg-4">
									<div class="portfolio_item">
										<div class="portfolio_img">
											<img src="{{$portfolio->file}}" alt="">
											<div class="portfolio_overlay">
												<div class="overlay_items">
													<a href="#" target="_blank"><i class="fas fa-external-link-alt"></i>Live Preview</a>

													<a href="{{ URL('delete_freelancer_portfolio/'.$portfolio->id )}}"><button class="delete_portfolio_btn"><i class="far fa-trash-alt"></i></button></a>
												</div>
											</div>
										</div>
										<div class="portfolio_title"><i class="fas fa-image"></i>{{$portfolio->title}}</div>
									</div>
								</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="apply_job_form">
			<div class="modal fade" id="addportfolioModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-jb" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Add Portfolio</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="{{route('add_freelancer_portfolio')}}" enctype="multipart/form-data">
								@csrf
							<div class="jb_frm">
								<h3>Simple & Best Way To Showcase Your Work</h3>
								<div class="form_inputs">
									<div class="form-group">
										<input type="text" class="job-input" name="title" placeholder="Title">
									</div>
									<div class="form-group">
										<input type="text" class="job-input" name="link" placeholder="website link">
									</div>
									<div class="form-group">
										<input type="file" name="file" id="file2">

									</div>
								</div>
								<div class="apply_btn150">
									<button class="apply_job50" type="submit">Add Portfolio</button>
									<button class="apply_job_close" type="button" data-dismiss="modal">CANCEL</button>
								</div>
							</div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>

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
