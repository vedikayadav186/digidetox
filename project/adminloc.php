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
$sql = "SELECT user_id, lat, lng FROM user_locations ORDER BY id DESC"; // Assuming user_locations is your table
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <!-- Include Mapbox GL JS library -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            background-color: #106466; /* Dark blue background for h1 */
                color: #fff; /* White text color for h1 */
                padding: 20px; /* Padding for h1 */
                margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #106466;
            font-weight: bold;
        }

        tr:hover {
            background-color: #e9e9e9;
        }

        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style></style>
</head>
<body>
    <h1>Admin Panel</h1>
    <table border="1">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Location Name</th>
                <th>Open Map</th>
            </tr>
        </thead>
        <tbody>
        <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['user_id'];
        $lat = $row['lat'];
        $lng = $row['lng'];

        // Geocode the coordinates to get a human-readable location
        $geocode_url = "https://api.mapbox.com/geocoding/v5/mapbox.places/$lng,$lat.json?access_token=pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g";
        $geocode_response = file_get_contents($geocode_url);
        $geocode_data = json_decode($geocode_response, true);

        if (!empty($geocode_data['features'])) {
            $location_name = $geocode_data['features'][0]['place_name'];
        } else {
            $location_name = "Unknown Location";
        }

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$location_name</td>";
        echo "<td><button onclick=\"openMapView($user_id, $lat, $lng, '$location_name')\">Open Map</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No location data found.</td></tr>";
}
?>
        </tbody>
    </table>

    <script>
mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';

function openMapView(userId, lat, lng, locationName) {
    // Open a new window and pass user_id as a URL parameter
    var mapWindow = window.open(`direction_map/index.php?user_id=${userId}&lat=${lat}&lng=${lng}&location_name=${encodeURIComponent(locationName)}`, '_blank');
}
</script>
</body>
</html>
