<?php
include_once "checkAuthentication.php";
include_once "databaseConnector.php";

if (containsUser(apache_request_headers()) == false) {
    header("HTTP/1.1 401 Unauthorized");
    die("You are not authorized to perform this request.");
}


if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $database   = new DatabaseConnector();
    $connection = $database->getConnection();
    
    $name = $_GET["name"];
    
    $sqlDelete = "DELETE FROM electives WHERE name='$name'";
    
    if ($connection->query($sqlDelete) === TRUE) {
        header("HTTP/1.1 200 Success");
        die("The elective was deleted successfully.");
    } else {
        header("HTTP/1.1 400 Bad Request");
        die("Problem with executing the request. Please try again.");
    }
    
    $connection->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>