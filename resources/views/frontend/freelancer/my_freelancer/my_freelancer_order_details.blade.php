@extends('layouts.frontend.master')
@section('title', 'Freelancer Bids')



@section('content')


    <style>
        .accordion-item {
            margin-bottom: 10px;
        }

        .accordion-heading {
            background-color: #f5f5f5;
            padding: 10px;
            cursor: pointer;
        }

        .accordion-content {
            display: none;
            padding: 10px;
            background-color: #ffffff;
        }

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
{{--    {{dd($order)}}--}}
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

                                                                            ?>
                                                                            <div class="candi_cate">{{$profession->profession}}</div>
                                                                            <?php
                                                                            $senderReviews = \App\Models\Review::where('receiver_id',auth()->user()->id)->get();
                                                                            $ratingSum = $senderReviews->sum('rating');
                                                                            $totalReviews = $senderReviews->count();

                                                                            $averageRating = ($totalReviews > 0) ? $ratingSum / $totalReviews : 0;
                                                                            $ratingOutOfFive = round($averageRating, 2); // Round the average rating to 2 decimal places

                                                                            // Ensure the rating is within the range of 1 to 5
                                                                            $ratingOutOfFive = max(1, min(5, $ratingOutOfFive));

                                                                            //        dd($ratingOutOfFive);
                                                                            ?>
                                                                            <div class="rating_candi">Rating
                                                                                <div class="star">
                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                        @if ($i <= $ratingOutOfFive)
                                                                                            <i class="fas fa-star"></i>
                                                                                        @else
                                                                                            <i class="far fa-star"></i>
                                                                                        @endif
                                                                                    @endfor
                                                                                        @if($ratingOutOfFive)
                                                                                            <span>{{ $ratingOutOfFive }}</span>
                                                                                        @else
                                                                                            <span>0</span>
                                                                                        @endif
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
                                                                            <?php
                                                                            $ReceiverReviews = \App\Models\Review::where('receiver_id',$order->user_receiver_id)->get();
//                                                                           dd($ReceiverReviews);
                                                                            $ratingSum = $ReceiverReviews->sum('rating');
                                                                            $totalReviews = $ReceiverReviews->count();

                                                                            $averageRating = ($totalReviews > 0) ? $ratingSum / $totalReviews : 0;
                                                                            $ratingOutOfFive = round($averageRating, 2); // Round the average rating to 2 decimal places

                                                                            // Ensure the rating is within the range of 1 to 5
                                                                            $ratingOutOfFive = max(1, min(5, $ratingOutOfFive));

                                                                            //        dd($ratingOutOfFive);
                                                                            ?>
                                                                            <div class="rating_candi">Rating
                                                                                <div class="star">
                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                        @if ($i <= $ratingOutOfFive)
                                                                                            <i class="fas fa-star"></i>
                                                                                        @else
                                                                                            <i class="far fa-star"></i>
                                                                                        @endif
                                                                                    @endfor
                                                                                    <span>{{ $ratingOutOfFive }}</span>
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
                                                                                <a href="#">{{$order->offers->job_title}}</a>
                                                                                <ul class="view_dt_job">
                                                                                    <li>
                                                                                        <div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$order->offers->job_location}}</div>
                                                                                    </li>
                                                                                    <li>
                                                                                        <div class="vw1254"><i class="fas fa-briefcase"></i>{{$order->offers->job_online_or_in_person}}</div>
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
                                                                <h4> Time Remaining</h4>
                                                                <div class="job_bid_body">
                                                                    @if($order->order_status == 'active')
                                                                        <div id="countdown">
                                                                            <div class="rounded bg-gradient-4 text-black shadow p-5 text-center mb-5">
                                                                                {{-- <p class="mb-0 font-weight-bold text-uppercase">Let's use some call to actions</p> --}}
                                                                                <div id="clock-c" class="timerclock py-4" style="font-size:23px">

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{--{{dd($order->offer_negotiated_duration)}}--}}
                                                                        <script>
                                                                            // Check if the countdownTime is already stored in local storage
                                                                            var storedCountdownTime = localStorage.getItem('countdownTime');
                                                                            var countdownTime;

                                                                            if (storedCountdownTime !== null) {
                                                                                countdownTime = parseInt(storedCountdownTime);
                                                                            } else {
                                                                                countdownTime = {!! json_encode(strtotime($order->offer_negotiated_duration) * 1000) !!};
                                                                                localStorage.setItem('countdownTime', countdownTime);
                                                                            }

                                                                            // Update the countdown clock every second
                                                                            var countdownClock = setInterval(function () {
                                                                                var remainingTime = countdownTime - Date.now();

                                                                                if (remainingTime <= 0) {
                                                                                    document.getElementById('clock-c').innerHTML = "Time Finished";
                                                                                    console.log('Countdown ended!');
                                                                                    clearInterval(countdownClock);

                                                                                    // Make an AJAX request to update the order status
                                                                                    $.ajax({
                                                                                        url: '/update_order_status', // Replace with the actual URL to your server-side endpoint
                                                                                        method: 'POST', // Use the appropriate HTTP method (POST/GET) for your endpoint
                                                                                        headers: {
                                                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                                                        },
                                                                                        data: {
                                                                                            _token: $('meta[name="csrf-token"]').attr('content'),
                                                                                            orderId: {!! json_encode($order->order_id) !!}
                                                                                        },
                                                                                        success: function(response) {
                                                                                            if (response.status === 'success') {
                                                                                                // Update the order status in the HTML
                                                                                                var statusButtons = document.getElementsByClassName('apled_btn50');
                                                                                                for (var i = 0; i < statusButtons.length; i++) {
                                                                                                    statusButtons[i].innerHTML = "Pending";
                                                                                                }
                                                                                            }
                                                                                        },
                                                                                        error: function(xhr, status, error) {
                                                                                            console.log(error);
                                                                                        }
                                                                                    });

                                                                                    // Remove countdownTime from local storage when countdown ends
                                                                                    localStorage.removeItem('countdownTime');
                                                                                } else {
                                                                                    var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                                                                                    var hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);
                                                                                    var minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
                                                                                    var seconds = Math.floor((remainingTime / 1000) % 60);

                                                                                    var formattedTime = days + ' days ' +
                                                                                        hours.toString().padStart(2, '0') + ' hrs ' +
                                                                                        minutes.toString().padStart(2, '0') + ' mins ' +
                                                                                        seconds.toString().padStart(2, '0') + ' secs';

                                                                                    document.getElementById('clock-c').innerHTML = formattedTime;
                                                                                }
                                                                            }, 1000);
                                                                        </script>

                                                                    @elseif($order->order_status == 'completed')
                                                                        <div class="rounded bg-gradient-4 text-black shadow p-5 text-center mb-5">
                                                                            <h2>Completed Order</h2>
                                                                        </div>
                                                                    @elseif($order->order_status == 'late-completedlate-completed')
                                                                        <div class="rounded bg-gradient-4 text-black shadow p-5 text-center mb-5">
                                                                            <h2>Completed Order</h2>
                                                                        </div>
                                                                    @elseif($order->order_status == 'cancelled')
                                                                        <div class="rounded bg-gradient-4 text-black shadow p-5 text-center mb-5">
                                                                            <h2>Cancelled Order</h2>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                @if($order->order_status == 'completed' || $order->order_status == 'late-completed')
                                                                @if($Reviews==null && auth()->user()->id == $order->user_receiver_id)
                                                                        <div>
                                                                            <h3>Submit Review</h3>
                                                                            <form action="{{ route('review_submit') }}" method="post" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                                                                <input type="hidden" name="sender_id" value="{{ $order->user_sender_id }}">
                                                                                <input type="hidden" name="receiver_id" value="{{ auth()->user()->id }}">
                                                                                <div class="row" >

                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <label class="label15">Review*</label>
                                                                                            <textarea name="review" class="textarea_input" placeholder="Type your review"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                    <div class="star">
                                                                                    <span class="rating-value">1</span>
                                                                                        <input type="radio" id="rating5" name="rating" value="1">
                                                                                        <label for="rating5"><i class="fas fa-star"></i></label>

                                                                                        <input type="radio" id="rating4" name="rating" value="2">
                                                                                        <label for="rating4"><i class="fas fa-star"></i></label>

                                                                                        <input type="radio" id="rating3" name="rating" value="3">
                                                                                        <label for="rating3"><i class="fas fa-star"></i></label>

                                                                                        <input type="radio" id="rating2" name="rating" value="4">
                                                                                        <label for="rating2"><i class="fas fa-star"></i></label>

                                                                                        <input type="radio" id="rating1" name="rating" value="5">
                                                                                        <label for="rating1"><i class="fas fa-star"></i></label>

                                                                                        <span class="rating-value">5</span>
                                                                                    </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <button class="post_jp_btn" type="submit">Submit Review</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        @else
                                                                        @if($Reviews==null && auth()->user()->id == $order->user_sender_id)
                                                                        <button class="apled_btn50" style="pointer-events: none;" disabled>Seller has not given review yet</button>
                                                                        @else
                                                                        <div class="col-lg-12" style="text-align: center;">
                                                                                <button class="post_jp_btn" style="pointer-events: none;" disabled>Review Submitted</button>
                                                                            </div>
                                                                        @endif

                                                                        @endif
                                                                @endif
                                                                <br>
                                                                @if($order->order_status == 'active')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Active ORDER</button>
                                                                @elseif($order->order_status == 'completed')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Completed</button>
                                                                @elseif($order->order_status == 'late-completed')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Late-Completed</button>
                                                                @elseif($order->order_status == 'pending')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Late-Due</button>
                                                                @elseif($order->order_status == 'cancelled')
                                                                    <button class="apled_btn50" style="pointer-events: none;" disabled>Cancelled</button>
                                                                @endif

                                                            </div>
                                                        </div>




                                                    </li>
                                                    <div class="accordion">
                                                        @if($order->order_status == 'active')
                                                            @if(auth()->user()->id == $order->user_sender_id)
                                                                <div class="accordion-item">
                                                                    <h3 class="accordion-heading">Submit Order Task</h3>
                                                                    <div class="accordion-content">
                                                                        <form action="{{route('post_order_attempt')}}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label class="label15">Task Description*</label>
                                                                                        <textarea name="description" class="textarea_input" placeholder="Type Description"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <label class="label15">Task File*</label>
                                                                                        <input type="file" name="order_attempt_file">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <button class="post_jp_btn" type="submit">Post Order</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                        @foreach($AttemptOrder as $key => $Aorder)
                                                            <div class="accordion-item">
                                                                <h3 class="accordion-heading">Submissions {{$key+1}}</h3>
                                                                <div class="accordion-content">
                                                                    <div>
                                                                        <h4>Description:</h4>
                                                                        <p>{{ $Aorder->description }}</p>
                                                                    </div>
                                                                    @if($Aorder->order_attempt_file)
                                                                        <div>
                                                                            <h4>Uploaded File:</h4>
                                                                            <a href="{{ Storage::url($Aorder->order_attempt_file) }}" target="_blank">Download File</a>
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
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    @if($Aorder->rejected == 1)
                                                                        <div class="col-lg-12" style="text-align: center;">
                                                                            <button class="post_jp_btn" style="pointer-events: none;" disabled>Submission Rejected</button>
                                                                        </div>
                                                                    @elseif($Aorder->accepted == 1)
                                                                        <div class="col-lg-12" style="text-align: center;">
                                                                            <button class="post_jp_btn" style="pointer-events: none;" disabled>Submission Accepted</button>
                                                                        </div>

                                                                    @endif
                                                                    @if(auth()->user()->id == $order->user_sender_id)
                                                                        @if($Aorder->accepted == 0 and $Aorder->rejected == 0)
                                                                            <div class="col-lg-12" style="text-align: center;">
                                                                                <button class="post_jp_btn" style="pointer-events: none;" disabled>Pending</button>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>


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
            $('.accordion-heading').click(function() {
                $(this).toggleClass('active');
                $(this).next('.accordion-content').slideToggle('fast');
            });
        });

    </script>
@endsection
