@extends('layouts.frontend.master')
@section('title', 'Sign In')
@section('content')

    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign In</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Start -->
    <!-- Body Start -->
    <main class="browse-section">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="lg_form">
                        <div class="main-heading">
                            <h2>Sign in to BeezJobs</h2>
                            <div class="line-shape1">
                                <img src="images/line.svg" alt="">
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('alert'))
                            <div class="alert alert-danger">
                                {{ session('alert') }}
                            </div>
                        @endif
                        <form method="POST" action="{{route('postsignin')}}">
                            @csrf
                            <div class="form-group">
                                <label class="label15">Email Address*</label>
                                <input id="email" type="email" class=" job-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="label15">Password*</label>
                                <input id="password" type="password" class="form-control job-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>


                            <button type="submit" class="lr_btn">
                                Sign in Now
                            </button>
                        </form>
                        <div class="done145">
                            <div class="done146">
                                Need an account?<a href="{{route('signup')}}">Join us Now<i class="fas fa-angle-double-right"></i></a>
                            </div>

                            <div class="done147">
                                <a href="{{ route('forget.password') }}">Forgot Password?</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#signinModal">
                            Registeration, Terms and Policy
                        </button>
                    </div>
                    <!-- Add this modal markup at the end of your HTML file -->
                    <div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="signinModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="signinModalLabel">Sign-in Procedure and Terms</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h3>Welcome to BeezJobs</h3>
                                    <p>A platform designed to connect job seekers with potential employers and freelancers with clients.</p>

                                    <h3>Procedure:</h3>
                                    <ul>
                                        <li>To provide you with a well-optimized experience, we need to gather your location information. This helps us tailor the job and freelancer suggestions to your specific area, ensuring effective communication and professional work.</li>
                                        <li>To get started, please register yourself by clicking on the "Join Us Now" button. This will take you to the registration page, where you can create your account.</li>
                                        <li>Once you have registered, you can sign in to access your account and explore the platform's features.</li>
                                        <li>As a registered user, you will be able to:</li>
                                        <ul>
                                            <li>Search for jobs and freelancers in your area based on your preferences.</li>
                                            <li>Post job listings or freelance services to attract potential candidates or clients.</li>
                                            <li>Communicate with job seekers or employers through our messaging system for effective communication.</li>
                                        </ul>
                                        <li>We value your privacy and assure you that your location information will only be used to optimize your browsing experience on our platform. Your personal information will be handled according to our privacy policy.</li>
                                    </ul>

                                    <p>Join BeezJobs today and unlock exciting opportunities!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Body End -->
@endsection



