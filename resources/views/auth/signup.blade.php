@extends('layouts.frontend.master')
@section('title', 'Sign Up')
@section('content')

    <!-- Title Start -->
<div class="title-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="title-bar-text">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
                        <h2>Sign Up to Jobby</h2>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <form method="POST" action="{{ route('postsignup') }}">
                        @csrf
                    <div class="form-group">
                        <label class="label15">Email Address</label>
                        <input id="email" type="email" class="form-control job-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email Address">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="label15">Password*</label>
                        <input id="password" type="password" class="job-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="label15">Confirm Password*</label>
                        <input id="password-confirm" type="password" name="password_confirmation" class="job-input" required autocomplete="new-password" placeholder="Enter Confirm Password">
                    </div>
                        <div id="map" ></div>
                            <input type="hidden" name="location" id="location">
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">

                    <div class="ui checkbox apply_check check_out checked">
                        <input type="checkbox" tabindex="0" class="hidden">
                        <label style="color:#242424 !important;">I accept the Terms of Services</label>
                    </div>
                        <button type="submit" class="lr_btn"> Next</button>
                    </form>
                    <div class="done140">
                        Already have an account?<a href="{{route('signin')}}">Sign in Now<i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Body End -->


@endsection
@section('google_Map_Location_SignUp')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&callback=initMap"
            async defer></script>
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&libraries=places"></script>--}}

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });

            var marker = new google.maps.Marker({
                position: {lat: -34.397, lng: 150.644},
                map: map,
                draggable: true
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    marker.setPosition(pos);
                    map.setCenter(pos);

                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'location': pos }, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                document.getElementById('location').value = results[0].formatted_address;
                            } else {
                                window.alert('No results found');
                            }
                        } else {
                            window.alert('Geocoder failed due to: ' + status);
                        }
                    });

                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                }, function () {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                handleLocationError(false, map.getCenter());
            }

            google.maps.event.addListener(marker, 'dragend', function (event) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'location': event.latLng }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            document.getElementById('location').value = results[0].formatted_address;
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });

                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });
        }

        function handleLocationError(browserHasGeolocation, pos) {
            var infoWindow = new google.maps.InfoWindow({map: map});
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }
    </script>
@endsection
