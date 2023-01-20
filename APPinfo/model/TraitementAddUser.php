<?php

// Connect to the database
require_once "config.php";

// Check if the form has been submitted
if (isset($_POST['prenom'])) {
    // POST the informations from the form
    $prenom = mysqli_real_escape_string($link, $_POST['prenom']);
    $nom = mysqli_real_escape_string($link, $_POST['nom']);
    $idlaboratoire = mysqli_real_escape_string($link, $_POST['idlaboratoire']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $adresse = mysqli_real_escape_string($link, $_POST['adresse']);
    $password1 = mysqli_real_escape_string($link, $_POST['password']);
    $passwordhash = password_hash($password1, PASSWORD_DEFAULT);

    if ($_POST['statut'] == 'Administrateur') {
        $statut = 1;
    } else {
        $statut = 0;
    }

    $sql = "SELECT email FROM users WHERE email = '$email'";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        echo 'Erreur: Cet utilisateur existe déjà';
    } else {
        // Inserer l'utilisatur dans la base de données
        $sql = "INSERT INTO users (idusers, nom, prenom, adresse, email, adminPerm, password, laboratoires_idlaboratoires) VALUES (0, '$nom', '$prenom', '$adresse', '$email', '$statut', '$passwordhash', '$idlaboratoire')";
        if ($link->query($sql) === TRUE) {
            echo '<div class="centrer"><h1> Utilisateur ajouté </h1></div>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }
}

// Close the connection
$link->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un nouvel utilisateur</title>
    <link rel="stylesheet" href="../assets/css/User.css" />
    <meta charset="utf-8" />
</head>

</html>