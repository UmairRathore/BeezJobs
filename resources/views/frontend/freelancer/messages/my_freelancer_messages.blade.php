
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
?>
@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')


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
                            @include('frontend.freelancer.my_freelancer.layout.my_freelancer_navbar')
                        </div>
						<div class="messages-sec">
							<div class="row no-gutters">
								<div class="col-xl-4">
									<div class="msgs-list mb30">
										<div class="msg-title1">
											<div class="srch_br">
                                                <input class="list_search" type="text" placeholder="Search by name" id="searchNameInput">
                                                <i class="fas fa-search list_srch_icon"></i>
											</div>
										</div><!--msg-title end-->
										<div class="messages-list scrollstyle_4">
											<ul>
                                                @foreach($leftwallmessages as $data)
                                                    <li class="active message-item" data-firstname="{{ $data->first_name }}">
                                                        <div class="usr-msg-details">
                                                            <a href="{{route('freelancer_texting',[$data->id])}}">
                                                                <div class="usr-ms-img">
                                                                    <img src="images/messages/dp-1.jpg" alt="">
                                                                    <span class="msg-status"></span>
                                                                </div>
                                                                <div class="usr-mg-info">
                                                                    <h3>{{ $data->first_name }}</h3>
                                                                    <?php
                                                                    $latestMessage = Chat::whereIn('sender_id', [$data->id,Auth()->user()->id])
                                                                        ->whereIn('receiver_id',[$data->id,Auth()->user()->id])
                                                                        ->orderby('id', 'desc')
                                                                        ->pluck('message')
                                                                        ->first();
                                                                    ?>
                                                                    <p>{{ $latestMessage }}</p>
                                                                </div><!--usr-mg-info end-->
                                                            </a>
                                                        </div><!--usr-msg-details end-->
                                                    </li>
                                                @endforeach
											</ul>
										</div><!--messages-list end-->
									</div><!--msgs-list end-->
								</div>
							</div>
						</div><!--messages-sec end-->

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

            $(document).ready(function() {
            // Listen for keyup events on the search input field
            $('#searchNameInput').on('keyup', function() {
                var searchText = $(this).val().toLowerCase();

                // Loop through each message item
                $('.message-item').each(function() {
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
