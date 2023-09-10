<?php
//This is a simple pure php file that is in charge of inserting data into the database

/*
Un comment this lines to find any error that you're having
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
    //Grap the user input using POST method $variable = $_POST["name"];
    $jsonData = file_get_contents('php://input');

    //Run the code handling errors, if they occur
    try {
        // Decodifica el JSON en un array asociativo
        $data = json_decode($jsonData, true);

        // Verifica si se pudo decodificar correctamente el JSON
        if ($data === null) {
            throw new Exception("Error al decodificar el JSON");
        }

        // Obtén los valores del array asociativo
        $latitude = $data["latitude"];
        $longitude = $data["longitude"];
        $timeStamp = $data["timeStamp"];
        /*
        Link the typed file to this script, so i have access to all the code in that file
        If the file can't be found or there's already included in the code, this instruction
        will return and error
        */
        require_once "dbh.inc.php";

        /*
        This is the query that MySQL database will receive
        "INSERT INTO tableName    (items, ..) VALUES ($variable, ..);" <- Don't forget to put ; at
        the end of the query, remember SQL syntax
        
        //
        We use the :variable in the value field in order to do prepared statemnt to prevent SQL injection
        */
        $query = "INSERT INTO trackingData (latitude, longitude, timeStamp) VALUES (:latitude, :longitude, :timeStamp);";
        
        //I send the query to the database, and later i will send the data, so there's no chance to SQL injection
        $stmt = $pdo->prepare($query);

        //I'm linking the name param with the user input data
        $stmt->bindParam(":latitude", $latitude);
        $stmt->bindParam(":longitude", $longitude);
        $stmt->bindParam(":timeStamp", $timeStamp);

        //Here i'm sending the data to the database
        $stmt->execute();

        //Here i'm closing the conection to database manually
        $pdo = null;
        $stmt = null;

        // Envía una respuesta al cliente (puede ser en formato JSON)
        $response = array("message" => "Datos recibidos y procesados correctamente");
        echo json_encode($response);

    } catch (PDOException $e) {
        //If there's some error, just close the script and show following error
        die("Query failed: " . $e->getMessage());
    }
