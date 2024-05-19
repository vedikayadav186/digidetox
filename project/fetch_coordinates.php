<!DOCTYPE html>
<html>
<head>
    <title>Map Display</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map { width: 100%; height: 500px; }
    </style>
</head>
<body>
    <h1>Map Display</h1>
    <div id='map'></div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [0, 0], // Default center
            zoom: 1 // Default zoom
        });
        var pickupBoyLng = -73.989308;
        var pickupBoyLat = 40.749036;

        // Add event listener for map load
        map.on('load', function () {
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "e-waste"; // Replace 'e-waste' with your actual database name

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch user location coordinates from the database
            $userLocationQuery = "SELECT lat, lng FROM user_locations ORDER BY id DESC LIMIT 1";
            $userLocationResult = $conn->query($userLocationQuery);

            if ($userLocationResult->num_rows > 0) {
                $row = $userLocationResult->fetch_assoc();
                $userLng = $row["lng"];
                $userLat = $row["lat"];

                // Add JavaScript code to add a marker for the user's location on the map
                echo "new mapboxgl.Marker().setLngLat([$userLng, $userLat]).addTo(map);";
            }

            // Close the database connection
            $conn->close();
            ?>
        });

        // Function to add a marker to the map
        function addMarker(lng, lat) {
            new mapboxgl.Marker().setLngLat([lng, lat]).addTo(map);
        }
    </script>
</body>
</html>
