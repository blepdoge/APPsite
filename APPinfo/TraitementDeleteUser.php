<?php
// Initialize the session
session_start();

// Connect to the database
require_once "config.php";
$userId = $_GET["userId"];

    $sql = "DELETE FROM users where idusers='$userId'";
    $result = $link->query($sql);
    if ($link->query($sql) === TRUE) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }



// Close the connection
$link->close();
?>

