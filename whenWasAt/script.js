// Include the inputs and containers from the HTML file
const divMap = document.getElementById("map");
const pResult = document.querySelector("#result");
const timestampSlider = document.getElementById('timestampSlider');

// Variables to later store the latitude, longitude, and timeStamp data
var latitude = [];
var longitude = [];
var timeStamp = [];

// Variables
var selectedLatitude = null;
var selectedLongitude = null;
var popup = L.popup();
var sliderCheck = true;
var tolerance = 0.0025;

function removeAllMarkers() {
    for (var i = 0; i < markers.length; i++) {
        map.removeLayer(markers[i]);
    }
    // Clear the array
    markers = [];
}

// Event listener to capture user clicks on the map
map.on('click', function (e) {
    selectedLatitude = e.latlng.lat;
    selectedLongitude = e.latlng.lng;
    document.getElementById('selectedCoords').textContent = `Selected Coordinates: Lat: ${selectedLatitude}, Lng: ${selectedLongitude}`;

    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at Latitude: " + selectedLatitude + ", Longitude: " + selectedLongitude)
        .openOn(map);


    if (firstTime){
        firstTime = false
        marker = L.marker([selectedLatitude, selectedLongitude]).addTo(map).bindPopup("Latitude: " + selectedLatitude + ", Longitude: " + selectedLongitude);
    }else{
        marker.setLatLng(e.latlng).bindPopup("Latitude: " + selectedLatitude + ", Longitude: " + selectedLongitude);
        // Remove the existing polygon marker
        map.removeLayer(polygon);
    }
    polygon = L.polygon([
        [selectedLatitude + tolerance, selectedLongitude + tolerance],
        [selectedLatitude + tolerance, selectedLongitude - tolerance],
        [selectedLatitude - tolerance, selectedLongitude - tolerance],
        [selectedLatitude - tolerance, selectedLongitude + tolerance]
    ]).addTo(map);
});

// Add an event listener to the form for submission
document.getElementById("searchForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Create a data object to send to the server
    const formData = new FormData();
    formData.append("selectedLatitude", selectedLatitude);
    formData.append("selectedLongitude", selectedLongitude);
    formData.append("tolerance", tolerance);

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

            // Check if there are coordinates in the specified range
            if (latitude.length > 0 && longitude.length > 0) {
                // Hide the result, so there's no need to show it
                pResult.style.visibility = "hidden";
                // Make the polyline on the map
                makePoly(latitude, longitude);

                timestampSlider.max = timeStamp.length - 1;

            } else {
                // Show result and hide the map
                pResult.style.visibility = "visible";
                pResult.textContent = "There are no coordinates within the specified range.";
                divMap.style.visibility = "hidden";
            }
        })
        .catch(error => console.error("Error:", error));
});


// Store the markers in an array
var markers = [];

// Function to create markers and bind popups
function createMarkers(latitude, longitude, timeStamp) {
    markers.forEach(marker => map.removeLayer(marker));
    markers.length = 0; // Clear the markers array

    for (let i = 0; i < latitude.length; i++) {
        const marker = L.marker([latitude[i], longitude[i]])
            .addTo(map)
            .bindPopup(`Timestamp: ${timeStamp[i]}`);
        markers.push(marker);
    }
}

// Add an event listener to the slider for value change
timestampSlider.addEventListener('input', function () {
    removeAllMarkers();
    const selectedTimestampIndex = parseInt(this.value, 10);
    let index = timestampSlider.value;
    console.log(index);
    let lat = latitude[index];
    let long = longitude[index];
    let ts = timeStamp[index];
    console.log(lat);
    console.log(long);
    console.log(ts);

    if (sliderCheck){
        firstTime = false
        marker = L.marker([lat, long]).addTo(map).bindPopup("Latitude: " + lat + ", Longitude: " + long + ", timeStamp: " + ts);
    }else{
        marker.setLatLng([lat, long]).bindPopup("Latitude: " + lat + ", Longitude: " + long + ", timeStamp: " + ts);
    }

    sliderCheck = false;
});
