<?php
session_start();
$requestBody   = file_get_contents('php://input');
$parametersArr = json_decode($requestBody, true);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $username = $parametersArr["username"];
    
    unset($_SESSION[$username]);
    die($_SESSION[$username]);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>