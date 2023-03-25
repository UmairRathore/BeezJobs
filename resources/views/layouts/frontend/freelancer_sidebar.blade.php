<div class="account_dt_left">

    <div class="job-center-dt">
        <img src="{{asset(auth()->user()->profile_image)}}" alt="">
        <div class="job-urs-dts">
            <div class="dp_upload">

                <input type="file" id="file">
                <label for="file">Upload Photo</label>
            </div>
            <h4>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h4>
            <span>{{auth()->user()->tagline}}</span>


        </div>
    </div>
    <?php
    $websites = explode(",", auth()->user()->websites);

     function calculateProfileCompleteness($user) {
        $fields = ['first_name', 'last_name', 'email', 'profile_image', 'birthday','location',
            'tagline', ' description', 'payrate','websites']; // List of fields to check
        $filledFields = 0;

        foreach ($fields as $field) {
            if (!empty($user->$field)) {
                $filledFields++;
            }
        }

        $completeness = ($filledFields / count($fields)) * 100;

        return $completeness;
    }
    $user = auth()->user(); // Get the authenticated user
    $floatvalue = calculateProfileCompleteness($user);
    $completeness = intval($floatvalue);
    ?>
    <div class="my_websites">
        <h4>Websites:</h4>
        @if(!empty($websites))
            <ul>
                @if($websites[0])
                    <li><a href="{{$websites[0]}}" class="web_link"><i class="fas fa-globe"></i>{{$websites[0]}}</a></li>
                @endif
                @if($websites[1])
                    <li><a href="{{$websites[1]}}" class="web_link"><i class="far fa-edit"></i>{{$websites[1]}}</a></li>
                @endif
                @if($websites[2])
                    <li><a href="{{$websites[2]}}" class="web_link"><i class="fa fa-columns"></i>{{$websites[2]}}</a></li>
                @endif
            </ul>
        @endif
    </div>
    <div class="group_skills_bar">
        <h6>Profile Completeness</h6>
        <div class="group_bar1">
            <span>{{$completeness}}</span>
            <div class="progress skill_process">
                <div class="progress-bar progress_bar_skills" role="progressbar" style="width: {{$completeness}}%;" aria-valuenow="{{$completeness}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <div class="rlt_section">
        <div class="rtl_left">
            <h6>Rating</h6>
        </div>
        <div class="rtl_right">
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <span>4.9</span>
            </div>
        </div>
    </div>
    <div class="rlt_section">
        <div class="rtl_left">
            <h6>Location</h6>
        </div>
        <div class="rtl_right">
            <span><i class="fas fa-map-marker-alt lc_icon"></i> {{auth()->user()->location}}</span>
        </div>
        <div class="my_location">
            <div id="map"></div>
        </div>
        <ul class="rlt_section2">
            <li>
                <div class="rtl_left2">
                    <h6>Hourly Rate</h6>
                </div>
                <div class="rtl_right2">
                    <span>{{auth()->user()->pay_rate}} / hr</span>
                </div>
            </li>
            <li>
                <div class="rtl_left2">
                    <h6>Birthdate</h6>
                </div>
                <div class="rtl_right2">
                    <span>{{auth()->user()->birthday}}</span>
                </div>
            </li>
            <li>
                <div class="rtl_left2">
                    <h6>Job Done</h6>
                </div>
                <div class="rtl_right2">
                    <span>69</span>
                </div>
            </li>
        </ul>

    </div>

    <div class="my_websites">
        <h4>Social Media Links:</h4>
        <ul>
            @if(auth()->user()->facebook_link)
                <li><a href="{{auth()->user()->facebook_link}}" class="web_link"><i class="fab fa-facebook-f"></i>{{auth()->user()->facebook_link}}</a></li>
            @endif
            @if(auth()->user()->google_link)
                <li><a href="{{auth()->user()->google_link}}" class="web_link"><i class="fab fa-google-plus-g"></i>{{auth()->user()->google_link}}</a></li>
            @endif
            @if(auth()->user()->youtube_link)
                <li><a href="{{auth()->user()->youtube_link}}" class="web_link"><i class="fab fa-youtube"></i>{{auth()->user()->youtube_link}}</a></li>
            @endif
            @if(auth()->user()->linkedin_link)
                <li><a href="{{auth()->user()->linkedin_link}}" class="web_link"><i class="fab fa-linkedin"></i>{{auth()->user()->linkedin_link}}</a></li>
            @endif
            @if(auth()->user()->instagram_link)
                <li><a href="{{auth()->user()->instagram_link}}" class="web_link"><i class="fab fa-instagram"></i>{{auth()->user()->instagram_link}}</a></li>
            @endif
            @if(auth()->user()->twitter_link)
                <li><a href="{{auth()->user()->twitter_link}}" class="web_link"><i class="fab fa-twitter"></i>{{auth()->user()->twitter_link}}</a></li>
            @endif
        </ul>
    </div>
</div>
