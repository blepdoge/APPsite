<?php

require_once "config.php";

// Get the submitted data
$nomLabo = mysqli_real_escape_string($link,$_POST['nomLabo']);
$adresseLabo = mysqli_real_escape_string($link,$_POST['adresseLabo']);
$emailLabo = mysqli_real_escape_string($link,$_POST['emailLabo']);
$nom = mysqli_real_escape_string($link,$_POST['nom']);
$prenom = mysqli_real_escape_string($link,$_POST['prenom']);
$email = mysqli_real_escape_string($link,$_POST['email']);
$adresse = mysqli_real_escape_string($link,$_POST['adresse']);
$motdepasse = mysqli_real_escape_string($link,$_POST['motdepasse']);

echo "data ok";

// Check if the data from the laboratoires table needs to be updated
$query = "SELECT nomLabo, adresseLabo, emailLabo FROM laboratoires WHERE emailLabo='$emailLabo' AND nomLabo='$nomLabo' AND adresseLabo='$adresseLabo'";

$result = mysqli_query($link, $query);
echo "sel1 ok";
if ($result->num_rows == 0) {
  // Update the laboratoires table
  $query = "UPDATE laboratoires SET nomLabo='$nomLabo', adresseLabo=' $adresseLabo', emailLabo='$emailLabo' WHERE emailLabo='$emailLabo'";
  $result = mysqli_query($link, $query);
  echo "ch1 ok";
}

// Check if the data from the users table needs to be updated
$query = "SELECT nom, prenom, email, adresse FROM users WHERE email='$email' AND nom='$nom' AND prenom='$prenom' AND adresse='$adresse'";

$result = mysqli_query($link, $query);
echo "sel2 ok";
if ($result->num_rows == 0) {
  // Update the users table
  $query = "UPDATE users SET nom='$nom', prenom='$prenom', email='$email', adresse='$adresse' WHERE email='$email'";
  $result = mysqli_query($link, $query);
  echo "ch2 ok";
}

$query = "SELECT password FROM users WHERE email='$email'";
$result = mysqli_query($link, $query);
echo "sel3 ok";
if ($result->num_rows > 0) {
  while ($rowpassword = mysqli_fetch_assoc($result)) {
    if (!empty($motdepasse)) {
      // Update the password
      $mdphash = password_hash($motdepasse, PASSWORD_DEFAULT);
      $query = "UPDATE users SET password='$mdphash' WHERE email='$email'";
      $result = mysqli_query($link, $query);
      echo "ch3 ok";
    }
  }

}

// Close the database connection
mysqli_close($link);


?>