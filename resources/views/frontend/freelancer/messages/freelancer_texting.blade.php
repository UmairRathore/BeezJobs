@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')
<style>
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
                                                            <div class="usr-mg-info">
                                                                {{--															<h3>Johnson Smith</h3>--}}
                                                                <h3>{{$data->first_name}} </h3>
                                                                {{$latestMessage}}
                                                                {{--															<p>Thanks for the hired me...</p>--}}
                                                            </div><!--usr-mg-info end-->
                                                            <span class="posted_time">1:55 PM</span>
                                                            <span class="msg-notifc">1</span>
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
                                                            <div class="message-inner-dt">
                                                                <p>{{$message->message}}</p>
                                                            </div><!--message-inner-dt end-->
                                                            <span>{{$message->created_at->diffForHumans()}}</span>
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
                                                       value="{{ old('message') }}" id="message" placeholder="Write your message here..."/>

                                                {{--                                                <button class="msg_send_btn" id="btn-chat" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>--}}

                                                <button id="btn-chat" type="submit">Send</button>
                                            </div>
                                        </form>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
                                        <script type="text/javascript">
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


                                        </script>
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
    </script>
@endsection
