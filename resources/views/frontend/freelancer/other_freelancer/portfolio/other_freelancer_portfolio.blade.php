@extends('layouts.frontend.master')
@section('title', 'Freelancer Portfolio')
@section('content')
    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Other Freelancer Portfolio</li>
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
            @include('frontend.freelancer.other_freelancer.other_freelancer_sidebar')
            <div class="col-lg-9 col-md-8 mainpage">
                @include('frontend.freelancer.other_freelancer.other_freelancer_nav')
                <div class="portfolio_heading">
                    <div class="portfolio_left">
                        <h4>Portfolio</h4>
                    </div>
                </div>
                <div class="dsh150">
                    <div class="row">
                        @foreach($portfolios as $portfolio)
                        <div class="col-lg-4">
                            <div class="portfolio_item">
                                <div class="portfolio_img">
                                    <img src="{{asset($portfolio->file)}}" alt="">
                                    <div class="portfolio_overlay">
                                        <div class="overlay_items">
                                            <a href="{{($portfolio->file)}}" target="_blank"><i class="fas fa-external-link-alt"></i>Live Preview</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio_title"><i class="fas fa-image"></i>{{$portfolio->title}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
    <!-- Body Start -->
@endsection
