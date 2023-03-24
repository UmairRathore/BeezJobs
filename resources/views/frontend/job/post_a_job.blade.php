@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')

    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post a Job</li>
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
                        <h2>Post a Job</h2>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <div class="post501">
                        <form action="{{route('tasks.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="label15">Job Name*</label>
                                        <input type="text" name="title" class="job-input" placeholder="Job Name Here">
                                    </div>
                                    <div class="form-group">
                                        <label class="label15">Job Description*</label>
                                        <textarea name="description" class="textarea_input" placeholder="Type Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="requires">
                                        Time and Date
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Date*</label>
                                        <div class="smm_input">
                                            <input type="date" name="date" class="job-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Time*</label>
                                        <div class="smm_input">
                                            <select name="time_of_day" class="job-input">
                                                <option value="morning">Morning</option>
                                                <option value="afternoon">Afternoon</option>
                                                <option value="evening">Evening</option>
                                                <option value="night">Night</option>
                                            </select>
                                            <div class="fa-clock"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="requires">
                                        Location
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Meeting Option*</label>
                                        <div class="smm_input">
                                            <select name="online_or_in_person" class="job-input">
                                                <option value="online">Online</option>
                                                <option value="in_person">In Person</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Location*</label>
                                        <div class="smm_input">
                                            <input type="text" name="location" class="job-input" placeholder="Type Address">
                                            <div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="requires">
                                        Budget
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label15">Budget*</label>
                                    <div class="smm_input">
                                        <input type="text" name="budget" class="job-input" placeholder="Budget">
                                        <div class="fa-money"><i class="fas fa-money"></i></div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <button class="post_jp_btn" type="submit">Post a Job</button>
                                </div>
                            </div>
                        </form>


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
                types: ['address'],
                // componentRestrictions: { country: 'US' } // optional
            }
        );

        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            console.log(place); //
        });
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
