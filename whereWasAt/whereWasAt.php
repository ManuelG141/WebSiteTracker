<!DOCTYPE html>

<html lang="en">
    <head>     
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>
            <?php
            include_once "../globalVariables.php";
            echo htmlspecialchars($title);
            ?>
        </title>
        <link rel="stylesheet" href="../reset.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
        <style> @import url('https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap'); </style>
    </head>
   <body>
        <header>
            <nav>
                <div class="logo">
                    <img src="../images/Taxi.png" alt="Taxi logo">
                </div>
                <ul>
                    <?php  include_once "../globalVariables.php"; echo $state; ?>
                    <li><a href="../index.php" class="seleccion">Main page</a></li>
                    <li><a href="#">Real Time</a>
                        <ul>
                            <li><a href="../realTimeLocation/realTimeLocation.php" >Location</a></li>
                            <li><a href="../realTimeRoute/realTimeRoute.php" >Route</a></li>
                        </ul>
                    </li>
                    <li><a href="#">History</a>
                        <ul>
                            <li><a href="#">Where was in?</a></li>
                            <li><a href="../whenWasAt/whenWasAt.php" >When was in?</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="form">
                <form action="../includes/requestHistoryData.php" method="post" id="searchForm"> <!-- Reemplaza "tu_script.php" con el nombre de tu archivo PHP -->
                    <div class="timeRange">
                        <label for="startTime">Start time:</label>
                        <input
                        type="datetime-local"
                        id="startTime"
                        name="startTime" 
                        value="yyyy-mm-ddT00:00"
                        />
                    </div>
                    <div class="timeRange">
                        <label for="endTime">End time:</label>
                        <input
                        type="datetime-local"
                        id="endTime"
                        name="endTime"
                        value="yyyy-mm-ddT00:00"
                        />
                    </div>

                    <button class="searchData" type="submit">Search data!</button> <!-- Cambia el tipo de botón a "submit" -->
                </form>
            </div>

            <p id="result"></p>
            <div id='map'></div>
        </main>

        <footer>
            <img src="../images/Taxi.png" alt="Taxi">
            <p class="copyright">&Tracking my wheels - 2023</p>
        </footer>
    </body>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/@turf/turf@7.0.6/turf.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script src="map.js"></script>
    <script src="script.js"></script>
</html>
