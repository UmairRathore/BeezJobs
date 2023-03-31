@extends('layouts.frontend.master')
@section('title', 'Home')
@section('content')




<!-- Title Star
t -->





<div class="title-bar">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<ol class="title-bar-text">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Browser Jobs</li>
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
					<div class="col-lg-4 col-md-5">
                        <form method="get" action="{{route('browse_jobs')}}">


                            <div class="browser-job-filters">
                                <div class="filter-heading">
                                    <div class="fh-left">
                                        Filters
                                    </div>
                                    <div class="fh-right">
                                        <a href="#">Clear All Filters</a>
                                    </div>
                                </div>


                                <div class="fltr-group">
                                    <div class="fltr-items-heading">
                                        <div class="fltr-item-left">
                                            <h6>Category</h6>
                                        </div>
                                        <div class="fltr-item-right">
                                            <a href="#">Clear</a>
                                        </div>
                                    </div>

                                    <div class="inline fields">
                                        <div class="field">
                                            <label></label>
                                            <select class="ui fluid dropdown" name="category">
                                                <option value="">Select a category...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->profession }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="fltr-group">
                                    <div class="fltr-items-heading">
                                        <div class="fltr-item-left">
                                            <h6>Pay Rate <span>($)</span></h6>
                                        </div>
                                        <div class="fltr-item-right">
                                            <a href="#">Clear</a>
                                        </div>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="rg-slider">
                                            <input class="rn-slider slider-input" type="range" min="0" max="1000" step="1"  name="pay_rate_range"/>

                                            {{--                                    <input class="rn-slider slider-input" type="range" value="5,500"/>--}}
                                        </div>
                                        <div class="rg-limit">
                                            <h4>5</h4>
                                            <h4>5000</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="fltr-group fltr-gend">
                                    <div class="fltr-items-heading">
                                        <div class="fltr-item-left">
                                            <h6>Location</h6>
                                        </div>
                                        <div class="fltr-item-right">
                                            <a href="#">Clear</a>
                                        </div>
                                    </div>
                                    <input id="location" class="job-input" type="text" name="location" placeholder="Enter a location">
                                </div>
                                <div class="filter-button">
                                    <button type="submit" class="flr-btn">Search Now</button>
                                </div>
                            </div>
                        </form>
					</div>
					<div class="col-lg-8 col-md-7 mainpage">

						<div class="main-tabs">
							<div class="res-tabs">
								<div class=" mtab-left">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a href="#tab-1" class="nav-link active" data-toggle="tab">Newest Jobs</a>
										</li>
									</ul>
								</div>
								<div class=" mtab-right">
									<ul>
										<li class="grid-list">
											<button class="gl-btn" id="grid"><i class="fas fa-th-large"></i></button>
											<button class="gl-btn" id="list"><i class="fas fa-th-list"></i></button>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="tab-1">
									<div class="row  view-group" id="products">
                                        @foreach($jobs as $key => $job)
										<div class="lg-item col-lg-6 col-xs-6 grid-group-item1">
											<div class="job-item mt-30">
												<div class="job-top-dt">
													<div class="job-left-dt">
                                                        @if($job->profile_image)
														<img src="{{asset($job->profile_image)}}" alt="">
                                                        @else
														<img src="images/homepage/latest-jobs/img-1.jpg" alt="">
                                                            @endif
														<div class="job-ut-dts">
															<a href="#"><h4>{{$job->first_name.' '.$job->last_name}}</h4></a>
															<span><i class="fas fa-map-marker-alt"></i> {{$job->location}}</span>
														</div>
													</div>
													<div class="job-right-dt">
														<div class="job-price">${{$job->budget}}</div>
														<div class="job-fp">{{$job->time_of_day}}</div>
													</div>
												</div>
												<div class="job-des-dt">
													<h4>{{$job->profession}}</h4>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
												</div>
												<div class="job-buttons">
													<ul class="link-btn">
														<li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                        <li><a href="{{route('job_single_view')}}" class="link-j1" title="View Job">View Job</a></li>
														<li class="bkd-pm"><button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button></li>
													</ul>
												</div>
											</div>
										</div>
                                        @endforeach
										<div class="col-12">
											<div class="main-p-pagination">
												<nav aria-label="Page navigation example">
													<ul class="pagination">
														<li class="page-item">
															<a class="page-link" href="#" aria-label="Previous">
																PREV
															</a>
														</li>
														<li class="page-item"><a class="page-link active" href="#">1</a></li>
														<li class="page-item"><a class="page-link" href="#">2</a></li>
														<li class="page-item"><a class="page-link" href="#">...</a></li>
														<li class="page-item"><a class="page-link" href="#">24</a></li>
														<li class="page-item">
															<a class="page-link" href="#" aria-label="Next">
																NEXT
															</a>
														</li>
													</ul>
												</nav>
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
		<!-- Body End -->
@endsection
