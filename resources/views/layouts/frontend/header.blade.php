<?php
namespace App\Http\Controllers\Admin;
use App\Models\Message;
use App\Models\User;
?>
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
                    <?php
if(auth()->check()) {
    $messages1 = Message::
    where('sender_id', Auth()->user()->id)
        ->orWhere('receiver_id',Auth()->user()->id)
        ->orderby('id', 'desc')
        ->get()
        ->unique('sender_id')
        ->pluck('sender_id')
        ->toArray();

    $messages2 = Message::
    where('sender_id', Auth()->user()->id)
        ->orWhere('receiver_id',Auth()->user()->id)
        ->orderby('id', 'desc')
        ->get()
        ->unique('receiver_id')
        ->pluck('receiver_id')
        ->toArray();
    $result1 = array_merge($messages1, $messages2);
    $result = array_unique($result1);
    $latestMessage=  Message::where('sender_id', Auth()->user()->id)
        ->orWhere('receiver_id',Auth()->user()->id)
        ->orderby('id', 'desc')
        ->pluck('message')
        ->first();

    $users = User::whereIn('id',$result)
        ->where('id','!=',Auth()->user()->id)
        ->get();
}

                    ?>
{{--                                            {{dd($users)}}--}}
                    <div class="top-right-hd">
{{--                        <ul>{{dd($users)}}--}}
                                    @if(isset($users,Auth()->user()->id))
                            <li class="dropdown">
                                <a href="#" class="icon14 dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                    <i class="fas fa-envelope"></i><div class="circle-alrt"></div>
                                </a>
                                <div class="dropdown-menu message-dropdown dropdown-menu-right">
                                    @foreach($users as $user)
                                    <div class="user-request-list">
                                        <div class="request-users">
                                            <div class="user-request-dt">
                                                <a href="{{route('freelancer_texting',[$user->id])}}">
{{--                                                    @if($user->profile_image)--}}
{{--                                                        <img src="{{asset($user->profile_image)}}" alt="">--}}
{{--                                                    @else--}}
                                                    <img src="{{asset('images/user-dp-1.jpg')}}" alt="">
{{--                                                    @endif--}}
                                                    <div class="user-title1">{{$user->first_name.' '.$user->last_name}} </div>
{{--                                                 @if(isset($latestMessage))--}}
                                                    <?php
                                                    $latestMessage = Message::select('messages.created_at','messages.message')
                                                        ->whereIn('sender_id', [$user->id,Auth()->user()->id])
                                                        ->whereIn('receiver_id',[$user->id,Auth()->user()->id])
                                                        ->orderby('id', 'desc')
                                                        ->where('message','!=',Null)
                                                        ->first();
                                                    ?>
                                                    <span>{{ $latestMessage->message }}</span>
{{--                                                    <span style="color: black">{{\Carbon\Carbon::parse($latestMessage->created_at)->diffForHumans()}}</span>--}}
{{--                                                        @endif--}}
                                                </a>
                                            </div>
                                            <div class="time5">{{$latestMessage->created_at->diffForHumans()}}</div>
                                        </div>
                                    </div>
                                            @endforeach
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
                            @endif
                            <li>
                                <div class="account order-1 dropdown">
                                    @if(auth()->check())
                                    <a href="#" class="account-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">
                                        @if(auth()->user()->profile_image)
                                        <div class="user-dp"><img src="{{asset(auth()->user()->profile_image)}}" alt=""></div>
                                        @else
                                            <div class="user-dp"><img src="{{asset('images/user-dp-1.jpg')}}" alt=""></div>
                                        @endif
                                            <span>Hi {{auth()->user()->first_name}}</span>
                                        <i class="fas fa-sort-down"></i>
                                    </a>
                                    @else
                                    <a href="{{route('signin')}}"><button class="btn">Sign In</button></a>
                                    @endif
                                    <div class="dropdown-menu account-dropdown dropdown-menu-right">
                                        <a class="link-item" href="{{route('my_freelancer_dashboard')}}">Dashboard</a>
                                        <a class="link-item" href="{{route('my_freelancer_messages')}}"> Messages</a>
                                        <a class="link-item" href="{{route('my_freelancer_jobs')}}"> Jobs</a>
                                        <a class="link-item" href="{{route('my_freelancer_bids')}}"> Bids</a>
                                        <a class="link-item" href="{{route('my_freelancer_portfolio')}}"> Portfolio</a>
                                        <a class="link-item" href="{{route('my_freelancer_bookmarks')}}"> Bookmarks</a>
                                        <a class="link-item" href="{{route('my_freelancer_payments')}}">Payments</a>
                                        <a class="link-item" href="{{route('my_freelancer_setting')}}">Setting</a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item ">
{{--                                <a href="#" class="nav-link dropdown-toggle-no-caret" role="button" data-toggle="dropdown">Find Jobs</a>--}}
{{--                                <div class="dropdown-menu pages-dropdown">--}}
{{--                                    <a class="nav-link" href="{{route('browse_jobs')}}">Browse Jobs</a>--}}
                                <a class="nav-link" href="{{ auth()->check() ? route('browse_jobs', ['lat' => auth()->user()->latitude, 'lng' => auth()->user()->longitude]) : route('browse_jobs') }}">Browse Jobs</a>

                                {{--                                    @if(auth()->check())--}}
{{--                                    <a class="link-item" href="{{route('post_a_job')}}">Post a Job</a>--}}
{{--                                        @endif--}}
{{--                                </div>--}}
                            </li>


                            <li class="nav-item">
{{--                                    <a class="nav-link" href="{{route('browse_freelancers', ['lat' => auth()->user()->latitude, 'lng' => auth()->user()->longitude])}}">Browse Freelancers</a>--}}
                                <a class="nav-link" href="{{ auth()->check() ? route('browse_freelancers', ['lat' => auth()->user()->latitude, 'lng' => auth()->user()->longitude]) : route('browse_freelancers') }}">Browse Freelancers</a>

                            </li>

                        </ul>

{{--                        @if(auth()->check())--}}
                        <a href="{{route('post_a_job')}}" class="add-post">Post a Job</a>
{{--                        <a href="{{route('post_a_job')}}" class="add-task">Post a Task</a>--}}
{{--                        @endif--}}
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
@section('active_tab')
    <script>
        $(document).ready(function () {
            var url = window.location.href;
            if (url.slice(-1) === '/') {
                url = url.slice(0, -1); // Remove the trailing slash
            }
            $('.nav-item a[href="' + url + '"]').addClass('active');
        });
    </script>
@endsection
