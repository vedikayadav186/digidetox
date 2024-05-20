<!DOCTYPE html>
<html>
<head>
  <title>Location Form</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
#map {
  width: 100%;
  height: 400px;
  margin-bottom: 20px;
}

button {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin: 0; /* Remove default margin */
}
button:hover {
  background-color: #45a049;
}

  </style>
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
  <div id='map'></div>
  <div class="form-container">
    <form id="locationForm" action="store_location.php" method="POST" target="_blank">
      <input type="hidden" id="lngInput" name="lng" />
      <input type="hidden" id="latInput" name="lat" />
      <br>
      <br>
      <button type="submit" id="saveLocationBtn">Save Location</button>
    </form>
  </div>

  <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoidmVkaWtheSIsImEiOiJjbHU3Y2x1YmYwNGFuMmxudzdmOHo3YWwxIn0.dDD4vvXB83fTUhXZ94z38g';
    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [79.96,20.56], // Default center (San Francisco coordinates)
      zoom: 20,
    });
    map.addControl(new mapboxgl.NavigationControl());

    map.addControl(new mapboxgl.GeolocateControl({
      positionOption:{
          enableHighAccuracy:true
      },
      trackuserLocation:true
    }))

    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

    function successCallback(position) {
      var lng = position.coords.longitude;
      var lat = position.coords.latitude;
      document.getElementById('lngInput').value = lng;
      document.getElementById('latInput').value = lat;
      // Update map center to user's location
      map.setCenter([lng, lat]);
      // You can also add a marker at this location on the map
    }

    function errorCallback(error) {
      console.error('Error getting user location:', error);
    }
  </script>
</body>
</html>
