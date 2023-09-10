<?php
//This is a simple pure php file that is in charge of connecting to the database

/*
Un comment this lines to find any error that you're having
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

//indicates type of database, where is the host, and what's the name of the database to reach
$dsn = "mysql:host=localhost; dbname=disenhoElectronico";
//indicates the credentials to access to MySQl database
$dbusername = "user";
$dbpassword = "";

//Run the code handling errors, if they occur
try {
    //Connect to database using php data objets "pdo"
    $pdo = NEW PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //Show the message with the type of error that occur
    echo "Connection failed: " . $e->getMessage();
}
