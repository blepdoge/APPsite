<?php
session_start();
// Connexion a notre bdd
require_once "config.php";

$nomBox = "";
$nomBox_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["boxNameChanged"]))) {
    $nomBox_err = "Vous n'avez pas entré de nom";
  } else {
    $nomBox = mysqli_real_escape_string($link, trim($_POST["boxNameChanged"]));
  }

  if (empty($nomBox_err)) {
    // Ajouter le nom de la box dans la base de données
    $query = "UPDATE labboxtable SET nombox = '$nomBox' WHERE nombox = '$nomBox' AND laboratoires_idlaboratoires = ".$_SESSION['idLabo'];
    mysqli_query($link, $query);
  }

  // Close connection
  mysqli_close($link);

}

?>