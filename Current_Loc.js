function initMap() {
    // Initialize map
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 0, lng: 0} // Default center
    });

    // Try HTML5 geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Set map center to user's current location
            map.setCenter(pos);

            // Add marker for user's current location
            var marker = new google.maps.Marker({
                position: pos,
                map: map,
                title: 'Your Location'
            });
        }, function() {
            handleLocationError(true, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, pos) {
    var infoWindow = new google.maps.InfoWindow({
        content: browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.'
    });

    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title: 'Error!'
    });

    marker.addListener('click', function() {
        infoWindow.open(map, marker);
    });
}
