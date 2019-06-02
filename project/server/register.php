<?php
include_once "databaseConnector.php";

$usernameRegexPattern = "(^[a-zA-Z0-9]{5,15}$)";
$passwordRegexPattern = "(^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{5,}$)";
$emailRegexPattern    = "/^\\w+@[a-zA-Z_]+?\\.[a-zA-Z]{2,3}$/";


$requestBody   = file_get_contents('php://input');
$parametersArr = json_decode($requestBody, true);

$username     = $parametersArr["username"];
$password     = $parametersArr["password"];
$email        = $parametersArr["email"];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

function validateInput()
{
    global $usernameRegexPattern, $passwordRegexPattern, $emailRegexPattern;
    global $username, $password, $email;
    
    if (!preg_match($usernameRegexPattern, $username)) {
        header("HTTP/1.1 400 Bad Request");
        die("The username must be at least 5 symbols and atmost 15 letters or digits.");
    }
    
    if (!preg_match($passwordRegexPattern, $password)) {
        header("HTTP/1.1 400 Bad Request");
        die("The password should be at least 5 sybmols, containing 1 upper case letter, 1 lower case letter and 1 digit.");
    }
    
    if (!preg_match($emailRegexPattern, $email)) {
        header("HTTP/1.1 400 Bad Request");
        die("The email is not in valid format");
    }
}

function checkCredentialsInDatabase($connection)
{
    global $username, $password, $email, $passwordHash;
    
    $sqlGet = "SELECT * FROM users WHERE username='$username' OR password='$passwordHash' OR email='$email'";
    $result = $connection->query($sqlGet);
    
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $value) {
            if ($row[$key] == $username) {
                header("HTTP/1.1 400 Bad Request");
                die("The username is already taken.");
            } elseif (password_verify($password, $row[$key])) {
                header("HTTP/1.1 400 Bad Request");
                die("The password is already taken.");
            } elseif ($row[$key] == $email) {
                header("HTTP/1.1 400 Bad Request");
                die("The email is already taken.");
            }
        }
    }
}

function addCredentialsToDatabase($connection)
{
    global $username, $password, $email, $passwordHash;
    
    $sqlInsert = "INSERT INTO users (username, password, email)
                  VALUES ('$username', '$passwordHash', '$email');";
    
    if ($connection->query($sqlInsert) === TRUE) {
        header("HTTP/1.1 201 Created");
        die("Your registration is successful! You can now login!");
    } else {
        header("HTTP/1.1 400 Bad Request");
        die("A problem occured. Please try again.");
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //validateInput
    validateInput();
    
    $database   = new DatabaseConnector();
    $connection = $database->getConnection();
    
    checkCredentialsInDatabase($connection);
    
    addCredentialsToDatabase($connection);
    
    $connection->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    die("HTTP method not allowed.");
}
?>