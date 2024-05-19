<!DOCTYPE html>
<html>
<head>
  <title>Location Form</title>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
  <div id='map' style='width: 100%; height: 400px;'></div>
  <form id="locationForm" action="store_location.php" method="POST">
    <input type="hidden" id="lngInput" name="lng" />
    <input type="hidden" id="latInput" name="lat" />
    <input type="hidden" id="pickupLngInput" name="pickupLng" />
    <input type="hidden" id="pickupLatInput" name="pickupLat" />
    <button type="submit">Save Location</button>
  </form>

  <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';
    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [79.96, 20.56], // Default center (San Francisco coordinates)
      zoom: 12,
    });
    map.addControl(new mapboxgl.NavigationControl());

    // Function to fetch and update pickup boy's location
    function fetchPickupBoyLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
          var pickupLng = position.coords.longitude;
          var pickupLat = position.coords.latitude;
          document.getElementById('pickupLngInput').value = pickupLng;
          document.getElementById('pickupLatInput').value = pickupLat;
          // You can update the map or display a marker at the pickup boy's location
          updateRoute();
        }, function(error) {
          console.error('Error getting pickup boy location:', error);
        });
      } else {
        console.error('Geolocation is not supported by this browser.');
      }
    }

    // Function to update route between user and pickup boy
    function updateRoute() {
      var userLng = parseFloat(document.getElementById('lngInput').value);
      var userLat = parseFloat(document.getElementById('latInput').value);
      var pickupLng = parseFloat(document.getElementById('pickupLngInput').value);
      var pickupLat = parseFloat(document.getElementById('pickupLatInput').value);

      var directionsRequest = 'https://api.mapbox.com/directions/v5/mapbox/driving/' + pickupLng + ',' + pickupLat + ';' + userLng + ',' + userLat + '?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;

      fetch(directionsRequest)
        .then(response => response.json())
        .then(data => {
          if (map.getSource('route')) {
            map.removeLayer('route');
            map.removeSource('route');
          }

          var route = data.routes[0].geometry;
          map.addLayer({
            'id': 'route',
            'type': 'line',
            'source': {
              'type': 'geojson',
              'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': route
              }
            },
            'layout': {
              'line-join': 'round',
              'line-cap': 'round'
            },
            'paint': {
              'line-color': '#3887be',
              'line-width': 5
            }
          });
        })
        .catch(err => console.error('Error estimating route:', err));
    }

    // Call the function to fetch and update pickup boy's location
    fetchPickupBoyLocation();
  </script>
</body>
</html>
