const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [78.96,20.56], // Default center coordinates
    zoom: 20,// Default zoom level
});

map.addControl(new mapboxgl.NavigationControl());

map.addControl(new mapboxgl.GeolocateControl({
    positionOption:{
        enableHighAccuracy:true
    },
    trackuserLocation:true
}))

const marker1 = new mapboxgl.Marker({
    color: 'green',
})
const minPopup = new mapboxgl.Popup()
minPopup.setHTML("STORE1")
marker1.setPopup(minPopup)
.setLngLat([ 73.79094956974512 , 19.992253590187026])
.addTo(map);

const marker2 = new mapboxgl.Marker({
  color: 'green',
})
.setLngLat([73.70778282829772,19.995789185667785])
.addTo(map);

const marker3 = new mapboxgl.Marker({
    color: 'green',
  })
.setLngLat([72.80778282829772,19.995789185667785])
.addTo(map);