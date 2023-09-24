// Initialize the map on the "map" div with a given center and zoom
const map = L.map('map').setView([0, 0], 16);
// Variable to store the polyline
let polyline = L.polyline([], {color: 'blue'}).addTo(map);

// Just to check if it's the first execute of the code
var firstTime = true;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Define custom icons for the starting point and current position
const startingIcon = L.icon({
    iconUrl: '../images/starting-icon.png', // Relative path to the starting point icon
    iconSize: [38, 95],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
});

const lastPositionIcon = L.icon({
    iconUrl: '../images/current-position-icon.png', // Relative path to the current position icon
    iconSize: [38, 95],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
});

// This func makes and add a polyline from given data to map
function makePoly(latitude, longitude){
    // Create a new vector to store the data
    var latlngs = [];
    // Checks if the inputs aren't emptys
    if (latitude.length > 1 && longitude.length > 1) {
        // Save the data into the vector
        for (let i = 0; i < latitude.length; i++) {
            // Insert all vectors values into latLngs
            latlngs.push([latitude[i], longitude[i]]);
        }
    }
    // Update the polyline with the data
    polyline.setLatLngs(latlngs)
    // zoom the map to the polyline fit in it
    map.fitBounds(polyline.getBounds());

    // Get the last index of the vectors
    const lastIndex = latitude.length - 1
    if (firstTime){
        firstTime = false
        // Add markers to show where the car starts and where the car stops
        startMarker = L.marker([latitude[0], longitude[0]], { icon: startingIcon }).addTo(map)
        .bindPopup('Start Point');
        stopMarker = L.marker([latitude[lastIndex], longitude[lastIndex]], { icon: lastPositionIcon }).addTo(map)
        .bindPopup('End Point');
    }else{
        // Update the markers
        startMarker.setLatLng([latitude[0], longitude[0]]).bindPopup('Start Point');
        stopMarker.setLatLng([latitude[lastIndex], longitude[lastIndex]]).bindPopup('End Point');
    };
}