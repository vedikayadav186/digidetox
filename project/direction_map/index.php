<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title>Map Directions using Mapbox</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Mapbox -->
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />

    <!-- GeoCoder -->
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />

    <!-- Direction API -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="position-relative h-100 w-100">
        <div id='map'></div>
        <div class="position-absolute top-0 end-0 ">

            <button class="btn btn-lg btn-light bg-gradient bg-light border me-2 mt-3" id="get-direction"><i class="fa fa-directions"></i> Direction</button>
            <button class="btn btn-lg btn-light bg-gradient bg-light border me-2 mt-3 d-none " id="end-direction"><i class="fa fa-times"></i> End Direction</button>
            <!-- Add Start Live Tracking Button -->
            <button class="btn btn-lg btn-primary mt-3" id="start-tracking"><i class="fa fa-play"></i> Start Tracking</button>
            <div>
            <?php
// Check if parameters are set in the URL
if (isset($_GET['user_id']) && isset($_GET['lat']) && isset($_GET['lng']) && isset($_GET['location_name'])) {
    $user_id = $_GET['user_id'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $location_name = $_GET['location_name'];

    // Display the parameters
    echo "<h2>Map Details</h2>";
    echo "<p>User ID: $user_id</p>";
    echo "<p>Choose Destination :  $lng , $lat </p>";
    echo "<p>Location Name: $location_name</p>";
} else {
    echo "No parameters found in the URL.";
}
?>
</div>
        </div>
    </div>
    <script type='text/javascript' src="map.js"></script>
</body>

</html>