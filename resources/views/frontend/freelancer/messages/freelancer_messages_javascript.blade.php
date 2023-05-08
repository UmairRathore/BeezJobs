<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>



<!-- Location JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF0m_0JWZgOmoExRNRO3lwem1yfqJJ6B4&libraries=places"></script>


<!-- Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">

    // Get the close button element
    const btnClose = document.getElementById('btnClose');

    // Attach a click event listener to the close button
    btnClose.addEventListener('click', function() {
        // Get the modal element
        const modal = document.getElementById('offer-popup');

        // Hide the modal
        modal.style.display = 'none';
    });

    const selectJobType = document.querySelector('#select_job_type');
    selectJobType.addEventListener('change', (event) => {
        const selectedOption = event.target.value;
        console.log(selectedOption === 'available-job');
        if (selectedOption === 'available-job') {

            $('#available_jobs').removeClass('d-none');
            $('#custom_jobs').addClass('d-none');
        } else{
            $('#available_jobs').addClass('d-none');
            $('#custom_jobs').removeClass('d-none');
        }
    });





    $(function() {
        $('#job_id').on('change', function() {
            // Get the selected job ID
            var job_id = $(this).val();

            // Make an AJAX request to retrieve the job data
            $.ajax({
                url: '/Offerjobs/' + job_id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the form fields with the job data
                    $('#title').val(data.title);
                    $('#time_of_day').val(data.time_of_job);
                }
            });
        });
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

                $("#chat").load(location.href + " #chat") //refresh chat div

                $("#messages-List").load(location.href + " #messages-List") //refresh sidebar messages list

                    // Scroll to the bottom of the chat container
                    $('.main_chat').animate({
                        scrollTop: $('.main_chat').prop('scrollHeight')
                    }, 200);

            },
        });
    });

    $('#make-offer-btn').on('click', function() {
        $('#offer-popup').show();
    });


    $('#submit-Custom-offer-btn').on('click', function() {
        // event.preventDefault();
        // Get the values from the form
        var receiver_id = $('#receiver_id').val();
        var sender_id = $('#sender_id').val();
        var title = $('#customJob_title').val();
        var date = $('#customJob_date').val();
        var job_meeting = $('#customJob_job_meeting').val();
        var time_of_day = $('#customJob_time_of_day').val();
        var location = $('#customJob_location').val();
        var description = $('#customJob_description').val();
        var budget = $('#customJob_budget').val();

        if (!date) {
            alert('Please select a job from the list');
            return;
        }

        if (!title) {
            alert('Please enter a title for the offer');
            return;
        }

        if (!job_meeting) {
            alert('Please enter a new price for the offer');
            return;
        }


        if (!location) {
            alert('Please enter a time of day for the offer');
            return;
        }


        if (!budget) {
            alert('Please enter a time of day for the offer');
            return;
        }

        if (!description) {
            alert('Please enter a time of day for the offer');
            return;
        }

        if (!time_of_day) {
            alert('Please enter a time of day for the offer');
            return;
        }

        $.ajax({
            url: '/makeCustomJobOffer',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                sender_id: sender_id,
                receiver_id: receiver_id,
                title : title,
                date : date,
                job_meeting : job_meeting,
                time_of_day : time_of_day,
                location : location,
                description : description,
                budget : budget,
            },

            success: function (response) {
// console.log(data);
                $('#success-message').removeClass('d-none').text('Your offer has been submitted successfully!');
                $('#error-message').addClass('d-none')
                $("#chat").load(location.href + " #chat") //refresh chat div
                // Clear the form
                $('#offer-form')[0].reset();

            },
            error: function () {
                $('#error-message').removeClass('d-none').text('Your offer has been not submitted successfully!');
                $('#success-message').addClass('d-none')            }
        });
        return false;
    });

    $('#submit-Available-offer-btn').on('click', function() {
        // event.preventDefault();
        // Get the values from the form
        var receiver_id = $('#receiver_id').val();
        var sender_id = $('#sender_id').val();
        var job_id = $('#job_id').val();
        var negotiated_price = $('#negotiated_price').val();
        var negotiated_duration = $('#negotiated_duration').val();
        var negotiated_description = $('#negotiated_description').val();

        if (!job_id) {
            alert('Please select a job from the list');
            return;
        }

        if (!title) {
            alert('Please enter a title for the offer');
            return;
        }

        if (!negotiated_price) {
            alert('Please enter a price for the offer');
            return;
        }
        if (!negotiated_duration) {
            alert('Please enter a duration for the offer');
            return;
        }
        if (!negotiated_description) {
            alert('Please enter a descrtipion for the offer');
            return;
        }


        $.ajax({
            url: '/makeAvailableJobOffer',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                sender_id: sender_id,
                receiver_id: receiver_id,
                // message_id: message_id,
                job_id: job_id,
                negotiated_price: negotiated_price,
                negotiated_duration: negotiated_duration,
                negotiated_description: negotiated_description,
            },


            success: function (response) {
                $('#success-message').removeClass('d-none').text('Your offer has been submitted successfully!');
                $('#error-message').removeClass('d-none')
                $("#chat").load(location.href + " #chat") //refresh chat div

                // Clear the form
                $('#offer-form')[0].reset();

            },
            error: function () {
                $('#error-message').removeClass('d-none').text('Your offer has been not submitted successfully!');
                $('#success-message').removeClass('d-none')
            }
        });
        return false;
    });


    // Function to accept an offer
    function acceptOffer(offerId) {
        $.ajax({
            url: '/acceptOffer',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",offer_id: offerId},
            success: function() {
                // Display a success message
                alert('Offer accepted!');

                // Remove the accept/reject card from the chat modal
                $('#messagestatus').load(location.href + ' #messagestatus');

            },
            error: function() {
                alert('An error occurred while accepting the offer.');
            }
        });
        return false;
    }


    // Function to reject an offer
    function rejectOffer(offerId) {
        alert(offerId);

        $.ajax({
            url: '/rejectOffer',
            type: 'POST',
            data: {"_token": "{{ csrf_token() }}",offer_id: offerId},
            success: function() {
                // Display a success message
                alert('Offer rejected!');

                $('#messagestatus').load(location.href + ' #messagestatus');



            },
            error: function() {
                // Display an error message
                alert('An error occurred while rejecting the offer.');
            }
        });
        return false;
    }




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
