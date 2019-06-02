<?php
include_once "checkAuthentication.php";
include_once "databaseConnector.php";

if (containsUser(apache_request_headers()) == false) {
    header("HTTP/1.1 401 Unauthorized");
    die("You are not authorized to perform this request.");
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $database   = new DatabaseConnector();
    $connection = $database->getConnection();
    
    $sqlGet;
    
    if (isset($_GET["creator"])) {
        $creator = $_GET["creator"];
        $sqlGet  = "SELECT name, lecturer, assistant FROM electives WHERE creator='$creator'";
    } else {
        $sqlGet = "SELECT name, lecturer, assistant FROM electives";
    }
    
    $result = $connection->query($sqlGet);
    
    $resultRows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $resultRows[] = $row;
    }
    
    header('HTTP/1.1 200 Success');
    die(json_encode($resultRows));
    
    $connection->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>