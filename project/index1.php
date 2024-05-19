<!DOCTYPE html>
<html>
<head>
    <title>Map</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <div id='map'></div>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [79.96,20.56], // Default center
            zoom: 12 // Adjust zoom level as needed
        });

        // Add navigation control
        map.addControl(new mapboxgl.NavigationControl());

        // Fetch coordinates from PHP
        fetch('fetch_coordinates.php')
            .then(response => response.json())
            .then(data => {
                var userCoords = [data.user_lng, data.user_lat];
                var pickupBoyCoords = [data.pickup_boy_lng, data.pickup_boy_lat];

                // Add marker for user location
                new mapboxgl.Marker().setLngLat(userCoords).addTo(map);

                // Add marker for pickup boy location
                new mapboxgl.Marker().setLngLat(pickupBoyCoords).addTo(map);

                // Add dynamic route between user and pickup boy
                var routeData = {
                    type: 'FeatureCollection',
                    features: [
                        {
                            type: 'Feature',
                            geometry: {
                                type: 'LineString',
                                coordinates: [userCoords, pickupBoyCoords]
                            }
                        }
                    ]
                };

                // Add route to map
                map.on('load', function () {
                    map.addSource('route', {
                        type: 'geojson',
                        data: routeData
                    });

                    map.addLayer({
                        id: 'route',
                        type: 'line',
                        source: 'route',
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': '#007bff',
                            'line-width': 5
                        }
                    });
                });

                // Center map on user's location
                map.setCenter(userCoords);
            })
            .catch(error => console.log('Error fetching coordinates:', error));
    </script>
</body>
</html>
