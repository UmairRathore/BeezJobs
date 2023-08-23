<!-- <div class="subscribe-newsletter">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6 col-md-6">
                <div class="subcribes">
                    <div class="text-step1">
                        <h4>Subscribe to Newsletter</h4>
                        <div class="btext-heading mt-2" style="color:#acacac; font-size:14px;">
                            <i class="fas fa-check-circle"></i>Cras nunc mauris, rhoncus eu justo at, egestas sagittis felis. Ut sed feugiat eros.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="subcribe-input">
                    <input class="nltr-input" type="email" placeholder="Your Email Address">
                    <button class="s-btn">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-4 col-md-4">
            <div class="about-jobby">
                <a href="{{route('index')}}"><img src="images/logo1.svg" alt=""></a>
                <?php
                $jobyabout = \App\Models\About::first();
                $aboutDescription= strip_tags($jobyabout->description);
                $shortDescription = substr($aboutDescription, 0, 230);
                $trimmedDescription = rtrim($shortDescription, ' .,;:-');
                ?>
                <p>{{$trimmedDescription}}....</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="footer-links">
                <h4>About</h4>
                <ul>
                    <li><a href="{{route('about.us')}}">About Us</a></li>
                    <li><a href="{{route('signin')}}">Login</a></li>
                    <li><a href="{{route('contact.us')}}">Contact</a></li>
                    <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                    <li><a href="{{route('terms')}}">Terms of Use</a></li>
{{--                    <li><a href="my_freelancer_profile.html">My Account</a></li>--}}
                </ul>
            </div>
        </div>
        <div class="col-lg-2 col-md-2">
            <div class="footer-links">
                <h4>For Users</h4>
                <ul>
                    <li><a href="{{route('browse_freelancers')}}">Browse Freelancers</a></li>
                    <li><a href="{{route('browse_jobs')}}">Browse Jobs</a></li>
                    <li><a href="{{(route('post_a_job'))}}">Post a Job</a></li>

                </ul>
            </div>
        </div>

    </div>
</div>
<div class="copy-social">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="copyright">
                    <i class="far fa-copyright"></i>Copyright 2023 <span>BeezJobs</span> by <a href="https://nadeem-aslam.web.app" >NH Tech</a>. All Right Reserved.
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="social-icons">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
