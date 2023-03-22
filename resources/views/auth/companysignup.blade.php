@extends('layouts.frontend.master')
@section('title', 'Company Sign UP')
@section('content')

    <!-- Title Start -->
<div class="title-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="title-bar-text">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Company Profile</li>
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
            <div class="col-md-8">
                <div class="main-heading bids_heading">
                    <h2>Create Company Profile</h2>
                    <div class="line-shape1">
                        <img src="images/line.svg" alt="">
                    </div>
                </div>
                <div class="post501">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label15">Profile Avtar*</label>
                                    <div class="avtar_dp">
                                        <img src="images/profile_dp.jpg" alt="">
                                    </div>
                                    <div class="image-upload-wrap1 ml5">
                                        <input class="file-upload-input1" id="file3" type="file" onchange="readURL(this);" accept="image/*">
                                        <div class="drag-text1">
                                            Upload Files
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label15">Company Name*</label>
                                    <input type="text" class="job-input" placeholder="Your Company Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label15">Email Address*</label>
                                    <input type="email" class="job-input" placeholder="Enter Your Email Address">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label15">Launch Date*</label>
                                    <div class="smm_input">
                                        <input type="text" class="job-input datepicker-here" data-language="en" placeholder="Select Launch Date">
                                        <div class="mix_max"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label15">About Description*</label>
                                    <div class="description_dtu">
                                        <div class="description_actions">
                                            <a href="#"><i class="fas fa-bold"></i></a>
                                            <a href="#"><i class="fas fa-italic"></i></a>
                                            <a href="#"><i class="fas fa-list-ul"></i></a>
                                            <a href="#"><i class="fas fa-list-ol"></i></a>
                                        </div>
                                        <textarea class="textarea70" placeholder="Describe your experience, skills, etc. In complete details. This is your chance to show off."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label15">Tagline*</label>
                                    <input type="email" class="job-input" placeholder="Wordpress Developer">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="label15">Pay Rate ($/hr)*</label>
                                    <div class="smm_input">
                                        <input type="text" class="job-input" placeholder="Enter Your Page Rate">
                                        <div class="mix_max">Usd</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label15">Location*</label>
                                    <div class="smm_input">
                                        <input type="text" class="job-input" placeholder="Type Address">
                                        <div class="loc_icon"><i class="fas fa-crosshairs"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="label15">Websites*</label>
                                    <div class="smm_input5">
                                        <input type="text" class="website-input" placeholder="Http://entercompanysite.com">
                                        <div class="loc_icon5"><i class="fas fa-globe"></i></div>
                                    </div>
                                    <div class="smm_input5">
                                        <input type="text" class="website-input" placeholder="Http://enterblogsite.com">
                                        <div class="loc_icon5"><i class="far fa-edit"></i></div>
                                    </div>
                                    <div class="smm_input5">
                                        <input type="text" class="website-input" placeholder="Http://enterportfoliosite.com">
                                        <div class="loc_icon5"><i class="fas fa-columns"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="post_jp_btn" type="submit">Finish Company Profile</button>
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
