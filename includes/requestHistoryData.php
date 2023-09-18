<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/
try{
    // Connecting to DB
    include_once "dbh.inc.php";
    // Retrieve the start and end dates from the HTML form.
    $startValue = $_POST['startTime'];
    $endValue = $_POST['endTime'];

    // SQL query to retrieve data within the specified time interval.
    $query = "SELECT * FROM trackingData WHERE timeStamp BETWEEN :startValue AND :endValue;";
    
    //I send the query to the database, and later i will send the data, so there's no chance to SQL injection
    $stmt = $pdo->prepare($query);

    //I'm linking the name param with the user input data
    $stmt->bindParam(":startValue", $startValue);
    $stmt->bindParam(":endValue", $endValue);

    //Here i'm sending the data to the database
    $stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    header('Content-Type: application/json');
    echo json_encode($result);
} catch (PDOException $e) {
	//If there's some error, just close the script and show following error
	die("Query failed: " . $e->getMessage());
}