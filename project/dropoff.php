<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Mapbox User Location</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet" />
    <style>
        body { margin: 0; padding: 0; }
        #map { height: 100vh; }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiaXNod2FyaS0yMiIsImEiOiJjbGplZjBzdWkyd3BwM2pxeTk3NmFrajVuIn0.jcNyUjD4Vsza5C0nvkC7QQ';

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-74.5, 40], // Default center coordinates
            zoom: 9 // Default zoom level
        });

        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = [position.coords.longitude, position.coords.latitude];

            // Add a marker at the user's location
            new mapboxgl.Marker().setLngLat(userLocation).addTo(map);

            // Center the map on the user's location
            map.setCenter(userLocation);
        });
    </script>
</body>
</html>

