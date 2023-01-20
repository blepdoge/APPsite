<?php
// Connexion a notre bdd
  require_once "../model/config.php";

  $nomBox = "";
  $nomBox_err = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["nomBox"]))) {
      $nomBox_err = "Donnez un nom à votre Box";
    } else {
      $nomBox = mysqli_real_escape_string($link, trim($_POST["nomBox"]));
      $ipBox = mysqli_real_escape_string($link, trim($_POST["ipBox"]));
    }

    if (empty($nomBox_err)) {
      // Ajouter le nom de la box dans la base de données
      $query = "INSERT INTO labboxtable(LocalIP, nombox, laboratoires_idlaboratoires) VALUES ('$ipBox','$nomBox', '" . $_SESSION["idLabo"] . "')";
      mysqli_query($link, $query);
    }

    // Close connection
    mysqli_close($link);


  }
?>