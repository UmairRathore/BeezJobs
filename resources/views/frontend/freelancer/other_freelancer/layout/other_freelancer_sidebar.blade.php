<div class="col-lg-3 col-md-4">
    <div class="account_dt_left">
        <div class="job-center-dt">
            @if($users->profile_image)
                <img src="{{asset($users->profile_image)}}" alt="">
            @else
                <img src="{{asset('images/homepage/latest-jobs/img-1.jpg')}}" alt="">
            @endif
            <div class="job-urs-dts">
                <h4>{{$users->first_name.' '.$users->last_name}}</h4>
                <span>{{$users->profession}}</span>
            </div>
            <ul class="user_btns">
{{--                <li><button class="hire_btn" type="button">Hire Me</button></li>--}}
                <li>
{{--                    <button class="hire_btn" type="button">Message</button>--}}
                    @if(auth()->check())
                    <a href="{{route('freelancer_texting',[$users->id])}}"><button class="hire_btn" type="button">Message</button> </a></li>

                @else
                    <a href="{{route('signin')}}"><button class="hire_btn" type="button">Message</button> </a></li>
                @endif

            </ul>

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
        $user = $users->id; // Get the authenticated user
        $floatvalue = calculateProfileCompleteness($user);
        $completeness = intval($floatvalue);
        ?>

        <div class="group_skills_bar">
            <h6>Profile Completeness</h6>
            <div class="group_bar1">
                <span>{{$completeness}}%</span>
                <div class="progress skill_process">
                    <div class="progress-bar progress_bar_skills" role="progressbar" style="width: {{$completeness}}%;" aria-valuenow="{{$completeness}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="rlt_section">
            <div class="rtl_left">
                <h6>Rating</h6>
            </div>
            <?php
            $senderReviews = \App\Models\Review::where('receiver_id',$users->id)->get();
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
                <span><i class="fas fa-map-marker-alt lc_icon"></i> {{$users->location}}</span>
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
                        <span>${{$users->pay_rate}} / hr</span>
                    </div>
                </li>
                <li>
                    <div class="rtl_left2">
                        <h6>Job Done</h6>
                    </div>
                    <?php
                    $JobDone = \App\Models\User::find($users->id)
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
        <div class="social_section3 mb80">
            <div class="social_leftt3">
                <h6>Contact Social Account</h6>
            </div>
            <ul class="social_accounts">
                @if($users->facebook_link)
                    <li><a href="{{$users->facebook_link}}" class="web_link"><i class="fab fa-facebook-f"></i>{{$users->facebook_link}}</a></li>
                @endif
                @if($users->google_link)
                    <li><a href="{{$users->google_link}}" class="web_link"><i class="fab fa-google-plus-g"></i>{{$users->google_link}}</a></li>
                @endif
                @if($users->youtube_link)
                    <li><a href="{{$users->youtube_link}}" class="web_link"><i class="fab fa-youtube"></i>{{$users->youtube_link}}</a></li>
                @endif
                @if($users->linkedin_link)
                    <li><a href="{{$users->linkedin_link}}" class="web_link"><i class="fab fa-linkedin"></i>{{$users->linkedin_link}}</a></li>
                @endif
                @if($users->instagram_link)
                    <li><a href="{{$users->instagram_link}}" class="web_link"><i class="fab fa-instagram"></i>{{$users->instagram_link}}</a></li>
                @endif
                @if($users->twitter_link)
                    <li><a href="{{$users->twitter_link}}" class="web_link"><i class="fab fa-twitter"></i>{{$users->twitter_link}}</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
