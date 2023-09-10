function updateData() {
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.getElementById("dataToShow").innerHTML = this.responseText;
        latitudeHTML = document.querySelector("#latitude");
        longitudeHTML = document.querySelector("#longitude");
        lat = latitudeHTML.textContent;
        lng = longitudeHTML.textContent;
        agregarMarcador(lat, lng);
    }
    xhttp.open("GET", "../includes/update.inc.php", true);
    xhttp.send();
}

var lat = 0;
var lng = 0;

// Inicializa el mapa
// initialize the map on the "map" div with a given center and zoom
const map = L.map('map').setView([0,0], 16);
var marker;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Función para agregar marcadores al mapa
function agregarMarcador(latitude, longitude) {
    var currentZoom = map.getZoom();
    map.setView([latitude, longitude], currentZoom);
    console.log("latitud: "+latitude+", longitude: "+longitude);
    if (!marker) {
        // Si el marcador aún no se ha creado, créalo y agréguelo al mapa
        marker = L.marker([latitude, longitude]).addTo(map)
        .bindPopup('A pretty CSS popup.<br> Easily customizable.');
    } else {
        // Si el marcador ya existe, simplemente actualice su ubicación
        marker.setLatLng([lat, lng]).bindPopup("latitud: "+latitude+", longitude: "+longitude);
    }
}

updateData();
// Actualiza cada 2 segundos (2000 ms)
setInterval(updateData, 2000);