<?php
// recuperer la session
session_start();

// verifier si l'utilisateur est connecté sinon le rediriger
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}
?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../assets/css/popetatstyle.css">
  <meta charset="utf-8" />
</head>

<body>

  <?php
  require_once "../model/renameBox.php";
  require_once "../model/deleteBox.php";
  ?>
  <div class="titre">
    <h1 id="titre">
    </h1>
    <?php

    if (!isset($oldnomBox)) {
      $oldnomBox = urldecode($_GET["currentBoxID"]);
      $_SESSION["oldName"] = $oldnomBox;
    }

    echo '<form method="POST" action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . '>
    <input type="text" value="' . $_SESSION["oldName"] . '" id="nomLabBox" name="boxNameChanged"></input>
    <input type="submit" id="submitNameChange" value="Modifier le nom de la box"></input> 
    </form>';

    // faire la requete sql en fonction du labo de la session actuelle
    $query = "SELECT LocalIP FROM labboxtable WHERE nomBox = '" . $_SESSION["oldName"] . "' AND laboratoires_idlaboratoires = '" . $_SESSION["idLabo"] . "'";
    $resultatquery = mysqli_query($link, $query);
    $adresseIP = mysqli_fetch_array($resultatquery)[0];


    // Close connection
    mysqli_close($link);

    ?>

  </div>

  <div class="div1">
    <button class="button" type="button" style="background-color:#CEFCB9 ">
      <p>Allumer</p>
    </button>
    <button class="button" type="button" style="background-color:#FFA7A7 ">
      <p>Éteindre</p>
    </button>
  </div>
  <div class="text">
    <p>Statut : Active</p>
    <?php echo "<p>Adresse réseau : " . $adresseIP . "</p>"; ?>
  </div>
  <div class="div2">
    <form action="../model/deleteBox.php" method="POST">
      <input class="buttonsup" name="deleteBox" type="submit" value="Supprimer cette box" style="background-color:#D9D9D9; color:red">
      
  </input>
    </form>
    <script>
      //confirm that prevents default action
      document.querySelector('.buttonsup').addEventListener('click', function(e) {
        if (!confirm('Voulez vous supprimer cette LabBox ?')) {
          e.preventDefault();
        }
      });

      document.getElementById("submitNameChange").addEventListener('click', function() {
        alert("Nom changé !");
      });
    </script>
    

  </div>
</body>

</html>