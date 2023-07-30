@extends('layouts.frontend.master')
@section('title', 'Post a Job')



@section('content')

    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                    @if (session('success'))
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                    @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="main-heading bids_heading">
                        <h2>Post a Job</h2>
                        <div class="line-shape1">
                            <img src="images/line.svg" alt="">
                        </div>
                    </div>
                    <div class="post501">

                        <form action="{{route('post_a_job')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="label15">Job Name*</label>
                                        <input type="text" name="title" class="job-input" placeholder="Job Name Here">
                                    </div>
                                    <div class="form-group">
                                        <label class="label15">What is needed*</label>
                                        <textarea name="description" class="textarea_input" placeholder="Tell us what you need......"></textarea>
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="label15">Attachments</label>
                                        <input type="file" name="file_attachments" class="job-input">
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
                                            <!-- Use the input type "text" for datepicker -->
                                            <input type="date" name="date" class="job-input" data-language="en"
                                                   id="datepicker" placeholder="YYYY-MM-DD"
                                            >
                                            <div class="mix_max"><i class="fas fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="label15">Meeting Option*</label>
                                        <div class="smm_input">
                                            <select name="online_or_in_person" class="job-input" onchange="toggleLocationInput(this)">
                                                <option value="online">Online</option>
                                                <option value="in_person">In Person</option>
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
                                            <input type="text" id="location" name="location" class="job-input" placeholder="Type Address">
                                            <div class="loc_icon"><i class="fas fa-map-marker-alt"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="requires">
                                        Budget
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
{{--                                    <label class="label15">Budget*</label>--}}
                                    <div class="smm_input">
                                        <input type="text" name="budget" class="job-input" placeholder="Budget">
                                        <div class="fa-money"><i class="fas fa-money"></i></div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="post_jp_btn" type="submit">Post a Job</button>
                                </div>
                            </div>
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
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}

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

            function toggleLocationInput(selectElement) {
            var locationField = document.getElementById("locationField");
            var selectedOption = selectElement.value;

            if (selectedOption === "in_person") {
            locationField.style.display = "block";
        } else {
            locationField.style.display = "none";
        }
        }


            $(function() {
            $("#datepicker").datepicker({
                format: "dd-M-yyyy", // Format the date as "dd-M-yyyy" (e.g., 12-Feb-1979)
                autoclose: true, // Close the datepicker when a date is selected
                todayHighlight: true // Highlight today's date
                // Add more options as needed
            }).on('change', function() {
                // Convert the selected date to the correct format before form submission
                var selectedDate = $(this).datepicker('getDate');
                var formattedDate = $.datepicker.formatDate('yy-mm-dd', selectedDate);
                $(this).val(formattedDate);
            });
        });
    </script>

@endsection
