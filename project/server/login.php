<?php
include_once "databaseConnector.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $requestBody   = file_get_contents("php://input");
    $parametersArr = json_decode($requestBody, true);
    
    $database   = new DatabaseConnector();
    $connection = $database->getConnection();
    
    $username     = $parametersArr["username"];
    $password     = $parametersArr["password"];
    
    $sql    = "SELECT * FROM users WHERE username='$username'";
    $result = $connection->query($sql);
    
    $row;
    
    if (!$row = mysqli_fetch_assoc($result)) {
        header("HTTP/1.1 401 Unauthorized");
        die("Wrong username or password!");
    }
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    if (password_verify($password, $row["password"]) == false) {
        header('HTTP/1.1 401 Unauthorized');
        die("Wrong password!");
    }
    
    $_SESSION[$username] = $username;
    
    $connection->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>