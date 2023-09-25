// Initialize the map on the "map" div with a given center and zoom
const map = L.map('map').setView([11.006905, -74.83625], 16);

// Initialize the tile layer and store it in the tileLayer variable
const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Just to check if it's the first execution of the code
var firstTime = true;

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

// Updated makePoly function to add markers
function makePoly(latitude, longitude) {
    // Remove existing markers
    map.eachLayer(layer => {
        if (layer !== tileLayer) {
            map.removeLayer(layer);
        }
    });

    // Check if the inputs aren't empty
    if (latitude.length > 0 && longitude.length > 0) {
        // Create markers for each coordinate
        markers = [];
        for (let i = 0; i < latitude.length; i++) {
            const marker = L.marker([latitude[i], longitude[i]]).addTo(map);
            markers.push(marker);
            // You can customize the marker icon here if needed
        }

        // Zoom the map to fit all markers
        map.fitBounds([[Math.min(...latitude), Math.min(...longitude)], [Math.max(...latitude), Math.max(...longitude)]]);
    }
}


// Add an event listener to the form for submission
document.getElementById("searchForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Create a data object to send to the server
    const formData = new FormData();
    formData.append("selectedLatitude", selectedLatitude);
    formData.append("selectedLongitude", selectedLongitude);

    // Send an AJAX request to the server
    fetch("../includes/requestHistoryCoordinates.php", {
        method: "POST",
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            // Reset the vectors before saving the data
            latitude = [];
            longitude = [];
            timeStamp = [];

            // Save the values in latitude, longitude, and timeStamp vectors
            data.forEach(item => {
                latitude.push(item.latitude);
                longitude.push(item.longitude);
                timeStamp.push(item.timeStamp);
            });

            // Log fetched data for debugging
            console.log("Fetched Data:");
            console.log("Latitude:", latitude);
            console.log("Longitude:", longitude);
            console.log("TimeStamp:", timeStamp);

            // Check if there are coordinates in the specified range
            if (latitude.length > 0 && longitude.length > 0) {
                // Hide the result, so there's no need to show it
                pResult.style.visibility = "hidden";
                // Make the polyline on the map
                makePoly(latitude, longitude);
            } else {
                // Show result and hide the map
                pResult.style.visibility = "visible";
                pResult.textContent = "There are no coordinates within the specified range.";
                divMap.style.visibility = "hidden";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            // Log an error message for debugging
            console.error("Failed to fetch data from the server.");
        });
});