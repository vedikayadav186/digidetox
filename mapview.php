<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-waste";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latitude and longitude from the database
$sql = "SELECT lat, lng FROM user_locations ORDER BY id DESC LIMIT 1"; // Assuming user_locations is your table
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lat = $row["lat"];
    $lng = $row["lng"];
} else {
    $lat = 0; // Default latitude
    $lng = 0; // Default longitude
}

// Geocode the coordinates to get a human-readable location
$geocode_url = "https://api.mapbox.com/geocoding/v5/mapbox.places/$lng,$lat.json?access_token=pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g";
$geocode_response = file_get_contents($geocode_url);
$geocode_data = json_decode($geocode_response, true);

if (!empty($geocode_data['features'])) {
    $location_name = $geocode_data['features'][0]['place_name'];
} else {
    $location_name = "Unknown Location";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Map with Marker</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map { width: 100%; height: 400px; }
    </style>
</head>
<body>
    <div id='map'></div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [<?php echo $lng; ?>, <?php echo $lat; ?>], // Center map on fetched coordinates
            zoom: 13
        });

        // Add a marker at the fetched location
        var marker = new mapboxgl.Marker()
            .setLngLat([<?php echo $lng; ?>, <?php echo $lat; ?>])
            .addTo(map);

        // Create a popup for the marker with the location name
        var popup = new mapboxgl.Popup({ offset: 25 })
            .setHTML("<h3><?php echo $location_name; ?></h3>")
            .setMaxWidth("300px");

        // Add the popup to the marker
        marker.setPopup(popup);
    </script>
</body>
</html>
