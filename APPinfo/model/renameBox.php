<?php 
  
  // Connexion a notre bdd
  
  require "config.php";

  $nomBox_err = "";

  //traitement du form
  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["boxNameChanged"]))) {
      $nomBox_err = "Vous n'avez pas entré de nom";
    } else {
      $newnomBox = htmlspecialchars(trim($_POST["boxNameChanged"]));
    }

    $oldnomBox = $_SESSION["oldName"];

    if (empty($nomBox_err)) {
      // Ajouter le nom de la box dans la base de données
      $query1 = "UPDATE labboxtable SET nombox = '$newnomBox' WHERE nombox = '$oldnomBox' AND laboratoires_idlaboratoires = '" . $_SESSION["idLabo"] . "'";
      mysqli_query($link, $query1);
      $_SESSION["oldName"] = $newnomBox;
    
    }

  }

?>