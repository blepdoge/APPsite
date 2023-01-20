<?php

// Connect to the database
require_once "config.php";

// Check if the form has been submitted
if (isset($_POST['email'])) {
    // Get the email from the form
    $email = mysqli_real_escape_string($link, $_POST['email']);

    // Check if the email field is empty
    if (empty($email)) {
        echo 'Erreur: Vous devez rentrer un email.';
    } else {
        // Check if the email already exists in the database
        $query = "SELECT email FROM newsletters WHERE email='$email'";
        $result = mysqli_query($link, $query);
        if ($result->num_rows > 0) {
            echo 'Erreur: Cet email est déjà abonné à notre newsletter !';
        } else {
            // Insert the email into the newsletter table
            $query = "INSERT INTO newsletters (email) VALUES ('$email')";
            if (mysqli_query($link, $query) === TRUE) {
                echo "Merci de vous êtres abonné à notre newsletter !";
            } else {
                echo "Erreur au cours de l'ajout: " . "<br>" . mysqli_error($link);
            }
        }
    }
}

// Close the connection
mysqli_close($link);

?>