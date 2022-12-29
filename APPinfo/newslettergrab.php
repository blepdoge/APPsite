<?php

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

// Check if the form has been submitted
if (isset($_POST['email'])) {
    // Get the email from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email field is empty
    if (empty($email)) {
        echo 'Erreurr: Vous devez rentrer un email.';
    } else {
        // Check if the email already exists in the database
        $sql = "SELECT email FROM newsletters WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo 'Erreur: Cet email est déjà abonné à notre newsletter !';
        } else {
            // Insert the email into the newsletter table
            $sql = "INSERT INTO newsletters (email) VALUES ('$email')";
            if ($conn->query($sql) === TRUE) {
                echo "Merci de vous êtres abonné à notre newsletter !";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close the connection
$conn->close();

?>


