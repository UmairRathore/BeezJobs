@extends('layouts.frontend.master')
@section('title', 'Privacy Policy')
@section('content')

    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
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
                <div class="col-md-12">
                    <div class="main-heading">
                        <h2>Jobby Privacy Policy</h2>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>

                    <p>{!!  $show->description !!}</p>
                </div>
            </div>
        </div>
    </main>
    <!-- Body End -->

@endsection
