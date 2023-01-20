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


  if ($_POST['statut'] == 'Administrateur') {
    $statut = 1;
  } else {
    $statut = 0;
  }

  $sql = "UPDATE users SET nom = '$nom', prenom = '$prenom', adresse= '$adresse', email='$email', adminPerm='$statut', password='$password1', laboratoires_idlaboratoires= '$idlaboratoire' WHERE idusers = $userId";
  $result = $link->query($sql);
  if ($link->query($sql) === TRUE) {
    echo '<div class="centrer"><h1> Informations mises à jour </h1></div>';
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
  }

}

// Close the connection
$link->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Profil</title>
  <link rel="stylesheet" href="assets/css/User.css" />
  <meta charset="utf-8" />
</head>

</html>