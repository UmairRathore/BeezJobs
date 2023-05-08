@extends('layouts.frontend.master')
@section('title', 'Home')



@section('content')
    <!-- Title Start -->
    <div class="title-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="title-bar-text">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Browser Freelancers</li>
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
                <div class="col-lg-4 col-md-5">
                    <form method="get" action="{{route('browse_freelancers')}}">


                    <div class="browser-job-filters">
                        <div class="filter-heading">
                            <div class="fh-left">
                                Filters
                            </div>
                            <div class="fh-right">
                                <a href="#">Clear All Filters</a>
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
                                    <select class="ui fluid dropdown" name="category">
                                        <option value="">Select a category...</option>
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
                                    <h6>Pay Rate <span>($)</span></h6>
                                </div>
                                <div class="fltr-item-right">
                                    <a href="#">Clear</a>
                                </div>
                            </div>
                            <div class="filter-dd">
                                <div class="rg-slider">
                                    <input class="rn-slider slider-input" value="0" type="range" min="0" max="1000" step="1"  name="pay_rate_range"/>

{{--                                    <input class="rn-slider slider-input" type="range" value="5,500"/>--}}
                                </div>
                                <div class="rg-limit">
                                    <h4>5</h4>
                                    <h4>5000</h4>
                                </div>
                            </div>
                        </div>

                        <div class="fltr-group fltr-gend">
                            <div class="fltr-items-heading">
                                <div class="fltr-item-left">
                                    <h6>Location</h6>
                                </div>
                                <div class="fltr-item-right">
                                    <a href="#">Clear</a>
                                </div>
                            </div>
                            <input id="location" class="job-input" type="text" name="location" placeholder="Enter a location">
                        </div>
                        <div class="filter-button">
                            <button type="submit" class="flr-btn">Search Now</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-lg-8 col-md-7 mainpage">

                    <div class="main-tabs">
                        <div class="res-tabs">
                            <div class="mtab-left">
                                <ul class="browsr-project">
                                    <li>
                                        <span class="nav-link">Search Results</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mtab-right">
                                <ul>
                                    <li class="bp-block">
                                        <div class="ui selection dropdown skills-search sort-dropdown">
                                            <input name="gender" type="hidden" value="default">
                                            <i class="dropdown icon d-icon"></i>
                                            <div class="text">Sort By</div>
                                            <div class="menu">
                                                <div class="item" data-value="0">All</div>
                                                <div class="item" data-value="1">Top</div>
                                                <div class="item" data-value="2">Newest</div>
                                                <div class="item" data-value="3">Ranking</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="prjoects-content">
                            <div class="row">
                                @foreach($users as $user)
                                    <div class="lg-item5 col-lg-6 col-xs-6 grid-group-item5">
                                        <div class="job-item mt-30">
                                            <div class="job-top-dt1 text-center">
                                                <div class="job-center-dt">
                                                    <img src="{{asset($user->profile_image)}}" alt="">
                                                    <div class="job-urs-dts">
                                                        <a href="{{route('other_freelancer_profile',[$user->id])}}"><h4>{{$user->first_name.' '.$user->last_name}}</h4></a>
                                                        <span>{{$user->profession->profession}}</span>
                                                        <div class="avialable">{{$user->time_of_day}}</div>
                                                    </div>
                                                </div>
                                                <div class="job-price hire-price">${{$user->pay_rate}}/hr</div>
                                            </div>
                                            <div class="rating-location">
                                                <div class="left-rating">
                                                    <div class="rtitle">Rating</div>
                                                    <div class="star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span>4.9</span>
                                                    </div>
                                                </div>
                                                <div class="right-location">
                                                    <div class="text-left">
                                                        <div class="rtitle">Location</div>
                                                        <span><i class="fas fa-map-marker-alt"></i> {{$user->location}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-buttons">
                                                <ul class="link-btn">
                                                    <li><a href="{{route('other_freelancer_profile',[$user->id])}}" class="link-j1" title="View Profile">View Profile</a></li>
                                                    <li><a href="#" class="link-j1" title="Hire Me">Hire Me </a></li>
                                                    <li class="bkd-pm">
                                                        <button class="bookmark1" title="bookmark"><i class="fas fa-heart"></i></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="col-12">
                                        <div class="main-p-pagination">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $users->PreviousPageUrl() }}" aria-label="Previous">
                                                            PREV
                                                        </a>
                                                    </li>
                                                    @if ($users->currentPage() > 3)
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $users->url(1) }}">1</a>
                                                        </li>
                                                        @if ($users->currentPage() > 4)
                                                            <li class="page-item">
                                                                <span class="page-link">...</span>
                                                            </li>
                                                        @endif
                                                    @endif

                                                    @for ($i = max(1, $users->currentPage() - 2); $i <= min($users->lastPage(), $users->currentPage() + 2); $i++)
                                                        <li class="page-item{{ $i == $users->currentPage() ? ' active' : '' }}">
                                                            @if ($i == $users->currentPage())
                                                                <span class="page-link">{{ $i }}</span>
                                                            @else
                                                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                                            @endif
                                                        </li>
                                                    @endfor

                                                    @if ($users->currentPage() < $users->lastPage() - 2)
                                                        @if ($users->currentPage() < $users->lastPage() - 3)
                                                            <li class="page-item">
                                                                <span class="page-link">...</span>
                                                            </li>
                                                        @endif
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a>
                                                        </li>
                                                    @endif
                                                    {{--
                                                    {{--                                                        <li class="page-item"><a class="page-link" href="#">24</a></li>--}}
                                                    <li class="page-item">
                                                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
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
    </main>
    <!-- Body End -->
@endsection

@section('Location')
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
