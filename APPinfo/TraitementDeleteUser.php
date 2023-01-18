<?php
// Initialize the session
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$userId = $_GET["userId"];

    $sql = "DELETE FROM users where idusers='$userId'";
    $result = $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }



// Close the connection
$conn->close();
?>

