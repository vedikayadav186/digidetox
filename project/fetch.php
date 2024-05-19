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
            center: [74.43,20.56], // Default center
            zoom: 5// Default zoom
        });

        // Function to add a regular marker
        function addMarker(lng, lat, color) {
            new mapboxgl.Marker({ color: color }).setLngLat([lng, lat]).addTo(map);
        }

        // Function to add a circle marker
        function addCircleMarker(lng, lat, color) {
            new mapboxgl.Marker({
                color: color,
                draggable: false,
                element: createMarkerElement(color)
            }).setLngLat([lng, lat]).addTo(map);
        }

        // Function to create a marker element with a circle
        function createMarkerElement(color) {
            var el = document.createElement('div');
            el.className = 'marker';
            el.style.backgroundColor = color;
            el.style.width = '15px';
            el.style.height = '15px';
            el.style.borderRadius = '50%';
            el.style.border = '2px solid white';
            return el;
        }

        map.on('load', function () {
            <?php
            // Define pickup boy's location coordinates
            $pickupBoyLng = 73.79096000;
            $pickupBoyLat = 19.99727000;

            // Add JavaScript code to add a marker for the pickup boy's location on the map
            echo "addCircleMarker($pickupBoyLng, $pickupBoyLat, 'blue');";
            ?>
            <?php
            // Database connection and fetch user location coordinates
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
                echo "addMarker($userLng, $userLat, 'red');";

                // Add JavaScript code to build and display the route between pickup boy and user locations
                echo "var directions = new MapboxDirections({
                    accessToken: mapboxgl.accessToken,
                    unit: 'metric',
                    profile: 'mapbox/driving',
                    controls: { instructions: false },
                    interactive: false,
                    waypoints: [
                        { coordinates: [$pickupBoyLng, $pickupBoyLat] },
                        { coordinates: [$userLng, $userLat] }
                    ]
                });";
                echo "map.addControl(directions, 'top-left');";
            }

            // Close the database connection
            $conn->close();
            ?>
        });
    </script>
</body>
</html>

