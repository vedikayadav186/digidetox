<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-waste"; // Replace 'your_database_name' with your actual database name

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

    // Geocode the coordinates to get a human-readable location
    $geocode_url = "https://api.mapbox.com/geocoding/v5/mapbox.places/$lng,$lat.json?access_token=pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g";
    $geocode_response = file_get_contents($geocode_url);
    $geocode_data = json_decode($geocode_response, true);

    if (!empty($geocode_data['features'])) {
        $location_name = $geocode_data['features'][0]['place_name'];
    } else {
        $location_name = "Unknown Location";
    }

    echo "Location Name: " . $location_name;
} else {
    echo "No location data found.";
}

$conn->close();
?>
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <!-- Include Mapbox GL JS library -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
    <h1>Admin Panel</h1>
    <div id='map'></div>
    <p id="locationText">Location: <?php echo $location_name; ?></p>
    <!-- Button to open mapview.php in new window -->
    <button onclick="openMapView()">Open Map</button>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [<?php echo $lng; ?>, <?php echo $lat; ?>], // Center map on fetched coordinates
            zoom: 13
        });

        function openMapView() {
            var lng = <?php echo $lng; ?>; // PHP variable containing longitude
            var lat = <?php echo $lat; ?>; // PHP variable containing latitude

            // Open mapview.php in a new window with the map and location information
            var mapWindow = window.open('mapview.php?lat=' + lat + '&lng=' + lng + '&location_name=<?php echo urlencode($location_name); ?>', '_blank');
        }
    </script>
</body>
</html>
