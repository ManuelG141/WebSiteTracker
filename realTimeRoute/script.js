// Initialize the map on the "map" div with a given center and zoom
const map = L.map('map').setView([0, 0], 16);
let marker;
let polyline; // Variable to store the polyline
let startingMarker; // Variable for the starting marker
let previousSegments = []; // Array to store previous line segments

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

const currentPositionIcon = L.icon({
    iconUrl: '../images/current-position-icon.png', // Relative path to the current position icon
    iconSize: [38, 95],
    iconAnchor: [22, 94],
    popupAnchor: [-3, -76],
});

function agregarMarcador(latitude, longitude, isStartingPoint = false) {
    const currentZoom = map.getZoom();
    map.setView([latitude, longitude], currentZoom);

    let customIcon;
    if (isStartingPoint) {
        customIcon = startingIcon;
    } else {
        customIcon = currentPositionIcon;
    }

    if (!startingMarker && isStartingPoint) {
        // Create a starting marker if it doesn't exist
        startingMarker = L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
            .bindPopup('Starting Point');
    }

    if (!marker && !isStartingPoint) {
        // If the marker doesn't exist and it's not a starting point, create it and add it to the map
        marker = L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
            .bindPopup('A pretty CSS popup.<br> Easily customizable.');
    } else if (!isStartingPoint) {
        // If the marker exists, update its location
        marker.setLatLng([latitude, longitude]).bindPopup("Latitude: " + latitude + ", Longitude: " + longitude);
    }

    // Draw a polyline if the polyline already exists
    if (polyline) {
        const latlngs = polyline.getLatLngs();
        latlngs.push([latitude, longitude]);
        polyline.setLatLngs(latlngs);
    } else {
        // Create a new polyline if it doesn't exist
        polyline = L.polyline([[latitude, longitude]], { color: 'blue' }).addTo(map);
    }

    // Store the current line segment for future comparisons
    previousSegments.push(polyline);
}

function updateData() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        document.getElementById("dataToShow").innerHTML = this.responseText;
        const latitudeHTML = document.querySelector("#latitude");
        const longitudeHTML = document.querySelector("#longitude");
        const lat = parseFloat(latitudeHTML.textContent);
        const lng = parseFloat(longitudeHTML.textContent);

        // Determine if it's a starting point or current position
        const isStartingPoint = (previousSegments.length === 0);
        agregarMarcador(lat, lng, isStartingPoint);
    };
    xhttp.open("GET", "../includes/update.inc.php", true);
    xhttp.send();
}

// Update data and draw polyline every 2 seconds (2000 ms)
setInterval(updateData, 2000);

// Initial update to load the map with existing data
updateData();
