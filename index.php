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
            <nav>
                <div class="logo">
                    <img src="images/Taxi.png" alt="Taxi logo">
                </div>
                <ul>
                    <?php  include_once "globalVariables.php"; echo $state; ?>
                    <li><a href="index.php" class="seleccion">Main page</a></li>
                    <li><a href="#">Real Time</a>
                        <ul>
                            <li><a href="realTimeLocation/realTimeLocation.php" >Location</a></li>
                            <li><a href="realTimeRoute/realTimeRoute.php" >Route</a></li>
                        </ul>
                    </li>
                    <li><a href="#">History</a>
                        <ul>
                            <li><a href="whereWasAt/whereWasAt.php">Where was in?</a></li>
                            <li><a href="whenWasAt/whenWasAt.php" >When was in?</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="justification">
                <img src="images/banner.jpg" alt="Taxis">
                <h1>What is this page?</h1>
                <p>This is a project from "diseño Electrónico" subject of eighth semester of the "Electronic engineering" carrer at "Universidad del norte".</p>
                <p>Develop by Manuel Martin leyes, Sebastián Fernandez, Jose Canchila and Yeison Ortiz.</p>
            </div>

            <div class="column">
                <div class="webPages">
                    <ul>
                        <li><h3>Production webPages</h3></li>
                        <li class="items"><a href="http://hostname8913.ddns.net">Manuel's webPage</a></li>
                        <li class="items"><a href="http://hostname8914.ddns.net">Sebastián's webPage</a></li>
                        <li><h3>Development webPages</h3></li>
                        <li class="items"><a href="http://hostname8915.ddns.net">Jose's page</a></li>
                        <li class="items"><a href="http://hostname8916.ddns.net">Yeison's page</a></li>
                    </ul>
                </div>

                <div class="gitHub">
                    <h3>Github profiles</h3>
                    <ul class="gitHubProfiles">
                        <a href="https://github.com/ManuelG141"><li class="gitHubProfile">
                            <img src="https://avatars.githubusercontent.com/u/54610064?v=4" alt="Manuel's github profile image">
                            <p>Manuel's github profile</p>
                        </li></a>
                        <a href="https://github.com/sfdz011"><li class="gitHubProfile">
                            <img src="https://avatars.githubusercontent.com/u/143293048?v=4" alt="Sebastian's github profile image">
                            <p>Sebastián's github profile</p>
                        </li></a>
                        <a href="https://github.com/Josecanchila06"><li class="gitHubProfile">
                            <img src="https://avatars.githubusercontent.com/u/144613724?v=4" alt="Jose's github profile image">
                            <p>Jose's github profile</p>
                        </li></a>
                        <a href="https://github.com/laslo1"><li class="gitHubProfile">
                            <img src="https://avatars.githubusercontent.com/u/142249180?v=4" alt="Yeison's github profile image">
                            <p>Yeison's github profile</p>
                        </li></a>
                    </ul>
                </div>
            </div>
        </main>

        <footer>
            <img src="images/Taxi.png" alt="Taxi">
            <p class="copyright">&Tracking my wheels - 2023</p>
        </footer>
    </body>
</html>
