<?php

session_start();
require_once "config.php";

$oldNomLabo = $_SESSION['nomLabo'];
$oldAdresseLabo = $_SESSION['adresseLabo'];
$oldEmailLabo = $_SESSION['emailLabo'];
$oldNom = $_SESSION['nom'];
$oldPrenom = $_SESSION['prenom'];
$oldEmail = $_SESSION['email'];
$oldAdresse = $_SESSION['adresse'];


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
$query = "SELECT nomLabo, adresseLabo, emailLabo FROM laboratoires WHERE emailLabo='$oldEmailLabo' AND nomLabo='$oldNomLabo' AND adresseLabo='$oldAdresseLabo'";
$result = mysqli_query($link, $query);

if ($result->num_rows == 0) {
  // Update the laboratoires table
  $query = "UPDATE laboratoires SET nomLabo='$nomLabo', adresseLabo=' $adresseLabo', emailLabo='$emailLabo' WHERE emailLabo='$oldEmailLabo'";
  $result = mysqli_query($link, $query);
  echo "Données du laboratoire changées. ";
}

// Check if the data from the users table needs to be updated
$query = "SELECT nom, prenom, email, adresse FROM users WHERE email='$oldEmail' AND nom='$oldNom' AND prenom='$oldPrenom' AND adresse='$oldAdresse'";
$result = mysqli_query($link, $query);

if ($result->num_rows == 0) {
  // Update the users table
  $query = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', adresse='$adresse' WHERE email='$oldEmail'";
  $result = mysqli_query($link, $query);
  $_SESSION['nom'] = $nom;
  $_SESSION['prenom'] = $prenom;
  $_SESSION['email'] = $email;
  $_SESSION['adresse'] = $adresse;
  echo "Données utilisateur changées. ";

}

//changement mdp
if (!empty($motdepasse)) {
  // Update the password
  $mdphash = password_hash($motdepasse, PASSWORD_DEFAULT);
  $query = "UPDATE users SET password='$mdphash' WHERE email='$email'";
  $result = mysqli_query($link, $query);
  echo "Mot de passe changé. ";
}


// Close the database connection
mysqli_close($link);

?>