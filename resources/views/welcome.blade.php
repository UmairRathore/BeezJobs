
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
