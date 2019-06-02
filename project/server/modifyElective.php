<?php
include_once "checkAuthentication.php";
include_once "databaseConnector.php";
include_once "elective.php";

if (containsUser(apache_request_headers()) == false) {
    header("HTTP/1.1 401 Unauthorized");
    die("You are not authorized to perform this request.");
}


if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $requestBody = file_get_contents("php://input");
    $elective    = new Elective($requestBody);

    $database   = new DatabaseConnector();
    $connection = $database->getConnection();

    $name = $elective->getName();
    $lecturer = $elective->getLecturer();
    $assistant = $elective->getAssistant();
    $busyness = $elective->getBusyness();
    $description = $elective->getDescription();
    $requirements = $elective->getRequirements();
    $results = $elective->getResults();
    
    $sqlUpdate = "UPDATE electives SET lecturer='$lecturer', assistant='$assistant', busyness='$busyness', description='$description', requirements='$requirements', results='$results' WHERE name='$name'";
    
    if ($connection->query($sqlUpdate) === TRUE) {
        header('HTTP/1.1 201 Created');
        die("The elective was updated successfully!");
    } else {
        header('HTTP/1.1 400 Bad Request');
        die("Problem with executing the request. Please try again.");
    }
    
    $connection->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>