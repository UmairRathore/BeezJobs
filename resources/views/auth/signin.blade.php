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
                            <h2>Sign in to Jobby</h2>
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
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <!-- Body End -->
@endsection



