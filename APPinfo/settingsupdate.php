<?php

require_once "config.php";

// Get the submitted data
$nomLabo = $_POST['nomLabo'];
$adresseLabo = $_POST['adresseLabo'];
$emailLabo = $_POST['emailLabo'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$motdepasse = $_POST['motdepasse'];

// Check if the data from the laboratoires table needs to be updated
$query = "SELECT nomLabo, adresseLabo, emailLabo FROM laboratoires WHERE nomLabo = '$nomLabo' AND adresseLabo = '$adresseLabo' AND emailLabo = '$emailLabo'";
$result = mysqli_query($link,$query);
if ($result->num_rows == 0) {
  // Update the laboratoires table
  $query = "UPDATE laboratoires SET nomLabo = '$nomLabo', adresseLabo = '$adresseLabo', emailLabo = '$emailLabo' WHERE nomLabo = '$nomLabo'";
  $result = mysqli_query($link,$query);
}

// Check if the data from the users table needs to be updated
$query = "SELECT nom, prenom, email, adresse FROM users WHERE nom = '$nom' AND prenom = '$prenom' AND email = '$email' AND adresse = '$adresse'";
$result = mysqli_query($link,$query);
if ($result->num_rows == 0) {
  // Update the users table
  $query = "UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', adresse = '$adresse' WHERE nom = '$nom'";
  $result = mysqli_query($link,$query);
}

$query = "SELECT password FROM users WHERE email = '$email'";
$result = mysqli_query($link,$query);
if (password_verify($motdepasse,mysqli_fetch_assoc($result))!==true){
    // Update the password
  $query = "UPDATE users SET password = '$motdepasse' WHERE email = '$email'";
  $result = mysqli_query($link,$query);
}


// Close the database connection
mysqli_close($link);

?>
