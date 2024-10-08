<?php

session_start();
require_once "config.php";

$oldNomLabo = $_SESSION['nomLabo'];
$oldAdresseLabo = $_SESSION['adresseLabo'];
$oldEmailLabo = $_SESSION['emailLabo'];
$oldNom = $_SESSION['nomUser'];
$oldPrenom = $_SESSION['prenomUser'];
$oldEmail = $_SESSION['emailUser'];
$oldAdresse = $_SESSION['adresseUser'];


// Get the submitted data
$nomLabo = mysqli_real_escape_string($link, $_POST['nomLabo']);
$adresseLabo = mysqli_real_escape_string($link, $_POST['adresseLabo']);
$emailLabo = mysqli_real_escape_string($link, $_POST['emailLabo']);
$nom = mysqli_real_escape_string($link, $_POST['nom']);
$prenom = mysqli_real_escape_string($link, $_POST['prenom']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$adresse = mysqli_real_escape_string($link, $_POST['adresse']);
$motdepasse = mysqli_real_escape_string($link, $_POST['motdepasse']);


// Check if the data from the laboratoires table needs to be updated
$query = "SELECT nomLabo, adresseLabo, emailLabo FROM laboratoires WHERE emailLabo='$emailLabo' AND nomLabo='$nomLabo' AND adresseLabo='$adresseLabo'";
$result = mysqli_query($link, $query);

if ($result->num_rows == 0) {
  // Update the laboratoires table
  $query = "UPDATE laboratoires SET nomLabo='$nomLabo', adresseLabo=' $adresseLabo', emailLabo='$emailLabo' WHERE emailLabo='$oldEmailLabo'";
  $result = mysqli_query($link, $query);
  if ($result) {
    echo "Données du laboratoire changées. ";
  } else {
    echo mysqli_error($link);
  }
} else {
  echo "Aucune donnée laboratoire n'a été modifiée. ";
}

// Check if the data from the users table needs to be updated
$query = "SELECT nom, prenom, email, adresse FROM users WHERE email='$email' AND nom='$nom' AND prenom='$prenom' AND adresse='$adresse'";
$result = mysqli_query($link, $query);

if ($result->num_rows == 0) {
  // Update the users table
  $query = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', adresse='$adresse' WHERE idusers=".$_SESSION["id"];
  $result = mysqli_query($link, $query);
  $_SESSION['nomUser'] = $nom;
  $_SESSION['prenomUser'] = $prenom;
  $_SESSION['emailUser'] = $email;
  $_SESSION['adresseUser'] = $adresse;
  echo "Données utilisateur changées. ";

}else {
  echo mysqli_error($link);
}

//changement mdp
if (!empty($motdepasse)) {
  // Update the password
  $mdphash = password_hash($motdepasse, PASSWORD_DEFAULT);
  $query = "UPDATE users SET password='$mdphash' WHERE email='$email'";
  $result = mysqli_query($link, $query);
  echo "Mot de passe changé. ";
}else {
  echo mysqli_error($link);
}


// Close the database connection
mysqli_close($link);

?>