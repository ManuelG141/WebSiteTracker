<!DOCTYPE html>

<html lang="es">
    <head>     
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>
            <?php
            include_once "globalVariables.php";
            echo htmlspecialchars($title);
            ?>
        </title>
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
        <style> @import url('https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap'); </style>
    </head>
   <body>
        <header>
            <div class="caja">
                <h1><img src="images/Taxi.png" alt="Taxi"></h1>
                <nav>
                    <ul>
                        <?php  include_once "globalVariables.php"; echo $state; ?>
                        <li><a href="index.php" class="seleccion">Main page</a></li>
                        <li><a href="realTimeLocation/realTimeLocation.php" >Real time location</a></li>
                        <li><a href="realTimeRoute/realTimeRoute.php" >Real time route</a></li>
                        <li><a href="whereWasAt/whereWasAt.php">Where was in?</a></li>
                        <li><a href="whenWasAt/whenWasAt.php" >When was in?</a></li>
                    </ul>
                </nav>   
            </div>
        </header>
        <main>
            <img class="banner" src="images/banner.jpg">
        </main>

        <footer>
            <img src="images/Taxi.png" alt="Taxi">
            <p class="copyright">&Tracking my wheels - 2023</p>
        </footer>
    </body>
</html>
