<?php
session_start();

function containsUser($headers)
{
    foreach ($_SESSION as $key => $value) {
        if ($value == $headers["Authorization"]) {
            return true;
        }
    }
    
    return false;
}
?>