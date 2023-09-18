<!DOCTYPE html>

<html lang="es">
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
        <link rel="stylesheet" href="../default.css">
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
            <div class="caja">
                <h1><img src="../images/Taxi.png" alt="Taxi"></h1>
                <nav>
                    <ul>
                        <?php  include_once "../globalVariables.php"; echo $state; ?>
                        <li><a href="../index.php">Main page</a></li>
                        <li><a href="realTimeLocation.php" class="seleccion">Real time location</a></li>
                        <li><a href="../realTimeRoute/realTimeRoute.php" >Real time route</a></li>
                        <li><a href="../whereWasAt/whereWasAt.php">Where was in?</a></li>
                        <li><a href="../whenWasAt/whenWasAt.php" >When was in?</a></li>
                    </ul>
                </nav>   
            </div>
        </header>
        <main>

            <section onload="updateData()" id="dataToShow">
                    <?php require_once "../includes/update.inc.php"?>
            </section>

            <div id='map'></div>
            
        </main>

        <footer>
            <img src="../images/Taxi.png" alt="Taxi">
            <p class="copyright">&Tracking my wheels - 2023</p>
        </footer>
    </body>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script src="script.js"></script>
</html>
