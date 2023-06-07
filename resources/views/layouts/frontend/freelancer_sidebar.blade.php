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

     function calculateProfileCompleteness($user) {
        $fields = ['first_name', 'last_name', 'email', 'profile_image', 'birthday','location',
            'tagline', ' description', 'payrate']; // List of fields to check
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
@if(auth()->check())
    <div class="group_skills_bar">
        <h6>Profile Completeness</h6>
        <div class="group_bar1">
            <span>{{$completeness}}%</span>
            <div class="progress skill_process">
                <div class="progress-bar progress_bar_skills" role="progressbar" style="width: {{$completeness}}%;" aria-valuenow="{{$completeness}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    @endif
    <div class="rlt_section">
        <div class="rtl_left">
            <h6>Rating</h6>
        </div>
        <?php
        $senderReviews = \App\Models\Review::where('receiver_id',\auth()->user()->id)->get();
        $ratingSum = $senderReviews->sum('rating');
        $totalReviews = $senderReviews->count();

        $averageRating = ($totalReviews > 0) ? $ratingSum / $totalReviews : 0;
        $ratingOutOfFive = round($averageRating, 2); // Round the average rating to 2 decimal places

        // Ensure the rating is within the range of 1 to 5
        $ratingOutOfFive = max(1, min(5, $ratingOutOfFive));

//        dd($ratingOutOfFive);
        ?>
        <div class="rtl_right">
            <div class="star">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $ratingOutOfFive)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
                    @if($ratingOutOfFive)
                        <span>{{ $ratingOutOfFive }}</span>
                    @else
                        <span>0</span>
                    @endif
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
                <?php
                $JobDone = \App\Models\User::find(auth()->user()->id)
                ->join('messages','messages.receiver_id','=','users.id')
                    ->join('offers','offers.id','messages.offer_id')
                    ->join('orders','orders.offer_id','offers.id')
                    ->where('orders.status','=','completed')
                    ->orWhere('orders.status','=','late-completed')
                    ->count();
//                dd($JobDone);
//                    ->join('')

//                    reciever_id from messages
//                    jahan offer is accepted
//                jahan pa order status = completed
                ?>
                <div class="rtl_right2">
                    <span>{{$JobDone}}</span>
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
