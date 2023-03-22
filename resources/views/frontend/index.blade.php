@extends('layouts.frontend.master')
@section('title', 'Home')
@section('content')

    <div class="Search-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-5 col-12">
                    <div class="form-group mb-0">
                        <input class="search-1" type="text" placeholder="Keywords (e.g. Job Title, Position...)">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12 mt-15">
                    <button class="srch-btn" type="submit">Search Now</button>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-slider">
        <div class="owl-carousel bnnr-owl owl-theme">
            <div class="item">
                <div class="featured-cities">
                    <a href="#">
                        <div class="feature-img">
                            <img src="{{asset('images/homepage/owl-bnnr/img-1.jpg')}}" alt="">
                            <div class="overly-bg"></div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="featured-text">
                            <div class="city-title">California</div>
                            <ins>125 Jobs</ins>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="featured-cities">
                    <a href="#">
                        <div class="feature-img">
                            <img src="{{asset('images/homepage/owl-bnnr/img-2.jpg')}}" alt="">
                            <div class="overly-bg"></div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="featured-text">
                            <div class="city-title">Austin</div>
                            <ins>200 Jobs</ins>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="featured-cities">
                    <a href="#">
                        <div class="feature-img">
                            <img src="{{asset('images/homepage/owl-bnnr/img-3.jpg')}}" alt="">
                            <div class="overly-bg"></div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="featured-text">
                            <div class="city-title">Los Angeles</div>
                            <ins>25 Jobs</ins>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="featured-cities">
                    <a href="#">
                        <div class="feature-img">
                            <img src="{{asset('images/homepage/owl-bnnr/img-4.jpg')}}" alt="">
                            <div class="overly-bg"></div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="featured-text">
                            <div class="city-title">San francisco</div>
                            <ins>12 Jobs</ins>
                        </div>
                    </a>
                </div>
            </div>
            <div class="item">
                <div class="featured-cities">
                    <a href="#">
                        <div class="feature-img">
                            <img src="{{asset('images/homepage/owl-bnnr/img-5.jpg')}}" alt="">
                            <div class="overly-bg"></div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="featured-text">
                            <div class="city-title">Tulsa</div>
                            <ins>190 Jobs</ins>
                        </div>
                    </a>
                </div>
            </div>
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
                            <button class="add-job" onclick="window.location.href = 'post_a_job.html';">Post a Job</button>
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
                            <img src="{{asset('images/line')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="job-categories mt-30">
                        <div class="row no-gutters">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-5')}}" alt="">
                                        <span>Web, Mobile &amp; Software Dev</span>
                                        <p>150 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-2')}}" alt="">
                                        <span>Data Science &amp; Analytics</span>
                                        <p>120 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-3')}}" alt="">
                                        <span>Admin Support</span>
                                        <p>290 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-4')}}" alt="">
                                        <span>Design &amp; Creative</span>
                                        <p>250 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-11')}}" alt="">
                                        <span>Accounting &amp; Consulting</span>
                                        <p>350 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-13')}}" alt="">
                                        <span>Writing</span>
                                        <p>90 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-14')}}" alt="">
                                        <span>Legal</span>
                                        <p>250 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-15')}}" alt="">
                                        <span>IT &amp; Networking</span>
                                        <p>150 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-9')}}" alt="">
                                        <span>Sales &amp; Marketing</span>
                                        <p>110 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-16')}}" alt="">
                                        <span>Customer Service</span>
                                        <p>310 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-17')}}" alt="">
                                        <span>Translation</span>
                                        <p>410 Jobs</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="p-category">
                                    <a href="#" title="">
                                        <img src="{{asset('images/homepage/categories/icon-7')}}" alt="">
                                        <span>Engineering &amp; Architecture</span>
                                        <p>190 Jobs</p>
                                    </a>
                                </div>
                            </div>
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
                            <img src="{{asset('images/line')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="lts-jobs-slider">
                        <div class="owl-carousel jobs-owl owl-theme">
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                            <div class="job-ut-dts">
                                                <a href="#"><h4>John Doe</h4></a>
                                                <span><i class="fas fa-map-marker-alt"></i> New York City</span>
                                            </div>
                                        </div>
                                        <div class="job-right-dt">
                                            <div class="job-price">$599</div>
                                            <div class="job-fp">Full Time</div>
                                        </div>
                                    </div>
                                    <div class="job-des-dt">
                                        <h4>UX Designer</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        <div class="job-skills">
                                            <a href="#">UX</a>
                                            <a href="#">UI</a>
                                            <a href="#">Photoshop</a>
                                            <a href="#" class="more-skills">+4</a>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="{{asset('images/homepage/latest-jobs/img-2.jpg')}}" alt="">
                                            <div class="job-ut-dts">
                                                <a href="#"><h4>Johnson Smith</h4></a>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                        <div class="job-right-dt">
                                            <div class="job-price">$50/hr</div>
                                            <div class="job-fp job-prt">Part Time</div>
                                        </div>
                                    </div>
                                    <div class="job-des-dt">
                                        <h4>PHP Developer</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        <div class="job-skills">
                                            <a href="#">Php</a>
                                            <a href="#">Sql</a>
                                            <a href="#">Javascript</a>
                                            <a href="#" class="more-skills">+4</a>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="{{asset('images/homepage/latest-jobs/img-3.jpg')}}" alt="">
                                            <div class="job-ut-dts">
                                                <a href="#"><h4>Envato</h4></a>
                                                <span><i class="fas fa-map-marker-alt"></i> Australia</span>
                                            </div>
                                        </div>
                                        <div class="job-right-dt">
                                            <div class="job-price">$900</div>
                                            <div class="job-fp">Full Time</div>
                                        </div>
                                    </div>
                                    <div class="job-des-dt">
                                        <h4>Wordpress Developer</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        <div class="job-skills">
                                            <a href="#">Html</a>
                                            <a href="#">Css</a>
                                            <a href="#">Wordpress</a>
                                            <a href="#" class="more-skills">+4</a>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="{{asset('images/homepage/latest-jobs/img-4.jpg')}}" alt="">
                                            <div class="job-ut-dts">
                                                <a href="#"><h4>Joy Smith</h4></a>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                        <div class="job-right-dt">
                                            <div class="job-price">$500</div>
                                            <div class="job-fp">Full Time</div>
                                        </div>
                                    </div>
                                    <div class="job-des-dt">
                                        <h4>Graphic Designer</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        <div class="job-skills">
                                            <a href="#">Illistrator</a>
                                            <a href="#">Photoshop</a>
                                            <a href="#" class="more-skills">+4</a>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="{{asset('images/homepage/latest-jobs/img-5.jpg')}}" alt="">
                                            <div class="job-ut-dts">
                                                <a href="#"><h4>Jassica William</h4></a>
                                                <span><i class="fas fa-map-marker-alt"></i> Australia</span>
                                            </div>
                                        </div>
                                        <div class="job-right-dt">
                                            <div class="job-price">$300</div>
                                            <div class="job-fp">Full Time</div>
                                        </div>
                                    </div>
                                    <div class="job-des-dt">
                                        <h4>Data Science &amp; Analytics</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        <div class="job-skills">
                                            <a href="#">Delivery</a>
                                            <a href="#">Local</a>
                                            <a href="#">Graduation</a>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt">
                                        <div class="job-left-dt">
                                            <img src="{{asset('images/homepage/latest-jobs/img-6.jpg')}}" alt="">
                                            <div class="job-ut-dts">
                                                <a href="#"><h4>Gambolthemes</h4></a>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                        <div class="job-right-dt">
                                            <div class="job-price">$60/hr</div>
                                            <div class="job-fp">Full Time</div>
                                        </div>
                                    </div>
                                    <div class="job-des-dt">
                                        <h4>Front End Developer</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        <div class="job-skills">
                                            <a href="#">Html</a>
                                            <a href="#">Css</a>
                                            <a href="#">Boostrap</a>
                                            <a href="#" class="more-skills">+4</a>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                            <li><a href="job_single_view.html" class="link-j1" title="View Job">View Job</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="view-links" onclick="window.location.href = '#';">BROWSE ALL JOBS</button>
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
                            <img src="{{asset('images/line')}}" alt="">
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
                            <img src="{{asset('images/line')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="lts-jobs-slider">
                        <div class="owl-carousel jobs-owl owl-theme">
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="{{asset('images/homepage/candidates/img-1.jpg')}}" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>John Doe</h4></a>
                                                <span>UX Designer</span>
                                                <div class="avialable">Available Full Time</div>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">$50/hr</div>
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
                                                <span><i class="fas fa-map-marker-alt"></i> New York City</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="other_freelancer_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="{{asset('images/homepage/candidates/img-2.jpg')}}" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>Albert Dua</h4></a>
                                                <span>Wordpress Developer</span>
                                                <div class="avialable">Available Full Time</div>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">$50/hr</div>
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
                                                <span><i class="fas fa-map-marker-alt"></i> Australia</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="other_freelancer_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="{{asset('images/homepage/candidates/img-3.jpg')}}" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>Rock William</h4></a>
                                                <span>Php Developer</span>
                                                <div class="avialable">Available Full Time</div>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">$60/hr</div>
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
                                                <span>5.0</span>
                                            </div>
                                        </div>
                                        <div class="right-location">
                                            <div class="text-left">
                                                <div class="rtitle">Location</div>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="other_freelancer_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="{{asset('images/homepage/candidates/img-4.jpg')}}" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>Joy Smith</h4></a>
                                                <span>Android Developer</span>
                                                <div class="avialable">Available Full Time</div>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">$60/hr</div>
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
                                                <span>5.0</span>
                                            </div>
                                        </div>
                                        <div class="right-location">
                                            <div class="text-left">
                                                <div class="rtitle">Location</div>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="other_freelancer_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="{{asset('images/homepage/candidates/img-5.jpg')}}" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>Sanaya Sharma</h4></a>
                                                <span>Accountant manager</span>
                                                <div class="avialable">Available Full Time</div>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">$30/hr</div>
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
                                                <span>4.0</span>
                                            </div>
                                        </div>
                                        <div class="right-location">
                                            <div class="text-left">
                                                <div class="rtitle">Location</div>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="other_freelancer_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="job-item">
                                    <div class="job-top-dt1 text-center">
                                        <div class="job-center-dt">
                                            <img src="{{asset('images/homepage/candidates/img-6.jpg')}}" alt="">
                                            <div class="job-urs-dts">
                                                <a href="#"><h4>Jass Singh</h4></a>
                                                <span>Front End Developer</span>
                                                <div class="avialable">Available Full Time</div>
                                            </div>
                                        </div>
                                        <div class="job-price hire-price">$25/hr</div>
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
                                                <span>5.0</span>
                                            </div>
                                        </div>
                                        <div class="right-location">
                                            <div class="text-left">
                                                <div class="rtitle">Location</div>
                                                <span><i class="fas fa-map-marker-alt"></i> India</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="job-buttons">
                                        <ul class="link-btn">
                                            <li><a href="other_freelancer_profile.html" class="link-j1" title="View Profile">View Profile</a></li>
                                            <li><a href="#" class="link-j1" title="Hire Me">Hire Me</a></li>
                                            <li class="bkd-pm">
                                                <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="view-links" onclick="window.location.href = '#';">SEE ALL CANDIDATES</button>
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
                            <img src="{{asset('images/line')}}" alt="">
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
                            <img src="{{asset('images/line')}}" alt="">
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
