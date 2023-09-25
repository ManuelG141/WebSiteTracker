<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
try {
    // Connecting to DB
    include_once "dbh.inc.php";

    // Retrieve the selected coordinates from the map.
    $selectedLatitude = $_POST['selectedLatitude'];
    $selectedLongitude = $_POST['selectedLongitude'];
    $tolerance = $_POST['tolerance'];

    // // Define a range for latitude and longitude to account for user selection errors.
    // $latitudeRange = 0.0005; // Adjust this value as needed
    // $longitudeRange = 0.0005; // Adjust this value as needed

    // SQL query to retrieve data based on the selected coordinates within the specified range.
    $query = "SELECT * FROM trackingData 
              WHERE latitude BETWEEN :minLatitude AND :maxLatitude
              AND longitude BETWEEN :minLongitude AND :maxLongitude;";

    // Calculate the minimum and maximum latitude and longitude values within the range.
    $minLatitude = $selectedLatitude - $tolerance;
    $maxLatitude = $selectedLatitude + $tolerance;
    $minLongitude = $selectedLongitude - $tolerance;
    $maxLongitude = $selectedLongitude + $tolerance;

    // Prepare the SQL statement.
    $stmt = $pdo->prepare($query);

    // Bind the parameters with user input data.
    $stmt->bindParam(":minLatitude", $minLatitude);
    $stmt->bindParam(":maxLatitude", $maxLatitude);
    $stmt->bindParam(":minLongitude", $minLongitude);
    $stmt->bindParam(":maxLongitude", $maxLongitude);

    // Execute the query.
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    header('Content-Type: application/json');
    echo json_encode($result);
} catch (PDOException $e) {
    // If there's an error, display the error message.
    die("Query failed: " . $e->getMessage());
}
?>
