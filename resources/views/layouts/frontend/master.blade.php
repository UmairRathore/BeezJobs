<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>Jobby - @yield('title')</title>

    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{asset('images/fav.png')}}">

    <!-- Stylesheets -->
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor_public/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor_public/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor_public/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('vendor_public/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css')}}" rel="stylesheet" />


    <!-- Semantic Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor_public/semantic/semantic.min.css')}}">

</head>
<body>
<!-- Search Model Start -->
@include('layouts.frontend.searchmodal')
<!-- Search Model End -->
<!-- Header Start -->
<header>
    @include('layouts.frontend.header')
</header>
<!-- Header End -->
<!-- Body Start -->
<main class="body-section">
    @yield('content')
</main>
<!-- Body End -->
<!-- footer Start -->
<footer class="footer">
    @include('layouts.frontend.footer')
</footer>
<!-- footer End -->
<!-- Scroll to Top Button Start -->
{{--<button onclick="topFunction()" id="pageup" title="Go to top"><i class="fas fa-arrow-up"></i></button>--}}
<!-- Scroll to Top Button End -->
<!-- Scripts js -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/typeahead.js')}}"></script>
<script src="{{asset('js/datepicker.min.js')}}"></script>
<script src="{{asset('js/i18n/datepicker.en.js')}}"></script>
<script src="{{asset('vendor_public/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor_public/OwlCarousel/owl.carousel.js')}}"></script>
<script src="{{asset('vendor_public/semantic/semantic.min.js')}}"></script>

<script src="{{asset('js/custom1.js')}}"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--SELECT2-->
<script src="{{asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js')}}"></script>




@yield('active_tab')
@yield('google_Map_Location_SignUp')
@yield('Location')
@yield('search')
{{--@yield('chatmodal')--}}
@yield('pageload')

</body>

</html>
