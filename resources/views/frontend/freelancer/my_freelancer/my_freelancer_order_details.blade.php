@extends('layouts.frontend.master')
@section('title', 'Freelancer Bids')



@section('content')
    <style>

        .timerclock {
            text-align: center;
            font-size: 40px;
            margin-top: 0px;
        }

        .countdown {
            text-transform: uppercase;
            font-weight: bold;
        }

        .countdown span {
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 3rem;
            margin-left: 0.8rem;
        }

        .countdown span:first-of-type {
            margin-left: 0;
        }

        .countdown-circles {
            text-transform: uppercase;
            font-weight: bold;
        }

        .countdown-circles span {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .countdown-circles span:first-of-type {
            margin-left: 0;
        }
    </style>

    <!-- Title Start -->
    <div class="title-bar">
        <div class="
container">
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
                    <div class="jobs_manage">
                            <div class="col-lg-12">
                                        <div class="view_chart">
                                            <div class="view_chart_header">
                                                <h4>Order Details</h4>
                                            </div>
                                            <div class="job_bid_body">
                                                <ul class="all_applied_jobs jobs_bookmarks">
                                                    <li>
                                                        <div class="applied_candidates_item">

                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <h3>Buyer Information</h3>
                                                                    <div class="applied_candidates_dt">
                                                                        <div class="candi_img">
                                                                            @if($order->sender_profile_image)
                                                                                <img src="{{$order->sender_profile_image}}" alt="">
                                                                            @else
                                                                                <img src="images/homepage/candidates/img-1.jpg" alt="">
                                                                            @endif
                                                                        </div>
                                                                        <div class="candi_dt">
                                                                            <a href="#">{{$order->sender_first_name.' '.$order->sender_last_name}}</a>
                                                                            <?php

                                                                            $profession = \App\Models\User::find($order->user_sender_id)->leftjoin('professions', 'professions.id', '=', 'users.profession_id')->first();
                                                                            //                                                                            dd($profession);
                                                                            ?>
                                                                            <div class="candi_cate">{{$profession->profession}}</div>
                                                                            <div class="rating_candi">Rating
                                                                                <div class="star">
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <span>4.9</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-6">
                                                                    <h3>Seller Information</h3>
                                                                    <div class="applied_candidates_dt">
                                                                        <div class="candi_img">
                                                                            @if($order->receiver_profile_image)
                                                                                <img src="{{$order->receiver_profile_image}}" alt="">
                                                                            @else
                                                                                <img src="images/homepage/candidates/img-1.jpg" alt="">
                                                                            @endif
                                                                        </div>
                                                                        <div class="candi_dt">
                                                                            <a href="#">{{$order->receiver_first_name.' '.$order->receiver_last_name}}</a>
                                                                            <?php

                                                                            $profession = \App\Models\User::find($order->user_receiver_id)->leftjoin('professions', 'professions.id', '=', 'users.profession_id')->first();
                                                                            //                                                                            dd($profession);
                                                                            ?>
                                                                            <div class="candi_cate">{{$profession->profession}}</div>
                                                                            <div class="rating_candi">Rating
                                                                                <div class="star">
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <i class="fas fa-star"></i>
                                                                                    <span>4.9</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 100px">
                                                            <div class="col-xl-12">
                                                                <h2> Job information</h2>
                                                                <div class="job_bid_body">
                                                                    <ul class="all_applied_jobs jobs_bookmarks">
                                                                        <li>
                                                                            <div class="applied_item">
                                                                                <a href="#">{{$order->job_title}}</a>
                                                                                <ul class="view_dt_job">
                                                                                    <li>
                                                                                        <div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$order->job_location}}</div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="vw1254"><i class="fas fa-briefcase"></i>{{$order->job_online_or_in_person}}</div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$order->offer_negotiated_price}}</div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="vw1254"><i class="far fa-clock"></i>{{$order->created_at}}</div>
                                                                                    </li>
                                                                                </ul>
                                                                                <p style="color:black; padding-top: 60px;">
                                                                                    {{$order->offer_negotiated_description}}
                                                                                </p>
                                                                            </div>
                                                                        </li>
                                                                        {{--                                                                                    @endforeach--}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 100px">
                                                            <div class="col-xl-12" style="text-align: center;">
                                                                <h2> Countdown</h2>
                                                                <div class="job_bid_body">
                                                                    <div id="countdown">
                                                                        <!-- Countdown 4-->
                                                                        <div class="rounded bg-gradient-4 text-black shadow p-5 text-center mb-5">
                                                                            {{-- <p class="mb-0 font-weight-bold text-uppercase">Let's use some call to actions</p> --}}
                                                                            <div id="clock-c" class="timerclock py-4"></div>
                                                                        </div>
                                                                    </div>


                                                                        <script>
                                                                            // Get the negotiated duration from PHP variable
                                                                            var negotiatedDuration = {!! json_encode(strtotime($order->offer_negotiated_duration) - time()) !!};

                                                                            // Convert the negotiated duration to milliseconds
                                                                            var countdownTime = negotiatedDuration * 1000;


                                                                            // Update the countdown clock every second
                                                                            var countdownClock = setInterval(function () {
                                                                                // Calculate the remaining time

                                                                                // var remainingTime =   countdownTime - Date.now() ;
                                                                                var remainingTime =  Date.now() - countdownTime;


                                                                                // Check if the countdown has ended
                                                                                if (remainingTime <= 0) {
                                                                                    document.getElementById('clock-c').innerHTML = "Countdown Finished";
                                                                                    // Perform any action when the countdown ends
                                                                                    // For example, show a message or execute a function
                                                                                    // You can customize this part as per your requirement
                                                                                    console.log('Countdown ended!');
                                                                                } else {
                                                                                    // Calculate the remaining hours, minutes, and seconds
                                                                                    var days = Math.floor(countdownTime / (1000 * 60 * 60 * 24));
                                                                                    var hours = Math.floor((countdownTime / (1000 * 60 * 60)) % 24);
                                                                                    var minutes = Math.floor((countdownTime / (1000 * 60)) % 60);

                                                                                    // Format the time values
                                                                                    var formattedTime = days + ' days ' +
                                                                                        hours.toString().padStart(2, '0') + ' hrs ' +
                                                                                        minutes.toString().padStart(2, '0') + ' mins';

                                                                                    document.getElementById('clock-c').innerHTML = formattedTime;

                                                                                    // Decrement the countdown time by 1 minute (60 seconds)
                                                                                    countdownTime -= 60000;

                                                                                    // Call the updateCountdownClock function recursively after 1 minute (60 seconds)
                                                                                    setTimeout(function() {
                                                                                        updateCountdownClock(countdownTime);
                                                                                    }, 60000);
                                                                                }
                                                                            }, 1000);
                                                                        </script>
                                                                </div>

                                                                @if($order->order_status == 'active')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Active ORDER</button>
                                                                @elseif($order->order_status == 'completed')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Completed</button>
                                                                @elseif($order->order_status == 'late-completed')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Accepted</button>
                                                                @elseif($order->order_status == 'cancelled')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Cancelled</button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                    @if($order->order_status == 'active')
                                                        @if(auth()->user()->id == $order->user_sender_id)
                                                            <li>
                                                                <h3> Submit Order Task </h3>
                                                                <form action="{{route('post_order_attempt')}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="label15">Job Description*</label>
                                                                        <textarea name="description" class="textarea_input" placeholder="Type Description"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="label15">Order Attempt File*</label>
                                                                        <input type="file" name="order_attempt_file">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <button class="post_jp_btn" type="submit">Post Order</button>
                                                                </div>
                                                            </div>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    @endif
                                                    @foreach($AttemptOrder as $Aorder)
                                                        <li>
                                                            <div>
                                                                <h4>Description:</h4>
                                                                <p>{{ $Aorder->description }}</p>
                                                            </div>
                                                            @if ($Aorder->order_attempt_file)
                                                                <div>
                                                                    <h4>Uploaded File:</h4>
                                                                    <a href="{{ Storage::url($order->order_attempt_file) }}" target="_blank">Download File</a>
                                                                </div>
                                                            @endif
                                                            @if(auth()->user()->id == $order->user_receiver_id)
                                                                @if($Aorder->accepted == 0 and $Aorder->rejected == 0)
                                                                    <div class="row">
                                                                        <form action="{{route('order_attempt_status')}}" method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$Aorder->id}}">
                                                                            <input type="hidden" name="rejected" value="1">
                                                                            <div class="col-lg-12" style="text-align: center;">
                                                                                <button class="post_jp_btn" type="submit">Reject Submission</button>
                                                                            </div>
                                                                        </form>
                                                                        <form action="{{route('order_attempt_status')}}" method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$Aorder->id}}">
                                                                            <input type="hidden" name="accepted" value="1">
                                                                            <div class="col-lg-12" style="text-align: center;">
                                                                                <button class="post_jp_btn" type="submit">Accept Submission</button>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!--accept reject form-->
                                                                @endif
                                                            @endif
                                                            @if($Aorder->rejected == 1)
                                                                <div class="col-lg-12" style="text-align: center;">
                                                                    <button class="post_jp_btn" type="submit">Submission Rejected</button>
                                                                </div>
                                                            @elseif($Aorder->accepted == 1)
                                                                <div class="col-lg-12" style="text-align: center;">
                                                                    <button class="post_jp_btn" type="submit" disabled>Submission Accepted</button>
                                                                </div>
                                                            @endif
                                                            @if(auth()->user()->id == $order->user_sender_id)
                                                                @if($Aorder->accepted == 0 and $Aorder->rejected == 0)
                                                                    <div class="col-lg-12" style="text-align: center;">
                                                                        <button class="post_jp_btn" style="pointer-events: none;" disabled>Pending</button>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </li>

                                                    @endforeach


                                                </ul>
                                            </div>
                                        </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
@section('active_tab')
    <script>
        $(document).ready(function () {
            var url = window.location.href;
            // console.log(url);
            $('.nav-item a[href="' + url + '"]').addClass('active');
        });
    </script>
@endsection
