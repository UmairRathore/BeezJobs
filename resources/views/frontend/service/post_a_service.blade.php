@extends('layouts.frontend.master')
@section('title', 'Post a Service')



@section('content')

    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post a Service</li>
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
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="main-heading bids_heading">
                        <h2>
                            @if(request()->query('edit'))
                                Update Your Services
                            @elseif(isset($heading))
                                {{$heading}}
                            @else
                                Post a Service
                            @endif
                        </h2>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <div class="post501">

                        <form action="{{ route('post_a_service.create') }}" method="post">
                            @csrf
{{--                            <div class="row">--}}
                                <div id="not_packages">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="label15">Service Name*</label>
                                                <input type="text" name="title" class="job-input" placeholder="Service Name Here" value="{{ isset($existingService) ? $existingService->title : old('title') }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="label15">Service Details*</label>
                                                <textarea name="description" class="textarea_input" placeholder="Service Details...">{{ isset($existingService) ? $existingService->description : old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="label15">Hourly Rate</label>
                                                <div class="smm_input">
                                                    <input type="text" name="hourly_rate" class="job-input" placeholder="Hourly Rate" value="{{ isset($existingService) ? $existingService->hourly_rate : old('hourly_rate') }}">
                                                    <div class="fa-money"><i class="fas fa-money"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="label15">Profession Category*</label>
                                                    <div class="smm_input">
                                                        <select name="profession_id" class="job-input">
                                                            <option value="">Select a category...</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->profession }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="label15">Meeting Option*</label>
                                                <div class="smm_input">
                                                    <select name="online_or_in_person" class="job-input" onchange="toggleLocationInput(this)">
                                                        <option value="online" {{ isset($existingService) && $existingService->online_or_in_person === 'online' ? 'selected' : '' }}>Online</option>
                                                        <option value="in_person" {{ isset($existingService) && $existingService->online_or_in_person === 'in_person' ? 'selected' : '' }}>In Person</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12" id="locationField" style="display: none;">
                                            <div class="requires">
                                                Location
                                            </div>
                                            <div class="form-group">
                                                <label class="label15">Location*</label>
                                                <div class="smm_input">
                                                    <input type="text" id="location" name="location" class="job-input" placeholder="Type Address" value="{{ isset($existingService) ? $existingService->location : old('location') }}">
                                                    <input type="hidden" id="latitude" name="latitude">
                                                    <input type="hidden" id="longitude" name="longitude">
                                                    <div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <button class="post_jp_btn" type="button" id="next_button">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="packages" class="d-none">
                                    <div class="col-lg-12">
                                        <div class="requires">
                                            Packages
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label15">Basic Package</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="label15">Basic Price*</label>
                                            <input type="text" name="basic_price" class="job-input" placeholder="Basic Package Price" value="{{ isset($existingService) ? $existingService->basic_price : old('basic_price') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label15">Basic Description*</label>
                                            <textarea name="basic_description" class="textarea_input" placeholder="Basic Package Details...">{{ isset($existingService) ? $existingService->basic_description : old('basic_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label15">Standard Package</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="label15">Standard Price</label>
                                            <input type="text" name="standard_price" class="job-input" placeholder="Standard Package Price" value="{{ isset($existingService) ? $existingService->standard_price : old('standard_price') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label15">Standard Description</label>
                                            <textarea name="standard_description" class="textarea_input" placeholder="Standard Package Details...">{{ isset($existingService) ? $existingService->standard_description : old('standard_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="label15">Premium Package</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="label15">Premium Price</label>
                                            <input type="text" name="premium_price" class="job-input" placeholder="Premium Package Price" value="{{ isset($existingService) ? $existingService->premium_price : old('premium_price') }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="label15">Premium Description</label>
                                            <textarea name="premium_description" class="textarea_input" placeholder="Premium Package Details...">{{ isset($existingService) ? $existingService->premium_description : old('premium_description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12" style="display: flex; justify-content: space-between;">
                                        <div class="button-container">
                                            <button class="post_jp_btn" type="button" id="back_button">Back</button>
                                        </div>
                                        <div class="button-container">
                                            <button class="post_jp_btn" type="submit">Post a Service</button>
                                        </div>
                                    </div>


                                </div>
{{--                            </div>--}}
                        </form>


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="main-heading bids_heading pjfaq80">
                        <h2>Steps</h2>
                    </div>
                    <div class="jp_faq">
                        <div class="jp_faq_item">
                            <h4>01. Complete the given form</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum mi at erat egestas, nec porta diam pharetra.</p>
                        </div>
                        <div class="jp_faq_item">
                            <h4>02. Check all inputs</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum mi at erat egestas, nec porta diam pharetra.</p>
                        </div>
                        <div class="jp_faq_item">
                            <h4>03. Post the job and get matched</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elementum mi at erat egestas, nec porta diam pharetra.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Body End -->

    <!-- Body Start -->



    <!-- Body End -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&libraries=places"></script>
    <script>
        var searchInput = 'location';

        const autocomplete = new google.maps.places.Autocomplete(
            document.getElementById(searchInput),
            {
                types: ['postal_code'],
                componentRestrictions: { country: 'US' } // optional
            }
        );

        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            console.log(place);

            // You can extract latitude and longitude from the 'place' object
            if (place.geometry && place.geometry.location) {
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                console.log('Latitude:', latitude);
                console.log('Longitude:', longitude);

                // Set the values of the hidden input fields
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            }
        });

        $(document).ready(function () {
            // When the "Next" button is clicked, show the "packages" div and hide the "not_packages" div
            $("#next_button").on("click", function () {
                $("#not_packages").addClass("d-none");
                $("#packages").removeClass("d-none");
                // $("#not_packages input").prop("disabled", true); // Disable input fields in #not_packages
            });

            // When the "Back" button is clicked, show the "not_packages" div and hide the "packages" div
            $("#back_button").on("click", function () {
                $("#packages").addClass("d-none");
                $("#not_packages").removeClass("d-none");
                // $("#not_packages input").prop("disabled", false); // Enable input fields in #not_packages
            });
        });

        function toggleLocationInput(selectElement) {
            var locationField = document.getElementById("locationField");
            var selectedOption = selectElement.value;

            if (selectedOption === "in_person") {
                locationField.style.display = "block";
            } else {
                locationField.style.display = "none";
            }
        }

    </script>
@endsection

{{--<div class="time-picker">--}}
{{--    <div class="time-box">--}}
{{--        <div class="icon">--}}
{{--            <i class="fas fa-sun"></i>--}}
{{--        </div>--}}
{{--        <div class="label">--}}
{{--            Morning--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="time-box">--}}
{{--        <div class="icon">--}}
{{--            <i class="fas fa-cloud-sun"></i>--}}
{{--        </div>--}}
{{--        <div class="label">--}}
{{--            Afternoon--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="time-box">--}}
{{--        <div class="icon">--}}
{{--            <i class="fas fa-cloud-moon"></i>--}}
{{--        </div>--}}
{{--        <div class="label">--}}
{{--            Evening--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="time-box">--}}
{{--        <div class="icon">--}}
{{--            <i class="fas fa-moon"></i>--}}
{{--        </div>--}}
{{--        <div class="label">--}}
{{--            Night--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
