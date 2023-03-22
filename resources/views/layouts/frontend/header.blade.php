<div class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="top-header-full">
                    <div class="top-left-hd">
                        <ul>
                            <li><div class="wlcm-text">Welcome to Jobby</div></li>
                            <li>
                                <div class="lang-icon dropdown">
                                    <i class="fas fa-globe ln-glb"></i>
                                    <a href="#" class="icon15 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                        EN <i class="fas fa-caret-down p-crt"></i>
                                    </a>
                                    <div class="dropdown-menu lanuage-dropdown dropdown-menu-left">
                                        <a class="link-item" href="#">EN</a>
                                        <a class="link-item" href="#">DE</a>
                                        <a class="link-item" href="#">RU</a>
                                        <a class="link-item" href="#">ES</a>
                                        <a class="link-item" href="#">FR</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="top-right-hd">
                        <ul>
                            <li class="dropdown">
                                <a href="#" class="icon14 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                    <i class="fas fa-envelope"></i><div class="circle-alrt"></div>
                                </a>
                                <div class="dropdown-menu message-dropdown dropdown-menu-right">
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="#"><img src="images/user-dp-1.jpg" alt="">
                                                    <div class="user-title1">Jassica William </div>
                                                    <span>Hey How are you John Doe...</span>
                                                </a>
                                            </div>
                                            <div class="time5">2 min ago</div>
                                        </div>
                                    </div>
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="#"><img src="images/user-dp-1.jpg" alt="">
                                                    <div class="user-title1">Rock Smith </div>
                                                    <span>Interesting Event! I will join this...</span>
                                                </a>
                                            </div>
                                            <div class="time5">5 min ago</div>
                                        </div>
                                    </div>
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="#"><img src="images/user-dp-1.jpg" alt="">
                                                    <div class="user-title1">Joy Doe </div>
                                                    <span>Hey Sir! What about you...</span>
                                                </a>
                                            </div>
                                            <div class="time5">10 min ago</div>
                                        </div>
                                    </div>
                                    <div class="user-request-list">
                                        <a href="{{route('my_freelancer_messages')}}" class="view-all">View All Messages</a>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="icon14 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                    <i class="fas fa-bell"></i><div class="circle-alrt"></div>
                                </a>
                                <div class="dropdown-menu message-dropdown dropdown-menu-right">
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="#">
                                                    <div class="noti-icon"><i class="fas fa-users"></i></div>
                                                    <div class="user-title1">Rock William </div>
                                                    <span>applied for a <ins class="noti-p-link">Php Developer</ins>.</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="#">
                                                    <div class="noti-icon"><i class="fas fa-bullseye"></i></div>
                                                    <div class="user-title1">Johnson Smith</div>
                                                    <span>placed a bid on your <ins class="noti-p-link">I Need a ...</ins></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="#">
                                                    <div class="noti-icon"><i class="fas fa-exclamation"></i></div>

                                                    <span class="pt-2">Your job listing <ins class="noti-p-link">Wordpress Developer</ins> is expiring.</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-request-list">
                                        <a href="{{route('my_freelancer_notifications')}}" class="view-all">View All Notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="account order-1 dropdown">
                                    @if(auth()->check())
                                    <a href="#" class="account-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                        <div class="user-dp"><img src="{{asset(auth()->user()->profile_image)}}" alt=""></div>
                                        <span>Hi {{auth()->user()->first_name}}</span>
                                        <i class="fas fa-sort-down"></i>
                                    </a>
                                    @else
                                    <a href="{{route('signin')}}"><button class="btn">Sign In</button></a>
                                    @endif
                                    <div class="dropdown-menu account-dropdown dropdown-menu-right">
                                        <a class="link-item" href="{{route('my_freelancer_dashboard')}}">Dashboard</a>
                                        <a class="link-item" href="{{route('my_freelancer_setting')}}">Setting</a>
                                        <a class="link-item" href="{{route('my_freelancer_messages')}}">My Messages</a>
                                        <a class="link-item" href="{{route('my_freelancer_jobs')}}">My Jobs</a>
                                        <a class="link-item" href="{{route('my_freelancer_bids')}}">My Bids</a>
                                        <a class="link-item" href="{{route('my_freelancer_portfolio')}}">My Portfolio</a>
                                        <a class="link-item" href="{{route('my_freelancer_bookmarks')}}">My Bookmarks</a>
                                        <a class="link-item" href="{{route('my_freelancer_payments')}}">Payments</a>
                                        <a class="link-item" href="{{route('signout')}}">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark1 justify-content-sm-start">
                    <a class="order-1 order-lg-0 ml-lg-0 ml-3 mr-auto" href="{{route('index')}}"><img src="{{asset('images/logo.svg')}}" alt=""></a>
                    <button class="navbar-toggler align-self-start" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end bg-dark1 p-3 p-lg-0 mt1-5 mt-lg-0 mobileMenu" id="navbarSupportedContent">
                        <ul class="navbar-nav align-self-stretch">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Jobs</a>
                                <div class="dropdown-menu pages-dropdown">
                                    <a class="link-item" href="browse_jobs.html">Browse Jobs</a>
                                    <a class="link-item" href="job_single_view.html">Single Job View</a>
                                    <a class="link-item" href="post_a_job.html">Post a Job</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Work</a>
                                <div class="dropdown-menu pages-dropdown">
                                    <a class="link-item" href="browse_projects.html">Browse Projects</a>
                                    <a class="link-item" href="project_single_view.html">Single Project View</a>
                                    <a class="link-item" href="post_a_project.html">Post a Project</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Companies</a>
                                <div class="dropdown-menu pages-dropdown">
                                    <a class="link-item" href="browse_companies.html">Browse Companies</a>
                                    <a class="link-item" href="other_company_profile.html">Company Profile</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Freelancers</a>
                                <div class="dropdown-menu pages-dropdown">
                                    <a class="link-item" href="browse_freelancers.html">Browse Freelancers</a>
                                    <a class="link-item" href="other_freelancer_profile.html">Freelancer Profile</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown pages152">
                                <a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                    Pages <i class="fas fa-caret-down p-crt"></i>
                                </a>
                                <div class="dropdown-menu pages-dropdown">
                                    <a class="link-item" href="about.html">About</a>
                                    <a class="link-item" href="our_blog.html">Our Blog</a>
                                    <a class="link-item" href="blog_single_view.html">Signle Blog View</a>
                                    <a class="link-item" href="pricing_plans.html">Pricing Plans</a>
                                    <a class="link-item" href="checkout.html">Checkout</a>
                                    <a class="link-item" href="plan_invoice.html">Invoice Slip</a>
                                    <a class="link-item" href="sign_in.html">Sign in</a>
                                    <a class="link-item" href="sign_up.html">Sign up</a>
                                    <a class="link-item" href="sign_up_select_profile.html">Sign up Select Profiles</a>
                                    <a class="link-item" href="sign_up_freelancer_profile.html">Create Freelancer Profile</a>
                                    <a class="link-item" href="sign_up_company_profile.html">Create Company Profile</a>
                                    <a class="link-item" href="contact_us.html">Contact</a>
                                    <a class="link-item" href="help_center.html">Help Center</a>
                                </div>
                            </li>
                        </ul>
                        <a href="#" class="search-link" role="button" data-toggle="modal" data-target="#searchModal"><i class="fas fa-search"></i></a>
                        <a href="post_a_job.html" class="add-post">Post a Job</a>
                    </div>
                    <div class="responsive-search order-1">
                        <input type="text" class="rsp-search" placeholder="Search...">
                        <i class="fas fa-search r-sh1"></i>
                    </div>
                </nav>
                <div class="overlay"></div>
            </div>
        </div>
    </div>
</div>
