<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Chat;
?>
@extends('layouts.frontend.master')
@section('title', 'Home')



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
                                <a class="nav-link" href="{{route('my_freelancer_messages')}}">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('my_freelancer_bookmarks')}}">Bookmarks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('my_freelancer_jobs')}}">Jobs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{route('my_freelancer_bids')}}">Bids</a>
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
                            <div class="col-xl-4">
                                <div class="msgs-list mb30">
                                    <div class="msg-title1">
                                        <div class="srch_br">
                                            <input class="list_search" type="text" placeholder="Search">
                                            <i class="fas fa-search list_srch_icon"></i>
                                        </div>
                                    </div><!--msg-title end-->
                                    <div class="messages-list scrollstyle_4">
                                        <ul>


                                            @foreach($leftwallmessages as $data)
                                                <li class="active">
                                                    <div class="usr-msg-details">
                                                        <a href="{{route('freelancer_texting',[$data->id])}}">
                                                            <div class="usr-ms-img">
                                                                <img src="images/messages/dp-1.jpg" alt="">
                                                                <span class="msg-status"></span>
                                                            </div>
                                                            <?php
															$latestMessage=  Chat::whereIn('sender_id', [$data->id,Auth()->user()->id])
															->whereIn('receiver_id',[$data->id,Auth()->user()->id])
															->orderby('id', 'desc')
															->pluck('message')
															->first();
															?>
                                                            <div class="usr-mg-info">
                                                                {{--															<h3>Johnson Smith</h3>--}}
                                                                <h3>{{$data->first_name}} </h3>
                                                                {{$latestMessage}}
                                                                {{--															<p>Thanks for the hired me...</p>--}}
                                                            </div><!--usr-mg-info end-->

                                                        </a>
                                                    </div><!--usr-msg-details end-->
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div><!--messages-list end-->
                                </div><!--msgs-list end-->
                            </div>
                            <div class="col-xl-8 col-md-12 mission-slider">
                                <div class="mesgs">
                                <div id="mesgs" class="main-conversation-box">



                                    <div class="message-bar-head">
                                        <div class="usr-msg-details">
                                            <div class="usr-ms-img">
{{--                                                <img src="images/messages/dp-1.jpg" alt="">--}}
                                            </div>
                                            <div class="usr-mg-info">
                                                <?php
//                                                dd($reciever_id);
                                                $name =  \App\Models\User::select('users.first_name','users.last_name')->where('id',$reciever_id)->first();
//                                                dd($name);
                                                ?>
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
                                                @if(Auth::user()->id == $message->sender_id)
                                                    <div class="main-message-box ta-right">
                                                        <div class="message-dt">
                                                            <div class="message-inner-dt">
{{--                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Vivamus suscipit tortor eget felis porttitor.</p>--}}
                                                           <p style="width: auto;">{{$message->message}}</p>
                                                            </div><!--message-inner-dt end-->
                                                            <span>{{$message->created_at->diffForHumans()}}</span>
                                                        </div><!--message-dt end-->
                                                    </div><!--main-message-box end-->
                                                @else
                                                    <div class="main-message-box st3">
                                                        <div class="message-dt st3">
                                                            <div id="messagestatus" class="message-inner-dt">
                                                                @if($message->message == null)
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">New Offer Received</h5>
                                                                            <h5>Title</h5>
                                                                            <p class="card-text">{{$message->description}}</p>
                                                                            <h5>Price</h5>
                                                                            <p class="card-text"> {{$message->price}} </p>
                                                                            <h5>Time</h5>
                                                                            <p class="card-text"> {{$message->time_of_job}}</p>
                                                                            <button class="btn btn-success" onclick="acceptOffer( {{$message->id}} )">Accept</button>
                                                                            <button class="btn btn-danger" onclick="rejectOffer( {{$message->id}} )">Reject</button>
                                                                        </div>
                                                                    </div>
                                                                @elseif($message->reject == 1 && $message->message == 'rejected' )
                                                                    <div class="card">
                                                                    <div class="card-body">
                                                                        <p>{{$message->description}}</p>
                                                                        <p>{{$message->price}}</p>
                                                                        <p>{{$message->time_of_job}}</p>
                                                                    <button class="btn btn-danger" disabled>Rejected</button>
                                                                    </div>
                                                                    </div>

                                                                @else
                                                                <p>{{$message->message}}</p>
                                                                @endif
                                                            <span>{{$message->created_at->diffForHumans()}}</span>
                                                            </div><!--message-inner-dt end-->

                                                        </div><!--message-dt end-->
                                                    </div><!--main-message-box end-->
                                                @endif
                                            @endforeach
                                        </div>
                                    </div><!--messages-line end-->

                                    <div class="message-send-area">
                                        <form id="chatmodalform">
                                            <div class="mf-field">
                                                <input id="receiver_id" type="hidden" value="{{$reciever_id}}">
                                                <input id="sender_id" type="hidden" value="{{Auth::user()->id}}">
                                                <input type="text" class="write_msg form-control input-sm chat_input @error('messsage') is-invalid @enderror"
                                                       value="{{ old('message') }}" id="message" placeholder="Write your message here..." required/>

                                                {{--                                                <button class="msg_send_btn" id="btn-chat" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>--}}
                                                <button id="make-offer-btn" type="button">Makeoffer</button>
                                                <button id="btn-chat" type="submit">Send</button>
                                            </div>
                                        </form>

                                        <!-- Offer Popup -->
                                        <div id="offer-popup" style="display: none" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Create an Offer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="offer-form">
                                                            <input type="hidden" id="receiver-id" name="receiver_id" value="{{$reciever_id}}">
                                                            <input type="hidden" id="sender-id" name="sender_id" value="{{auth()->user()->id}}">
                                                            <div class="form-group">
                                                                <label for="description">Title:</label>
                                                                <input type="text" class="form-control" id="description" name="description">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price">Price:</label>
                                                                <input type="text" class="form-control" id="price" name="price">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="time-of-job">Time </label>
                                                                <input type="text" class="form-control" id="time_of_job" name="time_of_job">
                                                            </div>
                                                            <button id="submit-offer-btn" type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
                                        <script type="text/javascript">
                                            // Submit the chat message form using AJAX
                                            $('#chatmodalform').on('submit', function (e) {
                                                e.preventDefault();
                                                // alert('ok')

                                                let message = $('#message').val();
                                                let receiver = $('#receiver_id').val();
                                                let sender = $('#sender_id').val();

                                                $.ajax({
                                                    url: "/storechat",
                                                    type: "POST",
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        message: message,
                                                        receiver_id: receiver,
                                                        sender_id: sender,
                                                    },

                                                    success: function (response) {

                                                        //
                                                        $('#chatmodalform')[0].reset(); // Clear the form
                                                        $("#chat").load(location.href + " #chat")

                                                        //
                                                            $('.main_chat').animate({
                                                                scrollTop: $('.main_chat').prop('scrollHeight')
                                                            }, 200);

                                                    },
                                                });
                                            });

                                            $('#make-offer-btn').on('click', function() {
                                                $('#offer-popup').show();
                                            });


                                            $('#submit-offer-btn').on('click', function() {
                                                // Get the values from the form
                                                var receiver_id = $('#receiver_id').val();
                                                var sender_id = $('#sender_id').val();
                                                var price = $('#price').val();
                                                var description = $('#description').val();
                                                var time_of_job = $('#time_of_job').val();


                                                $.ajax({
                                                    url: '/makeOffer',
                                                    type: 'POST',
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        receiver_id: receiver_id,
                                                        sender_id: sender_id,
                                                        price: price,
                                                        description: description,
                                                        time_of_job: time_of_job
                                                    },

                                                    success: function (response) {
                                                        alert('ok');
                                                    },
                                                    error: function () {
                                                        // Display an error message
                                                        alert('An error occurred while making the offer.');
                                                    }
                                                });
                                            });


                                            // Function to accept an offer
                                            function acceptOffer(offerId) {
                                                // Make an AJAX request to accept the offer
                                                $.ajax({
                                                    url: '/accept_offer',
                                                    type: 'POST',
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",offer_id: offerId},
                                                    success: function() {
                                                        // Display a success message
                                                        alert('Offer accepted!');

                                                        // Remove the accept/reject card from the chat modal
                                                        $('#main_chat').find('.card').remove();
                                                    },
                                                    error: function() {
                                                        // Display an error message
                                                        alert('An error occurred while accepting the offer.');
                                                    }
                                                });
                                            }
                                            //
                                            // Function to reject an offer
                                            function rejectOffer(offerId) {
                                                // Make an AJAX request to reject the offer
                                                    alert(offerId);

                                                $.ajax({
                                                    url: '/rejectOffer',
                                                    type: 'POST',
                                                    data: {"_token": "{{ csrf_token() }}",offer_id: offerId},
                                                    success: function() {
                                                        // Display a success message
                                                        alert('Offer rejected!');
                                                        $('#messagestatus').load(location.href + ' #messagestatus');
                                                        $('.main_chat').animate({
                                                            scrollTop: $('.main_chat').prop('scrollHeight')
                                                        }, 200);



                                                    },
                                                    error: function() {
                                                        // Display an error message
                                                        alert('An error occurred while rejecting the offer.');
                                                    }
                                                });
                                            }

                                        </script>
                                    </div><!--message-send-area end-->
                                </div><!--main-conversation-box end-->
                                </div>
                            </div><!--main-conversation-box end-->
{{--                                        <div id="offer-modal" class="offer_modal">--}}
{{--                                            <div class="offer_modal_content">--}}
{{--                                                <span class="close">Make Offer modal &times;</span>--}}
{{--                                                <form id="offer-form">--}}
{{--                                                    <!-- Add form fields for making an offer -->--}}
{{--                                                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"--}}
{{--                                                           value="{{ old('description') }}" id="description" placeholder="Write your description here..."/>--}}
{{--                                                    <input type="text" name="price" class="form-control  @error('price') is-invalid @enderror"--}}
{{--                                                           value="{{ old('price') }}" id="price" placeholder="Write your price here..."/>--}}
{{--                                                    <input type="text" name="delivery_time" class="write_msg form-control input-sm chat_input @error('delivery_time') is-invalid @enderror"--}}
{{--                                                           value="{{ old('delivery_time') }}" id="delivery_time" placeholder="Write your message here..."/>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
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
    </script>
@endsection
