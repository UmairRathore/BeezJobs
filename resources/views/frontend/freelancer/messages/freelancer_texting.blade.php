<?php

namespace App\Http\Controllers\Admin;
use App\Models\Job;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Chat;
?>
@extends('layouts.frontend.master')
@section('title', 'Messages')

@section('content')
    <style>
        /* Style the modal */
        .offer_modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .offer_modal_content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .main-message-box {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .message-dt {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: 10px;
        }

        .main-message-box.ta-right {
            flex-direction: row-reverse;
        }

        .main-message-box.st3 {
            flex-direction: row;
        }

        .main-message-box .message-dt p {
            font-size: 16px;
            line-height: 1.4;
            padding: 10px 15px;
            border-radius: 20px;
        }

        .main-message-box.ta-right .message-dt p {
            background-color: #ff4500;
            color: #fff;
            align-self: flex-end;
        }

        .main-message-box.st3 .message-dt p {
            background-color: #e5e5ea;
            color: #333;
        }

        .main-message-box.ta-right .message-dt {
            align-items: flex-end;
            margin-left: 0;
            margin-right: 10px;
        }

        .main-message-box.ta-right .message-dt span {
            margin-left: auto;
            margin-right: 0;
        }

    </style>
    <!-- Title Start -->
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
                                <a class="nav-link active"  href="{{route('my_freelancer_messages')}}">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('my_freelancer_bookmarks')}}">Bookmarks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('my_freelancer_jobs')}}">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('my_freelancer_bids')}}">Bids</a>
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
                    <div class="messages-sec">
                        <div class="row no-gutters">
                            @include('frontend.freelancer.messages.freelancer_messages_searching')

                            <div class="col-xl-8 col-md-12 mission-slider">
                                <div class="mesgs">
                                    <div id="mesgs" class="main-conversation-box">



                                        <div class="message-bar-head">
                                            <div class="usr-msg-details">
                                                    <?php
                                                    //
                                                    $name =  \App\Models\User::select('users.profile_image','users.first_name','users.last_name')->where('id',$reciever_id)->first();
                                                    //
                                                    ?>
                                                <div class="usr-ms-img">
{{--                                                    @if($name->profile_image)--}}
{{--                                                        <img src="{{asset($name->profile_image)}}" alt="">--}}
{{--                                                    @else--}}
                                                        <img src="{{asset('images/messages/dp-1.jpg')}}" alt="">
{{--                                                    @endif--}}
                                                </div>
                                                <div class="usr-mg-info">
                                                    <h3>{{$name->first_name.' '.$name->last_name}}</h3>
                                                    {{--                                                <p>Online</p>--}}
                                                </div><!--usr-mg-info end-->
                                            </div>
                                            {{--                                        <a href="{{route('freelancer_texting',[$reciever_id])}}" title="" class="ed-opts-open"><i></i></a>--}}
                                            <a href="#" title="" class="ed-opts-open"><i></i></a>
                                        </div><!--message-bar-head end-->

                                        <div class="messages-line main_chat scrollstyle_4"  id="chat">
                                            <div id="main_chat" class="mCustomScrollbar">

                                                @foreach($messages as $message)
                                                    <!--Sender-->
                                                    @if(Auth::user()->id == $message->sender_id)
                                                        <div class="main-message-box ta-right">
                                                            <div class="message-dt">
                                                                @if($message->message != Null and $message->offer_id == Null )
                                                                    <div class="message-inner-dt">
                                                                        <p style="width: auto;">{{$message->message}}</p>
                                                                    </div><!--message-inner-dt end-->
                                                                    <span>{{\Carbon\Carbon::parse($message->MessageCreatedAt)->diffForHumans()}}</span>                                                        @endif
                                                            </div><!--message-dt end-->
                                                        </div><!--main-message-box end-->

{{--                                                        <!--Sender-->--}}
                                                    @else

{{--                                                        <!-- Receiver -->--}}

                                                        <div class="main-message-box st3">
                                                            <div class="message-dt st3">
                                                                <div id="messagestatus" class="message-inner-dt">
                                                                    @if($message->message == Null and $message->rejected == Null and $message->accepted == Null)

                                                                        <div class="applied_item" style=" width:60%; border: 1px solid #ccc;  padding: 10px; margin-bottom: 10px;  margin-left: 10px;">
                                                                            <a href="#">{{$message->title}}</a>
                                                                            <ul class="view_dt_job">
                                                                                <li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$message->location}}</div></li>
                                                                                <li><div class="vw1254"><i class="fas fa-briefcase"></i>{{$message->online_or_in_person}}</div></li>
                                                                                <li><div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$message->budget}} - Fixed</div></li>
                                                                                <li><div class="vw1254"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</div></li>
                                                                            </ul>
                                                                            <p style="background-color:#ffffff;margin-top: 100px;max-height: 74px; width:80%; overflow-y: auto;">
                                                                                {{$message->description}}
                                                                            </p>
{{--                                                                            <button class="apled_btn50">Applied</button>--}}
{{--                                                                            <button class="apled_btn50">Reject</button>--}}
                                                                            <button class="btn btn-success" onclick="acceptOffer( {{$message->Offer_ID}} )">Accept</button>
                                                                            <button class="btn btn-danger" onclick="rejectOffer( {{$message->Offer_ID}} )">Reject</button>
                                                                        </div>
                                                                    @elseif($message->message == Null and $message->rejected != Null and $message->accepted == Null)
                                                                        <div class="applied_item" style=" width:60%; border: 1px solid #ccc;  padding: 10px; margin-bottom: 10px;  margin-left: 10px;">
                                                                            <a href="#">{{$message->title}}</a>
                                                                            <ul class="view_dt_job">
                                                                                <li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$message->location}}</div></li>
                                                                                <li><div class="vw1254"><i class="fas fa-briefcase"></i>{{$message->online_or_in_person}}</div></li>
                                                                                <li><div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$message->budget}} - Fixed</div></li>
                                                                                <li><div class="vw1254"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</div></li>
                                                                            </ul>
                                                                            <p style="background-color:#ffffff; margin-top: 100px;max-height: 74px; width:80%; overflow-y: auto;">
                                                                                {{$message->description}}
                                                                            </p>
                                                                                <button class="btn btn-danger" disabled>Rejected</button>
                                                                        </div>

                                                                    @elseif($message->message == Null and $message->rejected == Null and $message->accepted != Null)
                                                                        <div class="applied_item" style=" width:60%; border: 1px solid #ccc;  padding: 10px; margin-bottom: 10px;  margin-left: 10px;">
                                                                            <a href="#">{{$message->title}}</a>
                                                                            <ul class="view_dt_job">
                                                                                <li><div class="vw1254"><i class="fas fa-map-marker-alt"></i>{{$message->location}}</div></li>
                                                                                <li><div class="vw1254"><i class="fas fa-briefcase"></i>{{$message->online_or_in_person}}</div></li>
                                                                                <li><div class="vw1254"><i class="far fa-money-bill-alt"></i>{{$message->budget}} - Fixed</div></li>
                                                                                <li><div class="vw1254"><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</div></li>
                                                                            </ul>
                                                                            <p style="background-color:#ffffff; margin-top: 100px;max-height: 74px; width:80%; overflow-y: auto;">
                                                                                {{$message->description}}
                                                                            </p>
                                                                            <button class="btn btn-success" disabled>Accepted</button>
                                                                        </div>
                                                                    @else
                                                                        <p>{{$message->message}}</p>
                                                                    @endif
                                                                </div>                                                           <!--message-inner-dt end-->
                                                                <span>{{\Carbon\Carbon::parse($message->MessageCreatedAt)->diffForHumans()}}</span>
                                                            </div>                                                                <!--message-dt end-->
                                                        </div>                                                                 <!--main-message-box end-->
{{--                                                        <!-- Receiver -->--}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div><!--messages-line end-->

                                        <div class="message-send-area">

                                            <!--Send Message Form-->
                                            <form id="chatmodalform">
                                                <div class="mf-field">
                                                    <input id="receiver_id" type="hidden" value="{{$reciever_id}}">
                                                    <input id="sender_id" type="hidden" value="{{Auth::user()->id}}">
                                                    <input type="text" class="write_msg form-control input-sm chat_input @error('messsage') is-invalid @enderror"
                                                           value="{{ old('message') }}" id="message" placeholder="Write your message here..." required/>
                                                    <button id="make-offer-btn" type="button">Makeoffer</button>
                                                    <button id="btn-chat" type="submit">Send</button>
                                                </div>
                                            </form>
                                            <!--Send Message Form-->

                                            <!-- Offer Popup -->
                                            <div id="offer-popup" style="display: none" class="modal" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Create an Offer</h2>
                                                            <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;" >
                                                            <div id="success-message" class="alert alert-success d-none"></div>
                                                            <div id="error-message" class="alert alert-danger d-none"></div>
                                                            <form id="offer-form">
                                                                <input type="hidden" id="receiver-id" name="receiver_id" value="{{$reciever_id}}">
                                                                <input type="hidden" id="sender-id" name="sender_id" value="{{auth()->user()->id}}">
                                                               <div class="form-group"  id="select_job_type">
                                                                   <h4>Choose Custom Offer OR Available Jobs Offer</h4>
                                                                   <select class="form-control">
                                                                       <option disabled selected>Custom Offer OR Available Jobs</option>
                                                                           <option value="available-job">Choose From Available Jobs</option>
                                                                           <option value="custom-job">Create Custom Job Offer</option>
                                                                   </select>
                                                               </div>
                                                                <!--Available JOB OFFER-->
                                                                <div id="available_jobs" class="d-none">

                                                                    <h2 style="text-align: center;margin: 0 auto;display: block;">Create Offer From Available Jobs</h2>
                                                                <div class="form-group">
                                                                    <label for="job-title">Job Title:</label>
                                                                    <select class="form-control" id="job_id" name="job_id">
                                                                        <?php
                                                                        $jobs = Job::where('user_id',$reciever_id)->get();
                                                                        ?>
                                                                        <option selected disabled>Select From Your Jobs</option>
                                                                        @foreach($jobs as $job)
                                                                            <option value="{{ $job->id }}">{{ $job->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="title">Title:</label>
                                                                    <input type="text" class="form-control" id="title" name="title"  disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="negotiated_price"> Price:</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">$</span>
                                                                        </div>
                                                                        <input type="number" class="form-control" id="negotiated_price" name="negotiated_price" aria-label="Amount (to the nearest dollar)">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="negotiated_duration"> Duration:</label>
                                                                    <input type="text" class="form-control" id="negotiated_duration" name="negotiated_duration">                                                                </div>
                                                                    <div class="form-group">
                                                                        <label for="negotiated_description"> Description:</label>
                                                                        <textarea type="text" class="form-control" id="negotiated_description" name="negotiated_description"></textarea>
                                                                    </div>
                                                                    <button id="submit-Available-offer-btn" type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                                <!--Available JOB OFFER-->

                                                                <!--Custom JOB OFFER-->
                                                                <div id="custom_jobs" class="d-none">
                                                                    <h2 style="text-align: center;margin: 0 auto;display: block;">Create Custom Offer for job</h2>
                                                                    <div class="form-group">
                                                                        <label for="title">Title:</label>
                                                                        <input type="text" class="form-control" id="customJob_title" name="title">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="date">Date:</label>
                                                                        <input type="date" class="form-control" id="customJob_date" name="date">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="budget">Budget:</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">$</span>
                                                                            </div>
                                                                            <input type="number" class="form-control" id="customJob_budget" name="budget" aria-label="Amount (to the nearest dollar)">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="time-of-day">Duration:</label>
                                                                        <input type="text" class="form-control" id="customJob_time_of_day" name="time_of_day">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="date">Choose Meeting:</label>
                                                                        <select id="customJob_job_meeting" class="form-control">
                                                                            <option disabled selected>Select Remote or Onsite</option>
                                                                            <option value="online">Remote</option>
                                                                            <option value="in_person">Onsite</option>
                                                                        </select>
                                                                    </div>
                                                                        <div class="form-group">
                                                                            <label class="label15">Location*</label>
                                                                            <div class="smm_input">
                                                                                <input type="text" id="customJob_location" name="location" class="job-input" placeholder="Type Address">
                                                                                <div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
                                                                            </div>
                                                                        </div>
                                                                    <div class="form-group">
                                                                        <label for="description">Description:</label>
                                                                        <textarea type="text" class="form-control" id="customJob_description" name="description"></textarea>
                                                                    </div>
                                                                    <button id="submit-Custom-offer-btn" type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                                <!--Custom JOB OFFER-->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @include('frontend.freelancer.messages.freelancer_messages_javascript')
                                        </div><!--message-send-area end-->
                                    </div><!--main-conversation-box end-->
                                </div>
                            </div><!--main-conversation-box end-->
                        </div>
                    </div>
                </div><!--messages-sec end-->

            </div>
        </div>
        </div>
    </main>
@endsection
@section('pageload')
    <script>
        $(window).on('load', function () {
            // Scroll to the bottom of the chat container
            $('.main_chat').animate({
                scrollTop: $('.main_chat').prop('scrollHeight')
            }, 200);
        });
        $(document).ready(function () {
            // Listen for keyup events on the search input field
            $('#searchNameInput').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();

                // Loop through each message item
                $('.message-item').each(function () {
                    var firstName = $(this).data('firstname').toLowerCase();

                    // Show/hide message item based on whether the search text is contained in the first name
                    if (firstName.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });

    </script>
@endsection
