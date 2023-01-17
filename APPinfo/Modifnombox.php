<?php
session_start();
// Connexion a notre bdd
require_once "config.php";

$nomBox = "";
$nomBox_err = "";

//traitement du form
if (isset($_POST["boxNameChanged"])) {

  $nomBox = urldecode($_GET["nombox"]);
        
  if (empty(trim($_POST["boxNameChanged"]))) {
    $nomBox_err = "Vous n'avez pas entré de nom";
  } else {
    $newnomBox = htmlspecialchars(trim($_POST["boxNameChanged"]));
  }

  if (empty($nomBox_err)) {
    // Ajouter le nom de la box dans la base de données
    $query1 = "UPDATE labboxtable SET nombox = '$newnomBox' WHERE nombox = '$nomBox' AND laboratoires_idlaboratoires = ".$_SESSION['idLabo'];
    mysqli_query($link, $query1);
  }

  // Close connection
  mysqli_close($link);

}
 

?>