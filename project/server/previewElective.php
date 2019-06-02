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
    
    $name = $_GET['name'];
    
    $sqlGet = "SELECT * FROM electives WHERE name='$name'";
    $result = $connection->query($sqlGet);
    
    $row = mysqli_fetch_assoc($result);
    if ($row != NULL) {
        header('HTTP/1.1 200 Success');
        die(json_encode($row));
    }
    
    $connection->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>