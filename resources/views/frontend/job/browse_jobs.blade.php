@extends('layouts.frontend.master')
@section('title', 'Browse Jobs')
@section('content')

    <!-- Title Start -->

    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Browser Jobs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Start -->
    <!-- Body Start -->
    <main class="browse-section">
        <div class="container">
{{--                            <div id="map" style="height: 400px;"></div>--}}
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <form id="browse_jobs_filters" method="get" action="{{route('browse_jobs')}}">
                        <div class="browser-job-filters">
                            <div class="filter-heading">
                                <div class="fh-left">
                                    Filters
                                </div>
                                <div class="fh-right">
                                    <a href="#">Clear All Filters</a>
                                </div>
                            </div>
                            <div class="filter-heading">
                                <div class="fh-center">
                                    <a href="{{route('browse_freelancers')}}">Switch to Freelancers</a>
                                </div>
                            </div>


                            <div class="fltr-group">
                                <div class="fltr-items-heading">
                                    <div class="fltr-item-left">
                                        <h6>Category</h6>
                                    </div>
                                    <div class="fltr-item-right">
                                        <a href="#">Clear</a>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="field">
                                        <label></label>
                                        <select class="ui fluid dropdown" name="category[]" multiple>
                                            <option value="">Select category...</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->profession }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="fltr-group">
                                <div class="fltr-items-heading">
                                    <div class="fltr-item-left">
                                        <h6>Online/In-person</h6>
                                    </div>
                                    <div class="fltr-item-right">
                                        <a href="#">Clear</a>
                                    </div>
                                </div>

                                <div class="inline fields">
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="online_in_person" value="online">
                                            <label>Online</label>
                                        </div>
                                    </div>

                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="online_in_person" value="in_person" data-type="in_person">
                                            <label>In-person</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="radiusInputContainer" style="display: none;">
                                    <label for="radius">Location:</label>
                                        <input id="location" class="job-input" type="text" name="location" placeholder="Enter a location">
                                        <input type="hidden" id="lat" name="lat">
                                        <input type="hidden" id="lng" name="lng">
                                    <label for="radius">Radius in miles:</label>
                                    <input class="job-input" type="number" id="radius" name="radius" placeholder="Enter radius in miles">
                                </div>
                            </div>

                            <div class="fltr-group">
                                <div class="fltr-items-heading">
                                    <div class="fltr-item-left">
                                        <h6>Pay Rate <span>($)</span></h6>
                                    </div>
                                    <div class="fltr-item-right">
                                        <a href="#">Clear</a>
                                    </div>
                                </div>
                                <div class="filter-dd">
                                    <div class="rg-limit" style="display: flex; justify-content: space-between;">
                                        <div>
                                            <input type="number" min="0" max="1000" step="1" name="pay_rate_min" placeholder="Min"/>
                                        </div>
                                        <div>
                                            <input type="number" min="0" max="1000" step="1" name="pay_rate_max" placeholder="Max"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fltr-group">
                                <div class="fltr-items-heading">
                                    <div class="fltr-item-left">
                                        <h6>Bid <span>($)</span></h6>
                                    </div>
                                    <div class="fltr-item-right">
                                        <a href="#">Clear</a>
                                    </div>
                                </div>
                                <div class="filter-dd">

                                    <div class="ui checkbox">
                                        <input type="checkbox" name="has_bid" value="1" @if(request()->has('has_bid')) checked @endif>
                                        <label>Has Bid</label>
                                    </div>
                                </div>
                            </div>


                            <div class="filter-button">
                                <button id="submitbutton" type="submit" class="flr-btn">Search Now</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 col-md-7 mainpage">

                    <div class="main-tabs">
                        <div class="res-tabs">
                            <div class=" mtab-left">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a href="#tab-1" class="nav-link active" data-toggle="tab">Jobs</a>
                                    </li>
                                </ul>
                            </div>
                            <div class=" mtab-right">
                                <ul>
                                    <li class="grid-list">
                                        <button class="gl-btn" id="grid"><i class="fas fa-th-large"></i></button>
                                        <button class="gl-btn" id="list"><i class="fas fa-th-list"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                                <div class="row  view-group" id="products">
{{--                                                                            {{dd($jobs)}}--}}
                                    @foreach($jobs as $key => $job)
{{--                                        {{dd($job->distance)}}--}}
                                        <div class="lg-item col-lg-6 col-xs-6 grid-group-item1">
                                            <div class="job-item mt-30">
                                                <div class="job-top-dt">
                                                    <div class="job-left-dt">
                                                        @if($job->profile_image)
                                                            <img src="{{asset($job->profile_image)}}" alt="">
                                                        @else
                                                            <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
                                                        @endif
                                                        <div class="job-ut-dts">
                                                            <a href="{{route('other_freelancer_profile',[$job->user_id])}}"><h4>{{$job->first_name.' '.$job->last_name}}</h4></a>
                                                            <span><i class="fas fa-map-marker-alt"></i>
                                                                {{$job->location}} {{'  '}}

                                                                @if(isset($users))
                                                           <?php
                                                           foreach($users as $user){
                                                           if($user->id == $job->user_id)
                                                               {
                                                               $distance = round($user->distance * 0.621371);
                                                               }
                                                           }
                                                                ?>
                                                                @if($distance > 0)
                                                                <span style="font-weight: bold;"> ({{$distance}} miles)</span>
                                                                    @endif
                                                                    @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="job-right-dt">
                                                        <div class="job-price">${{$job->budget}}</div>
                                                        {{--														<div class="job-fp">{{$job->time_of_day}}</div>--}}
                                                    </div>
                                                </div>
                                                <div class="job-des-dt">
                                                    <h4>{{$job->profession}}</h4>
                                                    <p>{{ Illuminate\Support\Str::limit($job->description, 80, '...') }}</p>
                                                </div>
                                                <div class="job-buttons">
                                                    <ul class="link-btn">
                                                        <li><a href="#" class="link-j1" title="Apply Now">APPLY NOW</a></li>
                                                        <li><a href="{{route('job_single_view',[$job->jid])}}" class="link-j1" title="View Job">View Job</a></li>
                                                        <li class="bkd-pm">
                                                            <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--                                                        {!! $jobs->links() !!}--}}
                                    <div class="col-12">
                                        <div class="main-p-pagination">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $jobs->PreviousPageUrl() }}" aria-label="Previous">
                                                            PREV
                                                        </a>
                                                    </li>
                                                    @if ($jobs->currentPage() > 3)
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $jobs->url(1) }}">1</a>
                                                        </li>
                                                        @if ($jobs->currentPage() > 4)
                                                            <li class="page-item">
                                                                <span class="page-link">...</span>
                                                            </li>
                                                        @endif
                                                    @endif

                                                    @for ($i = max(1, $jobs->currentPage() - 2); $i <= min($jobs->lastPage(), $jobs->currentPage() + 2); $i++)
                                                        <li class="page-item{{ $i == $jobs->currentPage() ? ' active' : '' }}">
                                                            @if ($i == $jobs->currentPage())
                                                                <span class="page-link">{{ $i }}</span>
                                                            @else
                                                                <a class="page-link" href="{{ $jobs->url($i) }}">{{ $i }}</a>
                                                            @endif
                                                        </li>
                                                    @endfor

                                                    @if ($jobs->currentPage() < $jobs->lastPage() - 2)
                                                        @if ($jobs->currentPage() < $jobs->lastPage() - 3)
                                                            <li class="page-item">
                                                                <span class="page-link">...</span>
                                                            </li>
                                                        @endif
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $jobs->url($jobs->lastPage()) }}">{{ $jobs->lastPage() }}</a>
                                                        </li>
                                                    @endif
                                                    {{--
                                                    {{--                                                        <li class="page-item"><a class="page-link" href="#">24</a></li>--}}
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $jobs->nextPageUrl() }}" aria-label="Next">
                                                            NEXT
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
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
    {{--{{dd($jobs)}}--}}
    {{--<?php--}}
    {{--    $data[] = '';--}}
    {{--foreach($jobs as $job)--}}
    {{-- {--}}
    {{--$data = $job->latitude.'   '.$job->longitude;--}}
    {{--}--}}
    {{--dd($data);--}}
    {{--    ?>--}}
@endsection

@section('google_Map_Location_SignUp')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&callback=initMap" async defer></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&libraries=places"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/6.3.0/turf.min.js"></script>

    <script>
        var map;

        function initMap() {
            // alert('initMap function is called');



            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 51.5074, lng: -0.1278},
                zoom: 10,

            });

            var bounds = new google.maps.LatLngBounds();

            @foreach($jobs as $job)
            var position = {lat: {{ $job->latitude }}, lng: {{ $job->longitude }}};
            createMarker(position, '{{ addslashes($job->title) }}', '{{ addslashes($job->location) }}');
            bounds.extend(position); // Extend bounds to include the marker
            @endforeach

            // Fit the map to show all markers
            if (bounds.isEmpty()) {
                // No markers found, show default view
                map.setCenter({lat: 51.5074, lng: -0.1278});
                map.setZoom(10);
            } else {
                map.fitBounds(bounds);
            }
        }

        var searchInput = 'location';

        const autocomplete = new google.maps.places.Autocomplete(
            document.getElementById(searchInput),
            {
                types: ['address'],
                componentRestrictions: { country: 'US' } // optional
            }
        );


        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            console.log(place);

            // Update the hidden input fields with latitude and longitude values
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();
            // alert(document.getElementById('lng').value);
        });

        function createMarker(position, title, content) {
            var marker = new google.maps.Marker({
                position: position,
                map: map,
                title: title
            });

            var infowindow = new google.maps.InfoWindow({
                content: '<div>' + title + ' - ' + content + '</div>'
            });

            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
        }

        window.onload = function () {
            initMap();
        };

        const inPersonRadio = document.querySelector('input[value="in_person"]');
        const onlineRadio = document.querySelector('input[value="online"]');
        const locationInput = document.getElementById('location');
        const radiusInputContainer = document.getElementById('radiusInputContainer'); // Assuming you have this element

        inPersonRadio.addEventListener('change', function () {
            if (inPersonRadio.checked) {
                radiusInputContainer.style.display = 'block';
                locationInput.style.display = 'block';
            } else {
                locationInput.style.display = 'none';
                radiusInputContainer.style.display = 'none';
            }
        });

        onlineRadio.addEventListener('change', function () {
            locationInput.style.display = 'none';
            radiusInputContainer.style.display = 'none';
        });

        const form = document.getElementById('browse_jobs_filters'); // Use the actual ID of your form

        form.addEventListener('submit', function (event) {
            if (inPersonRadio.checked) {
                if (!locationInput.value.trim()) {
                    event.preventDefault();
                    locationInput.classList.add('invalid');
                    if (!locationInput.nextElementSibling || !locationInput.nextElementSibling.classList.contains('validation-error')) {
                        locationInput.insertAdjacentHTML('afterend', '<div class="validation-error" style="color: red;">Location is required.</div>');
                    }
                } else {
                    locationInput.classList.remove('invalid');
                    const locationErrorMessage = document.querySelector('label[for="location"] + .validation-error');
                    if (locationErrorMessage) {
                        locationErrorMessage.remove();
                    }
                }

                const radiusInput = document.getElementById('radius');

                if (!radiusInput.value.trim()) {
                    event.preventDefault();
                    radiusInput.classList.add('invalid');
                    if (!radiusInput.nextElementSibling || !radiusInput.nextElementSibling.classList.contains('validation-error')) {
                        radiusInput.insertAdjacentHTML('afterend', '<div class="validation-error" style="color: red;">Radius is required.</div>');
                    }
                } else {
                    radiusInput.classList.remove('invalid');
                    const radiusErrorMessage = document.querySelector('label[for="radius"] + .validation-error');
                    if (radiusErrorMessage) {
                        radiusErrorMessage.remove();
                    }
                }
            }
        });


    </script>

@endsection
