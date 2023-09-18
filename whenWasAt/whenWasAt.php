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
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
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
                            <li><a href="../whereWasAt/whereWasAt.php">Where was in?</a></li>
                            <li><a href="#" >When was in?</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <main>
            <p style="padding:100px 500px 500px 500px; font-size: 5em;">Comming Soon!</p>
        </main>

        <footer>
            <img src="../images/Taxi.png" alt="Taxi">
            <p class="copyright">&Tracking my wheels - 2023</p>
        </footer>
    </body>
</html>