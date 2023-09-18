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
                        min="2023-09-03T00:00"
                        max="2030-06-14T00:00"
                        />
                    </div>
                    <div class="timeRange">
                        <label for="endTime">End time:</label>
                        <input
                        type="datetime-local"
                        id="endTime"
                        name="endTime"
                        value="yyyy-mm-ddT00:00"
                        min="2023-09-03T00:00"
                        max="2030-06-14T00:00"
                        />
                    </div>

                    <button class="searchData" type="submit">Search data!</button> <!-- Cambia el tipo de botón a "submit" -->
                </form>
            </div>
            <div id="result">
                
            </div>
        </main>

        <footer>
            <img src="../images/Taxi.png" alt="Taxi">
            <p class="copyright">&Tracking my wheels - 2023</p>
        </footer>
    </body>
    <script src="script.js"></script>
</html>
