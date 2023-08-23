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
                        <h2>Sign Up to BeezJobs</h2>
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
                        <div class="form-group">
                            <hr>
                            <p>Or sign up with:</p>
                            <a href="{{ route('google.login') }}" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Login with Google
                            </a>
                            <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                            </a>
                        </div>

                        <button type="submit" class="lr_btn"> Next</button>
                    </form>
                    <div class="done140">
                        Already have an account?<a href="{{route('signin')}}">Sign in Now<i class="fas fa-angle-double-right"></i></a>
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
</main>
<!-- Body End -->


@endsection
@section('google_Map_Location_SignUp')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&callback=initMap"
            async defer></script>
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&libraries=places"></script>--}}

    <script>
        // function initMap() {
        //     var map = new google.maps.Map(document.getElementById('map'), {
        //         center: {lat: -34.397, lng: 150.644},
        //         zoom: 8
        //     });
        //
        //     var marker = new google.maps.Marker({
        //         position: {lat: -34.397, lng: 150.644},
        //         map: map,
        //         draggable: true
        //     });
        //
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(function (position) {
        //             var pos = {
        //                 //actual code
        //                 // lat: position.coords.latitude,
        //                 // lng: position.coords.longitude
        //
        //                 //testing code
        //                 lat: 40.7536854,
        //                 lng:-73.9991637
        //             };

        //             marker.setPosition(pos);
        //             map.setCenter(pos);
        //
        //             var geocoder = new google.maps.Geocoder();
        //             geocoder.geocode({ 'location': pos }, function(results, status) {
        //                 if (status === 'OK') {
        //                     if (results[0]) {
        //                         document.getElementById('location').value = results[0].formatted_address;
        //                     } else {
        //                         window.alert('No results found');
        //                     }
        //                 } else {
        //                     window.alert('Geocoder failed due to: ' + status);
        //                 }
        //             });
        //
        //             document.getElementById('latitude').value = position.coords.latitude;
        //             document.getElementById('longitude').value = position.coords.longitude;
        //         }, function () {
        //             handleLocationError(true, map.getCenter());
        //         });
        //     } else {
        //         handleLocationError(false, map.getCenter());
        //     }
        //
        //     google.maps.event.addListener(marker, 'dragend', function (event) {
        //         var geocoder = new google.maps.Geocoder();
        //         geocoder.geocode({ 'location': event.latLng }, function(results, status) {
        //             if (status === 'OK') {
        //                 if (results[0]) {
        //                     document.getElementById('location').value = results[0].formatted_address;
        //                 } else {
        //                     window.alert('No results found');
        //                 }
        //             } else {
        //                 window.alert('Geocoder failed due to: ' + status);
        //             }
        //         });
        //
        //         document.getElementById('latitude').value = event.latLng.lat();
        //         document.getElementById('longitude').value = event.latLng.lng();
        //     });
        // }
        //
        // function handleLocationError(browserHasGeolocation, pos) {
        //     var infoWindow = new google.maps.InfoWindow({map: map});
        //     infoWindow.setPosition(pos);
        //     infoWindow.setContent(browserHasGeolocation ?
        //         'Error: The Geolocation service failed.' :
        //         'Error: Your browser doesn\'t support geolocation.');
        // }




                    function initMap() {
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: { lat: -34.397, lng: 150.644 },
                            zoom: 8
                        });

                        var marker = new google.maps.Marker({
                            position: { lat: -34.397, lng: 150.644 },
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
                                geocoder.geocode({ 'location': pos }, function (results, status) {
                                    if (status === 'OK') {
                                        if (results[0]) {
                                            var addressComponents = results[0].address_components;
                                            var zipcode = '';
                                            var city = '';
                                            var state = '';
                                            var country = '';

                                            for (var i = 0; i < addressComponents.length; i++) {
                                                var types = addressComponents[i].types;
                                                if (types.includes('postal_code')) {
                                                    zipcode = addressComponents[i].long_name;
                                                }
                                                if (types.includes('locality')) {
                                                    city = addressComponents[i].long_name;
                                                }
                                                if (types.includes('administrative_area_level_1')) {
                                                    state = addressComponents[i].short_name;
                                                }
                                                if (types.includes('country')) {
                                                    country = addressComponents[i].long_name;
                                                }
                                            }
                                            var locationValue =  city + ', ' + state +' '+ zipcode + ', ' + country;
                                            document.getElementById('location').value = locationValue;
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
                            geocoder.geocode({ 'location': event.latLng }, function (results, status) {
                                if (status === 'OK') {
                                    if (results[0]) {
                                        var addressComponents = results[0].address_components;
                                        var zipcode = '';
                                        var city = '';

                                        // Extract zipcode and city name from address components
                                        for (var i = 0; i < addressComponents.length; i++) {
                                            var types = addressComponents[i].types;
                                            if (types.includes('postal_code')) {
                                                zipcode = addressComponents[i].long_name;
                                            }
                                            if (types.includes('locality')) {
                                                city = addressComponents[i].long_name;
                                            }
                                        }

                                        // Set the location field value to "zipcode + cityname"
                                        var locationValue = zipcode + ' ' + city;
                                        document.getElementById('location').value = locationValue;
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
                        var infoWindow = new google.maps.InfoWindow({ map: map });
                        infoWindow.setPosition(pos);
                        infoWindow.setContent(browserHasGeolocation ?
                            'Error: The Geolocation service failed.' :
                            'Error: Your browser doesn\'t support geolocation.');
                    }

    </script>
@endsection
