@extends('layouts.frontend.master')
@section('title', 'Freelance Sign UP')
@section('content')

    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Freelancer Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Start -->
    <!--  Body Start -->
    <main class="browse-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main-heading bids_heading">
                        <h2>Create Freelancer Profile</h2>
                        <div class="line-shape1">
                            <img src="{{asset('images/line.svg')}}" alt="">
                        </div>
                    </div>
                    @if (session('alert'))
                        <div class="alert alert-danger">
                            {{ session('alert') }}
                        </div>
                    @endif
                    <div class="post501">
                        <form method="POST" action="{{route('freelancesignup')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group">
                                        <label class="label15">Profile Avtar*</label>
                                        <div class="avtar_dp">

                                            <img src="{{asset(auth()->user()->profile_image)}}" alt="">
                                        </div>
                                        <div class="image-upload-wrap1 ml5">

                                            <input class="file-upload-input1" name="file" id="file3" type="file" onchange="readURL(this);" accept="image/*">
                                            <div class="drag-text1">
                                                Upload Files


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">First Name*</label>
                                        <input type="text" name="first_name" class="job-input" value="{{auth()->user()->first_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Last Name*</label>
                                        <input type="text" name="last_name" class="job-input" value="{{auth()->user()->last_name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Email Address*</label>
                                        <input type="email" name="email" class="job-input" value="{{auth()->user()->email}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Birthday*</label>
                                        <div class="smm_input">
                                            <input type="text" name="birthday" class="job-input datepicker-here" data-language="en" value="{{auth()->user()->birthday}}">
                                            <div class="mix_max"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="label15">Description*</label>
                                        <div class="description_dtu">

                                            <textarea class="textarea70" name="description">{{auth()->user()->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="label15">Tagline</label>
                                        <input type="text" name="tagline" class="job-input" value="{{auth()->user()->tagline}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Pay Rate ($/hr)*</label>
                                        <div class="smm_input">
                                            <input type="text" class="job-input" name="pay_rate" value="{{auth()->user()->pay_rate}}">
                                            <div class="mix_max">Usd</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Profession Category*</label>
                                        <div class="smm_input">
                                            <select name="online_or_in_person" class="job-input">
                                                <option value="online">Designing</option>
                                                <option value="in_person">Marketing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <button class="post_jp_btn" type="submit">Finish Freelancer Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-heading bids_heading pjfaq80">
                        <h2>FAQ</h2>
                    </div>
                    <div class="jp_faq">
                        <div class="jp_faq_item">
                            <h4>01. Complete your profile</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum mi at erat egestas, nec porta diam pharetra.</p>
                        </div>
                        <div class="jp_faq_item">
                            <h4>02. Upload a profile picture</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum mi at erat egestas, nec porta diam pharetra.</p>
                        </div>
                        <div class="jp_faq_item">
                            <h4>03. Be honest about availability</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum mi at erat egestas, nec porta diam pharetra.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Body End -->
@endsection
