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
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
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
                <div class="col-lg-3 col-md-4">
                    @include('layouts.frontend.freelancer_sidebar')
                </div>
                <div class="col-lg-9 col-md-8 mainpage">
                    <div class="account_heading">
                        <div class="account_hd_left">
                            <h2>Manage Your Account</h2>
                        </div>
                        <div class="account_hd_right">
                            <a href="{{route('signout')}}" class="main_lg_btn">Logout</a>
                        </div>
                    </div>
                    <div class="account_tabs">
                        @include('frontend.freelancer.my_freelancer.layout.my_freelancer_navbar')
                    </div>
                    <div class="messages-sec">
                        <div class="row no-gutters">
                            @include('frontend.freelancer.messages.freelancer_messages_searching')
                        </div>
                    </div><!--messages-sec end-->

                </div>
            </div>
        </div>
    </main>
@endsection
@section('active_tab')
    <script>
        $(document).ready(function () {
            var url = window.location.href;
            // console.log(url);
            $('.nav-item a[href="' + url + '"]').addClass('active');
        });

        // Submit the chat message form using AJAX
        $('#chatmodalform').on('submit', function (e) {
            e.preventDefault();
            // alert('ok')

            let message = $('#message').val();
            let receiver = $('#receiver_id').val();
            let sender = $('#sender_id').val();

            $.ajax({
                url: "/storechat",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    message: message,
                    receiver_id: receiver,
                    sender_id: sender,
                },

                success: function (response) {

                    //
                    $('#chatmodalform')[0].reset(); // Clear the form

                    // Scroll to the bottom of the chat container
                    $('.main_chat').animate({
                        scrollTop: $('.main_chat').prop('scrollHeight')
                    }, 200);

                },
            });
        });

        $(document).ready(function () {
            // Listen for keyup events on the search input field
            $('#searchNameInput').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();

                // Loop through each message item
                $('.message-item').each(function () {
                    var firstName = $(this).data('firstname').toLowerCase();

                    // Show/hide message item based on whether the search text is contained in the first name
                    if (firstName.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });

    </script>
@endsection
