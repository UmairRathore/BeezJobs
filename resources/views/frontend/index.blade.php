@extends('layouts.frontend.master')
@section('title', 'Home')

@section('content')
    <style>
        #search_suggestions_dropdown {
            width: 100%;
            /*height: 200px;*/
            overflow-y: scroll; /* add a scrollbar if content overflows the height */
        }
        .dropdown-menu {
            width: 400px;
            height: auto;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            border: none;
        }

        .dropdown-menu li {
            padding: 5px;
        }

        .dropdown-menu li:hover {
            background-color: #f5f5f5;
        }

        .dropdown-menu h3 {
            margin-bottom: 5px;
            font-size: 18px;
        }

        .dropdown-menu p {
            margin-bottom: 0;
            font-size: 14px;
            color: #666;
        }
        .dropdown-menu li a {
            color: black;
        }
    </style>


    <div class="banner-slider">
        <div class="owl-carousel bnnr-owl owl-theme">
            @foreach($cities as $city)
                <div class="item">

                    <div class="featured-cities">
                        <a href="{{ route('browse_freelancers') }}?location={{ $city->city }}">
                            <div class="feature-img">
                                <img src="{{asset($city->c_image)}}" style="height:300px" alt="">
                                <div class="overly-bg"></div>
                            </div>
                        </a>
                        <a href="{{ route('browse_freelancers') }}?location={{ $city->city }}">
                            <div class="featured-text">
                                <div class="city-title">{{$city->city}}</div>
                                {{--                                <form>--}}
                                {{--                                <input type="hidden" name="location" value="$city->city">--}}
                                <?php
                                $citycount = \App\Models\User::where('status',1)->where('role_id',2)->where('location', 'like', '%'.$city->city.'%')->count();
                                ?>
                                <ins>{{$citycount}} Freelancers</ins>
                                {{--                                </form>--}}
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
                            @if(auth()->check())
                            <a href="{{route('post_a_job')}}">
                                <button class="add-job">Post a Job</button>
                            </a>
                                @endif
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
                            @php
                                $limit = 4; // Set the limit for the number of categories to show
                                $count = 0;
                            @endphp
                            @foreach($professions as $profession)
                                @if($count < $limit)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="p-category">
                                            <a href="{{route('browse_freelancers')}}?category={{ $profession->id }}" title="">
                                                <img src="{{$profession->p_image}}" alt="">
                                                <span>{{$profession->profession}}</span>
                                                <?php
                                                $professioncount = \App\Models\User::where('profession_id', $profession->id)->count();
                                                ?>
                                                <p>{{$professioncount}}</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button class="view-links" onclick="window.location.href = '{{route('browse_categories')}}';">BROWSE ALL Categories</button>
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
                                                @if($job->profile_image)
                                                    <img src="{{asset($job->profile_image)}}" alt="">
                                                @else
                                                    <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                                @endif
                                                <div class="job-ut-dts">
                                                    <a href="{{route('other_freelancer_profile',[$job->user_id])}}"><h4>{{$job->first_name.' '.$job->last_name}}</h4></a>
                                                    <span><i class="fas fa-map-marker-alt"></i> {{$job->location}}</span>
                                                </div>
                                            </div>
                                            <div class="job-right-dt">
                                                <div class="job-price">${{$job->budget}}</div>
{{--                                                <div class="job-fp">{{$job->time_of_day}}</div>--}}
                                            </div>
                                        </div>
                                        <div class="job-des-dt">
                                            <h4>{{$job->profession}}</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam cursus pulvinar dolor nec...</p>
                                        </div>
                                        <div class="job-buttons">
                                            <ul class="link-btn">
                                                <li><a href="{{route('job_single_view',[$job->id])}}" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                <li><a href="{{route('job_single_view',[$job->id])}}" class="link-j1" title="View Job">View Job</a></li>
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
                                                @if($user->profile_image)
                                                    <img src="{{asset($user->profile_image)}}" alt="">
                                                @else
                                                    <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                                @endif
                                                <div class="job-urs-dts">
                                                    <a href="{{route('other_freelancer_profile',[$user->id])}}"><h4>{{$user->first_name.' '.$user->last_name}}</h4></a>
                                                    <span>{{$user->profession}}</span>
                                                    <div class="job-desc">
                                                        <p>{{ $user->tagline }}</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="job-price hire-price">${{$user->pay_rate}}</div>
                                        </div>
                                        <div class="rating-location">
                                            <div class="left-rating">
                                                <div class="rtitle">Rating</div>
                                                <div class="star">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $user->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                    @if($user->rating)
                                                    <span>{{ $user->rating }}</span>
                                                        @else
                                                            <span>0</span>
                                                        @endif
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
                                                <li><a href="{{route('other_freelancer_profile',[$user->id])}}" class="link-j1" title="View Profile">View Profile</a></li>
                                                @if(auth()->check())
                                                <li><a href="{{route('freelancer_texting',[$user->id])}}" class="link-j1" title="Hire Me">Hire Me</a></li>
                                                @else
                                                <li><a href="{{route('signup')}}" class="link-j1" title="Hire Me">Hire Me</a></li>
                                                @endif
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
                        <p>                        Effortlessly advertise your job opportunities and reach a wider audience. Our user-friendly platform makes posting jobs quick and hassle-free.</p>
                    </div>
                    <div class="text-steps">
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Hire for your company.
                            </div>
                            <p>                        Discover top-tier talent that aligns perfectly with your company's goals. Our comprehensive hiring solutions streamline the process, ensuring you find the best fit for your team.

                            <p>
                        </div>
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Daily out reach to qualified matches.
                            </div>
                            <p>Experience the ease of daily outreach to qualified candidates who meet your specific criteria. Our proactive approach ensures you're connected with the right individuals for your job listings.
                            <p>
                        </div>
{{--                        <div class="btns15">--}}
{{--                            <button class="btn-152" onclick="window.location.href = '{{route('post_a_job')}}';">Post a Job</button>--}}
{{--                            <button class="btn-153" onclick="window.location.href = '#';">Learn More</button>--}}
{{--                        </div>--}}
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
                        <p>
                            Showcase your skills to companies seeking remote talent. Increase your visibility and find exciting remote job opportunities with ease.                        </p>
                    </div>
                    <div class="text-steps">
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Get your profile listed.
                            </div>
                            <p>
                                Ensure your profile stands out to potential employers. Our platform allows you to create a compelling profile that highlights your expertise and experience.
                            <p>
                        </div>
                        <div class="text-step1">
                            <div class="btext-heading">
                                <i class="far fa-check-circle"></i>Customize your profile.
                            </div>
                            <p>
                                Tailor your profile to reflect your unique strengths and qualifications. Stand out from the crowd by presenting a customized profile that captures the attention of hiring managers.
                            <p>
                        </div>
{{--                        <div class="btns15">--}}
{{--                            <button class="btn-152" onclick="window.location.href = '{{'post_a_service'}}';">Get Listed</button>--}}
{{--                            <button class="btn-153" onclick="window.location.href = '#';">Learn More</button>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('search')

    <script>

            $(document).ready(function () {
            var url = window.location.href;
            // console.log(url);
            $('.nav-item a[href="' + url + '"]').addClass('active');
        });

        $(document).ready(function () {
            $('#search_input').keyup(function () {
                var searchTerm = $(this).val();
                $.ajax({
                    url: '{{ route("autocomplete") }}',
                    dataType: 'json',
                    data: {
                        q: searchTerm
                    },
                    success: function (data) {
                        $('#search_suggestions_dropdown').html('');
                        $.each(data, function (index, value) {
                            $('#search_suggestions_dropdown').append('<li><a href="#">' + value.category + '</a></li>');
                        });
                        $('#search_suggestions_dropdown').show();
                    }
                });
            });

            $(document).click(function (event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('#search_suggestions_dropdown').hide();
                }
            });

            $('#search_suggestions_dropdown').on('click', 'li a', function () {
                var suggestion = $(this).text();
                $('#search_input').val(suggestion);
                $('#search_suggestions_dropdown').hide();
                $('form').submit();
                return false;
            });
        });
    </script>
@endsection
