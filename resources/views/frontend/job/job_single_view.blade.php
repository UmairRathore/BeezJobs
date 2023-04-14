@extends('layouts.frontend.master')
@section('title', 'Job')


@section('content')
    <style>

        .btn-orange{
            color: #fff;
            background-color: #ff4500;
            border-color: #ff4500;
        }
        .message-bidder {

            padding: 8px 20px;
            border-radius: 3px;
            margin-left: 30px;
            text-align: center;
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            color: #fff;
            background-color: #ff4500;
            /*width: 100%;*/
            height: 40px;
            border: 0;
            margin-bottom: 30px;
        }
        .col-md-2, .col-md-10{
            padding:0;
        }
        .panel{
            margin-bottom: 0px;
        }
        .chat-window{
            bottom:0;
            position:fixed;
            float:right;
            margin-left:10px;
        }
        .chat-window > div > .panel{
            border-radius: 5px 5px 0 0;
        }
        .icon_minim{
            padding:2px 10px;
        }
        .msg_container_base{
            background: #e5e5e5;
            margin: 0;
            padding: 100px 10px 10px;
            max-height:300px;
            overflow-x:hidden;
        }
        .top-bar {
            background: #242424;
            color: white;
            padding: 10px;
            position: relative;
            overflow: hidden;
        }
        .msg_receive{
            padding-left:0;
            margin-left:0;
        }
        .msg_sent{
            padding-bottom:20px !important;
            margin-right:0;
        }
        .messages {
            background: white;
            padding: 10px;
            border-radius: 2px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            max-width:100%;
        }
        .messages > p {
            font-size: 13px;
            margin: 0 0 0.2rem 0;
        }
        .messages > time {
            font-size: 11px;
            color: #ccc;
        }
        .msg_container {
            padding: 10px 10px 10px 10px ;
            overflow: hidden;
            display: flex;
        }
        img {
            display: block;
            width: 100%;
        }
        .avatar {
            position: relative;
        }
        .base_receive > .avatar:after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border: 5px solid #FFF;
            border-left-color: rgba(0, 0, 0, 0);
            border-bottom-color: rgba(0, 0, 0, 0);
        }

        .base_sent {
            justify-content: flex-end;
            align-items: flex-end;
        }
        .base_sent > .avatar:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 0;
            border: 5px solid white;
            border-right-color: transparent;
            border-top-color: transparent;
            box-shadow: 1px 1px 2px rgba(black, 0.2); // not quite perfect but close
        }

        .msg_sent > time{
            float: right;
        }



        .msg_container_base::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        .msg_container_base::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }

        .msg_container_base::-webkit-scrollbar-thumb
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #555;
        }

        .btn-group.dropup{
            position:fixed;
            left:0px;
            bottom:0;
        }
    </style>
<!-- Title Start -->
<div class="title-bar">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<ol class="title-bar-text">
							<li class="breadcrumb-item"><a href="/">Home</a></li>
							<li class="breadcrumb-item"><a href="browse_projects.html">Browser Projects</a></li>
							<li class="breadcrumb-item active" aria-current="page">Project Single View</li>
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
					<div class="col-lg-9 col-md-8">
						<div class="view_details">
							<ul>
{{--								<li>--}}
{{--									<div class="vw_items">--}}
{{--										<i class="fas fa-eye"></i>--}}
{{--										<div class="vw_item_text">--}}
{{--											<h6>Views</h6>--}}
{{--											<span>135</span>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</li>--}}
{{--								<li>--}}
{{--									<div class="vw_items">--}}
{{--										<i class="fas fa-shield-alt"></i>--}}
{{--										<div class="vw_item_text">--}}
{{--											<h6>Verify</h6>--}}
{{--											<span>Yes</span>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</li>								--}}
								<li>
									<div class="vw_items">
										<i class="far fa-money-bill-alt"></i>
										<div class="vw_item_text">
											<h6>Budget</h6>
											<span>${{$job->budget}}</span>
										</div>
									</div>
								</li>
								<li>
									<div class="vw_items">
										<i class="far fa-clock"></i>
										<div class="vw_item_text">
											<h6>Posted Date</h6>
											<span>{{$job->created_at->diffForHumans()}}</span>
										</div>
									</div>
                                </li>
                            </ul>
                        </div>
                        <div class="job-item ptrl_2 mt-20">
                            {{--							@foreach($jobs as $job)--}}
                            <div class="job-top-dt">
                                <div class="job-left-dt">
                                    @if($job->profile_image)
                                        <img src="{{asset($job->profile_image)}}" alt="">
                                    @else
                                        <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                    @endif
                                    <div class="job-ut-dts">
                                        <a href="{{route('other_freelancer_profile',[$job->user_id])}}"><h4>{{$job->fname.' '.$job->lname}}</h4></a>
                                        <span><i class="fas fa-map-marker-alt"></i>{{$job->location}}</span>
                                    </div>
                                </div>
                                <div class="job-right-dt">
                                    <div class="job-price">${{$job->budget}}</div>
                                </div>
                            </div>
{{--                            @endforeach--}}
							<div class="job_dts">
								<h4>Description</h4>
<div>

								<p>{{$job->desc}}</p>
    <br>
</div>
							</div>
						</div>
						<div class="find-lts-jobs">
							<div class="main-heading bids_heading">
                                <h2>Freelancers Bidding</h2>
                                <div class="line-shape1">
                                    <img src="images/line.svg" alt="">
                                </div>
                            </div>
                            <div class="freelancers_bidings">
                                @foreach($bids as $key => $bid )
                                    <div class="job-item mt-30">
                                        <div class="job-top-dt">
                                            <div class="job-left-dt">
                                                @if($bid->profile_image)
                                                    <img src="{{asset($bid->profile_image)}}" alt="">
                                                @else
                                                    <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                                @endif
                                                <div class="job-ut-dts">
                                                    <a href="{{route('other_freelancer_profile',[$bid->user_id])}}"><h4>{{$bid->first_name.' '.$bid->last_name}}</h4></a>
                                                    <span><i class="fas fa-map-marker-alt"></i> {{$bid->location}}</span>
                                                    <div class="star mt-2">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>4.9</span>
												</div>
                                                <div>
                                                    <h4>Description</h4>
                                                    <p>{{$bid->bid_description}}</p>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="job-right-dt job-right-dt78">
                                                <div class="job-price job-price78">${{$bid->bid_budget}}</div>
                                                {{--											<div class="job-fp dy_cl">in 5 days</div>--}}
                                                <div class="job-bottom-dt job-bottom-dt78">
                                                    @if(auth()->check())
                                                        <button id="chatmodalbutton{{$key}}" class="message-bidder job-right-dt job-right-dt78"> Message Bidder</button>
                                                        {{--                                        <a href="#" id="chatmodalbutton" class="add-post job-bottom-dt job-right-dt job-right-dt78">Message Bidder</a>--}}
                                                    @endif
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    @if(auth()->check())
                                        <div id="classmodaldiv{{$key}}" class="d-none" style="opacity: 1;">
                                            {{--                    @include('front.pages.chat.chat-modal')--}}

                                            <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" style="margin-left:10px; opacity: 1;">
                                                <div class="col-xs-12 col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading top-bar">
                                                            <h5 class="panel-title">
                                                                {{--                                                MARK JOHN--}}
                                                                {{$bid->first_name.' '.$bid->last_name}}
                                                            </h5>
                                                        </div>

                                                        <div class="panel-body msg_container_base" id="chat">

                                                            @foreach($chats as $chat)
{{--                                                                {{dd($chat)}}--}}
                                                                <div class="row msg_container base_sent" style="opacity: 1;">
                                                                    <div class="col-md-10 col-xs-10">
                                                                        @if(Auth::user()->id == $chat->sender_id)
                                                                            <div class="messages msg_sent" style="background-color:#ff4500">
                                                                                <p style="color:white">
                                                                                    {{--                                                                    message--}}
                                                                                    {{$chat->message}}
                                                                                </p>
                                                                                <time datetime="2009-11-13T20:00">
                                                                                    {{--                                                                Time--}}
                                                                                    {{$chat->created_at->diffForHumans()}}
                                                                                </time>
                                                                            </div>
                                                                        @else
                                                                            <div class="messages msg_sent">
                                                                                <p>
                                                                                    {{--                                                                    message--}}
                                                                                    {{$chat->message}}
                                                                                </p>
                                                                                <time datetime="2009-11-13T20:00">
                                                                                    {{--                                                                    Time--}}
                                                                                    {{$chat->created_at->diffForHumans()}}
                                                                                </time>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <div class="panel-footer">
                                                            <form id="chatmodalform">
                                                                @csrf
                                                                <input id="receiver_id" type="hidden" value="{{$bid->user_id}}">
                                                                <input id="sender_id" type="hidden" value="{{$bid->jobUserId}}">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control input-sm chat_input @error('messsage') is-invalid @enderror" value="{{ old('message') }}" id="message" placeholder="Write your message here..."/>
                                                                    @error('message')
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                    <span class="input-group-btn">
{{--                                            <button type="submit" class="btn btn-primary">--}}
                            <button type="submit" class="btn btn-orange btn-sm" id="btn-chat">Send</button>
                        </span>
                                                                </div>
                                                            </form>
                                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
                                                            <script type="text/javascript">
                                                                $('#chatmodalform').on('submit', function (e) {
                                                                    e.preventDefault();

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

                                                                            console.log(response);
                                                                            $('#chatmodalform')[0].reset(); // Clear the form
                                                                            $("#chat").load(location.href + " #chat");
                                                                        },
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                    <script>
                                        $(document).ready(function () {
                                            $("#chatmodalbutton{{$key}}").click(function (e) {
                                                e.preventDefault();
                                                $("#classmodaldiv{{$key}}").toggleClass('d-none');
                                                // alert($(this).val("#author-id"));
                                            });
                                        });
                                    </script>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mainpage">
                        <div class="total_days mtp_30">{{$job->created_at->diffForHumans()}} left</div>
                        @if(Session('info_created'))
                            <div class="alert alert-success" role="alert">
                                {{Session('info_created')}}

                            </div>
                        @endif
                        @if(Session('required_fields_empty'))
                            <div class="alert alert-danger" role="alert">
                                {{Session('required_fields_empty')}}

                            </div>
                        @endif
                        <h4 class="bid_title">Bid Now This Job</h4>
                        <form method="POST" action="{{ route('backend.bid.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="job_id" value="{{ $job->id }}">

                            <div class="form-group">
                                <label for="bid_budget">Budget</label>
                                <input type="text" name="bid_budget" id="bid_budget" class="form-control" placeholder="Enter your bid amount">
                            </div>

                            <div class="form-group">
                                <label for="bid_description"> Description</label>
                                <textarea name="bid_description" id="bid_description" rows="5" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="apply_job_rt">PLACE A BID</button>

                        </form>

                        <div class="bookmark_rt">
                            <button class="bookmark1 mr-3" title="bookmark"><i class="fas fa-heart"></i></button>
                            BOOKMARK
                        </div>
                        <ul class="social-links">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </main>

    <!-- Body End -->

@endsection


@section('chatmodal')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $("#chatmodalbutton{{$key}}").click(function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        $("#classmodaldiv{{$key}}").toggleClass('d-none');--}}
        {{--        // alert($(this).val("#author-id"));--}}
        {{--    });--}}
        {{--});--}}

        $(document).on('click', '.panel-heading span.icon_minim', function (e) {
            var $this = $(this);
            if (!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });
        $(document).on('focus', '.panel-footer input.chat_input', function (e) {
            var $this = $(this);
            if ($('#minim_chat_window').hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideDown();
                $('#minim_chat_window').removeClass('panel-collapsed');
                $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            }
        });
        $(document).on('click', '#new_chat', function (e) {
            var size = $(".chat-window:last-child").css("margin-left");
            size_total = parseInt(size) + 400;
            alert(size_total);
            var clone = $("#chat_window_1").clone().appendTo(".container");
            clone.css("margin-left", size_total);
        });
        $(document).on('click', '.icon_close', function (e) {
            //$(this).parent().parent().parent().parent().remove();
            $("#chat_window_1").remove();
        });

    </script>
    </script>

@endsection
