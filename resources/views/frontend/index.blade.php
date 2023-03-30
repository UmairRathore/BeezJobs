@extends('layouts.frontend.master')
@section('title', 'Home')
@section('content')

      <div class="Search-section">
        <div class="container">
            <div class="row">
                  <div class="col-lg-10 col-md-5 col-12">
                    <div class="form-group mb-0">
                        <input class="search-1" type="text" placeholder="Keywords (e.g. Location,Job Title, Position...)">
                      </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 mt-15">
                      <a href="{{route('browse_jobs')}}"><button class="srch-btn" type="submit">Search Now</button></a>
                </div>
            </div>
          </div>
    </div>
    <div class="banner-slider">
          <div class="owl-carousel bnnr-owl owl-theme">
              @foreach($cities as $city)
            <div class="item">

                <div class="featured-cities">
                <a href="{{route('browse_freelancers')}}">
                        <div class="feature-img">
                            <img src="{{asset($city->c_image)}}" style="height:300px" alt="">
                              <div class="overly-bg"></div>
                        </div>
                    </a>
                    <a href="{{route('browse_freelancers')}}">
                        <div class="featured-text">
                            <div class="city-title">{{$city->city}}</div>
                              <ins>125 Freelancers</ins>
                        </div>
                    </a>
                  </div>
            </div>
              @endforeach
         </div>
    </div>
    <div class="achivements">
         <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="achive-text">3M Registered Members</div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="achive-text">786k Jobs Found</div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">

     <div class="achive-text">1.2K Best Companies</div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <ul class="post-buttons">
                        <li>
                            <a href="{{route('post_a_job')}}"><button class="add-job">Post a Job</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="all-categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="main-heading">
                        <h2>Choose Category</h2>
                        <span>Find quality talent or agencies</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="job-categories mt-30">
                        <div class="row no-gutters">
                @foreach($professions as $profession)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="{{route('browse_jobs')}}" title="">
                                        <img src="{{$profession->p_image}}" alt="">
                                        <span>{{$profession->profession}}</span>
                                        <p>150 Jobs</p>
                                    </a>
                                </div>
                            </div>
                    @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="find-lts-jobs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="main-heading">
                        <h2>Find Latest Jobs</h2>
                        <span>Your Job for a Future</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">

                    <div class="lts-jobs-slider">
                        <div class="owl-carousel jobs-owl owl-theme">
                @foreach($jobs as $job)
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="images/homepage/latest-jobs/img-1.jpg" alt="">
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
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button class="view-links" onclick="window.location.href = '{{route('browse_jobs')}}';">BROWSE ALL JOBS</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="we-offers">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="main-heading">
                        <h2>What We Offers</h2>
                        <span>Offering the Best Deal</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="offer-step">
                        <div class="offer-text-dt">
                            <h4>Searching the Best Jobs</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum commodo mi.</p>
                            <a href="#">Read More<i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="offer-step">
                        <div class="offer-text-dt">
                            <h4>Apply for a Good Job</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum commodo mi.</p>
                            <a href="#">Read More<i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="offer-step">
                        <div class="offer-text-dt">
                            <h4>More Quality Hires</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum commodo mi.</p>
                            <a href="#">Read More<i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="offer-step">
                        <div class="offer-text-dt">
                            <h4>Choose Working Hours</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dictum commodo mi.</p>
                            <a href="#">Read More<i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="featured-candidates">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="main-heading">
                        <h2>Featured Candidates</h2>
                        <span>Discover, Intelligent, Experienced, Professional, Trustworthy, Freelancer & Full Time Candidates.</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="lts-jobs-slider">
                        <div class="owl-carousel jobs-owl owl-theme">
                            @foreach($users as $user)
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="images/homepage/candidates/img-1.jpg" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>{{$user->first_name.' '.$user->last_name}}</h4></a>
                                                <span>{{$user->profession}}</span>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">{{$user->pay_rate}}</div>
                                    </div>
                                    <div class="rating-location">
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
                                                <span><i class="fas fa-map-marker-alt"></i> {{$user->location}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="{{route('other_freelancer_profile')}}" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button class="view-links" onclick="window.location.href = '{{route('browse_freelancers')}}';">SEE ALL CANDIDATES</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-categories">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="main-heading text-left">
                        <h2>Post Jobs</h2>
                        <span>Quick and easy way to advertise.</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <div class="text152">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eu purus et diam blandit vehicula sit amet sed metus. Fusce condimentum non neque at fringilla.</p>
                    </div>
                    <div class="text-steps">
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Hire for your company.
                            </div>
                            <p>Aenean malesuada aliquet tincidunt. Nam a nisl mi. Fusce ornare fermentum enim, id interdum velit posuere quis.
                            <p>
                        </div>
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Daily out reach to qualified matches.
                            </div>
                            <p>Aenean malesuada aliquet tincidunt. Nam a nisl mi. Fusce ornare fermentum enim, id interdum velit posuere quis.
                            <p>
                        </div>
                        <div class="btns15">
                            <button class="btn-152" onclick="window.location.href = 'post_a_job.html';">Post a Job</button>
                            <button class="btn-153" onclick="window.location.href = '#';">Learn More</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="main-heading text-left mt-80">
                        <h2>Talented Candidates</h2>
                        <span>Get discoverd by companies looking to hire remote.</span>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <div class="text152">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eu purus et diam blandit vehicula sit amet sed metus. Fusce condimentum non neque at fringilla.</p>
                    </div>
                    <div class="text-steps">
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Get your profile listed.
                            </div>
                            <p>Aenean malesuada aliquet tincidunt. Nam a nisl mi. Fusce ornare fermentum enim, id interdum velit posuere quis.
                            <p>
                        </div>
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Customize your profile.
                            </div>
                            <p>Aenean malesuada aliquet tincidunt. Nam a nisl mi. Fusce ornare fermentum enim, id interdum velit posuere quis.
                            <p>
                        </div>
                        <div class="btns15">
                            <button class="btn-152" onclick="window.location.href = 'browse_freelancers.html';">Get Listed</button>
                            <button class="btn-153" onclick="window.location.href = '#';">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
