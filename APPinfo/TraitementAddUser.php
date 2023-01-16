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
if (isset($_POST['prenom'])) {
    // POST the informations from the form
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $idlaboratoire = mysqli_real_escape_string($conn, $_POST['idlaboratoire']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $password1 = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordhash = password_hash($password1, PASSWORD_DEFAULT);

    if ($_POST['statut'] == 'Administrateur') {
        $statut = 1;
    } else {
        $statut = 0;
    }

    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'Erreur: Cet utilisateur existe déjà';
    } else {
        // Inserer l'utilisatur dans la base de données
        $sql = "INSERT INTO users (idusers, nom, prenom, adresse, email, adminPerm, password, laboratoires_idlaboratoires) VALUES (0, '$nom', '$prenom', '$adresse', '$email', '$statut', '$passwordhash', '$idlaboratoire')";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="centrer"><h1> Utilisateur ajouté </h1></div>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Ajouter un nouvel utilisateur</title>
    <link rel="stylesheet" href="assets/css/User.css" />
    <meta charset="utf-8" />
  </head>

</html>