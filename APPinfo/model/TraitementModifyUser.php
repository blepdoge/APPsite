<?php
// Initialize the session
session_start();

// Connect to the database
require_once "config.php";

$userId = $_SESSION["userId"];
// Check if the form has been submitted
if (isset($_POST['prenom'])) {
  // POST the informations from the form
  $prenom = mysqli_real_escape_string($link, $_POST['prenom']);
  $nom = mysqli_real_escape_string($link, $_POST['nom']);
  $idlaboratoire = mysqli_real_escape_string($link, $_POST['idlaboratoire']);
  $email = mysqli_real_escape_string($link, $_POST['email']);
  $adresse = mysqli_real_escape_string($link, $_POST['adresse']);
  $password1 = mysqli_real_escape_string($link, $_POST['password']);

  $password1hash = password_hash($password1, PASSWORD_DEFAULT);

  if ($_POST['statut'] == 'Administrateur') {
    $statut = 1;
  } else {
    $statut = 0;
  }

  // Check if the data from the users table needs to be updated
  $query = "SELECT nom, prenom, email, adresse FROM users WHERE email='$email' AND nom='$nom' AND prenom='$prenom' AND adresse='$adresse'";
  $result = mysqli_query($link, $query);

  if ($result->num_rows == 0) {

    $sql = "UPDATE users SET nom = '$nom', prenom = '$prenom', adresse= '$adresse', email='$email', adminPerm='$statut', laboratoires_idlaboratoires= '$idlaboratoire' WHERE idusers = $userId";
    $result = $link->query($sql);
    if ($link->query($sql) === TRUE) {
      echo '<div class="centrer"><h1> Informations mises à jour </h1></div>';
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
  }else {
    echo mysqli_error($link);
  }

}

//changement mdp
if (!empty($password1)) {
  // Update the password
  $mdphash = password_hash($motdepasse, PASSWORD_DEFAULT);
  $query = "UPDATE users SET password='$mdphash' WHERE email='$email'";
  $result = mysqli_query($link, $query);
  echo "Mot de passe changé. ";
} else {
  echo mysqli_error($link);
}

// Close the connection
$link->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Profil</title>
  <link rel="stylesheet" href="../assets/css/User.css" />
  <meta charset="utf-8" />
</head>

</html>