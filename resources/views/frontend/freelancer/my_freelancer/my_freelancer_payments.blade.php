@extends('layouts.frontend.master')
@section('title', 'Freelancer Payment')



@section('content')

	<!-- Header End -->
		<!-- Title Start -->
		<div class="t
itle-bar">
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
                            @include('frontend.freelancer.my_freelancer.layout.my_freelancer_navbar')                        </div>

                            <div class="jobs_manage">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="view_chart">
                                                    <div class="view_chart_header" style="display: flex; justify-content: space-between; align-items: center;">
                                                        <div class="transactions_heading" style="margin-right: auto;">
                                                            <h4>Transactions</h4>
                                                        </div>
                                                        <div class="wallet_amount" style="margin-left: auto;">
                                                            <h5>Your Wallet Balance: ${{ $user->wallet_amount }}</h5>
                                                        </div>
                                                </div>
                                                <div class="transaction_body">
                                                    <div class="table-responsive-md">
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Users</th>
                                                                <th scope="col">Jobs</th>
                                                                <th scope="col">Payment</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
{{--                                                            @php--}}
{{--                                                                $sentAmount = 0;--}}
{{--                                                                $receivedAmount = 0;--}}
{{--                                                            @endphp--}}
                                                            @foreach ($transactions as $transaction)
                                                                @php
                                                                    // Retrieve the offer and job details
                                                                   $transaction = \App\Models\TransactionHistory::find($transaction->id);

                                                                   $transactionUser = \App\Models\User::find($transaction->user_id)->select('first_name','last_name')->first();
                                                                    $jobTitle = \App\Models\Job::join('offers', 'jobs.id', '=', 'offers.job_id')
                                                                     ->where('offers.id', $transaction->offer_id)
                                                                     ->select('jobs.title')
                                                                     ->first()
                                                                     ->title;

                                                                @endphp
                                                                <tr>
                                                                    <th scope="row">
                                                                        <div class="user_dt_trans">
                                                                            <div class="aadd14">{{$transactionUser->first_name.' '.$transactionUser->last_name }}</div>
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <div class="user_dt_trans">
                                                                            <div class="aadd14">{{ $jobTitle }}</div>
                                                                            <p>Date: <span>{{ $transaction->created_at->format('d M Y') }}</span></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="user_dt_trans">
                                                                            <div class="aadd14">Card</div>
                                                                            <p>${{ $transaction->amount }}</p>
                                                                        </div>
                                                                    </td>
                                                                @if ($transaction->type === 'sent')
                                                                        <td>
                                                                            <div class="trans_badge">Sent</div>
                                                                        </td>
                                                                @elseif ($transaction->type === 'received')

                                                                        <td>
                                                                            <div class="trans_badge">Received</div>
                                                                        </td>
                                                                @endif
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
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
        $(document).ready(function() {
            var url = window.location.href;
            // console.log(url);
            $('.nav-item a[href="'+url+'"]').addClass('active');
        });
    </script>
@endsection
