@extends('layouts.frontend.master')
@section('title', 'Freelancer Profile')



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
                        @include('frontend.freelancer.my_freelancer.layout.my_freelancer_navbar')
                    </div>
                    <a href="{{route('my_freelancer_setting')}}" class="edit_link_profile"><i class="far fa-edit"></i>Edit Profile</a>
                    <div class="view_chart">
                        <div class="view_chart_header">
                            <h4>Services</h4>
                        </div>
                        <div class="view_chart_body">
                            @isset($service)
                            <!-- Added HTML -->
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="view_details">
                                        <ul>
                                            <li>
                                                <div class="vw_items">
                                                    <i class="far fa-money-bill-alt"></i>
                                                    <div class="vw_item_text">
                                                        <h6>Hourly Rate</h6>
                                                        <span>${{ $service->hourly_rate }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="vw_items">
                                                    <i class="far fa-clock"></i>
                                                    <div class="vw_item_text">
                                                        <h6>Posted Date</h6>
                                                        <span>{{ $service->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="job-item ptrl_2 mt-20">
                                        <div class="job-top-dt">
                                            <div class="job-left-dt">
                                                @if($service->profile_image)
                                                    <img src="{{ asset($service->profile_image) }}" alt="">
                                                @else
                                                    <img src="{{ asset('images/homepage/latest-jobs/img-1.jpg') }}" alt="">
                                                @endif
                                                <div class="job-ut-dts">
                                                    <a href="{{ route('other_freelancer_profile', [$service->user_id]) }}"><h4>{{ $service->fname.' '.$service->lname }}</h4></a>
                                                    <span><i class="fas fa-map-marker-alt"></i>{{ $service->location }}</span>
                                                </div>
                                            </div>
                                            <div class="job-right-dt">
                                                <div class="job-price">${{ $service->hourly_rate }}</div>
                                            </div>
                                        </div>
                                        <div class="job_dts">
                                            <h4>Description</h4>
                                            <div>
                                                <p style="color: black">{{ $service->description }}</p>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="job_dts">
                                            <h4>Packages</h4>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <h6>Basic Package</h6>
                                                        <div>
                                                            <p>${{ $service->basic_price }}</p>
                                                            <p>{{ $service->basic_description }}</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h6>Standard Package</h6>
                                                        <div>
                                                            <p>${{ $service->standard_price }}</p>
                                                            <p>{{ $service->standard_description }}</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <h6>Premium Package</h6>
                                                        <div>
                                                            <p>${{ $service->premium_price }}</p>
                                                            <p>{{ $service->premium_description }}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Added HTML -->                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </main>

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
