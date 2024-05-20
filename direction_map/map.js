// Initialize variables
var map, directions, marker, watchId;

// Mapbox Public Access Key
mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';

// Initialize the map
map = new mapboxgl.Map({
    container: 'map', // Map Container ID
    style: 'mapbox://styles/vedikay/clvrnwomm01te01oc97zc2b7x', // Mapbox Style URL
    zoom: 12.56, // Default Zoom
    center: [121.037, 14.332] // Default centered coordinate
});

// Search Places
var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    marker: true,
});

// Direction Form
directions = new MapboxDirections({
    accessToken: mapboxgl.accessToken,
});

// Adding Search Places on Map
map.addControl(geocoder, 'top-left');

// Adding navigation control on Map
map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');

// Event listener for Start Live Tracking button
document.getElementById('start-tracking').addEventListener('click', function() {
    // Fetch current location if geolocation is available
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var currentLocation = [position.coords.longitude, position.coords.latitude];
            // Set current location as the starting point on the map
            map.setCenter(currentLocation);

            // Add a marker for current location
            marker = new mapboxgl.Marker({ color: 'blue' })
                .setLngLat(currentLocation)
                .addTo(map);

            // Set current location as the origin in directions form
            directions.setOrigin(currentLocation);

            // Start watching the user's position for live tracking
            watchId = navigator.geolocation.watchPosition(function(position) {
                var updatedLocation = [position.coords.longitude, position.coords.latitude];
                // Update the marker's position on the map
                marker.setLngLat(updatedLocation);
                // Update the map's center to follow the user's location
                map.setCenter(updatedLocation);
            });

            // To stop live tracking (e.g., when the user clicks a button to stop tracking)
            // use navigator.geolocation.clearWatch(watchId);
        });
    }
});

// Event listeners for direction controls
$(function() {
    $('#get-direction').click(function() {
        // Add Direction form and instructions on map
        map.addControl(directions, 'top-left');
        directions.container.setAttribute('id', 'direction-container');
        $(geocoder.container).hide();
        $(this).hide();
        $('#end-direction').removeClass('d-none');
    });
    $('#end-direction').click(function() {
        directions.actions.clearOrigin();
        directions.actions.clearDestination();
        directions.container.querySelector('input').value = '';
        $(this).addClass('d-none');
        $('#get-direction').show();
        $(geocoder.container).show();
        map.removeControl(directions);

        // Stop live tracking when ending directions
        navigator.geolocation.clearWatch(watchId);
        marker.remove(); // Remove the marker from the map
    });
});
