<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../assets/css/popetatstyle.css">
  <meta charset="utf-8" />
</head>

<body>

  <?php
  session_start();
  // Connexion a notre bdd
  require_once "../model/config.php";
  //form pour changer le nom
  

  $nomBox_err = "";

  //traitement du form
  if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty(trim($_POST["boxNameChanged"]))) {
      $nomBox_err = "Vous n'avez pas entré de nom";
    } else {
      $newnomBox = htmlspecialchars(trim($_POST["boxNameChanged"]));
    }

    $oldnomBox = $_SESSION["old"];

    if (empty($nomBox_err)) {
      // Ajouter le nom de la box dans la base de données
      $query1 = "UPDATE labboxtable SET nombox = '$newnomBox' WHERE nombox = '$oldnomBox' AND laboratoires_idlaboratoires = " . $_SESSION["idLabo"];
      mysqli_query($link, $query1);
      $_SESSION["old"] = $newnomBox;
    }

  }


  ?>
  <div class="titre">
    <h1 id="titre">
    </h1>
    <?php

    if (!isset($oldnomBox)) {
      $oldnomBox = urldecode($_GET["currentBoxID"]);
      $_SESSION["old"] = $oldnomBox;
    }


    echo '<form method="POST" action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . '>
    <input type="text" value="' . $_SESSION["old"] . '" id="nomLabBox" name="boxNameChanged"></input>
    <input type="submit" value="Modifier le nom de la box"></input> 
    </form>';



    // faire la requete sql en fonction du labo de la session actuelle
    $query = "SELECT LocalIP FROM labboxtable WHERE nomBox ='" . $_SESSION["old"] . "'";
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
    <button class="buttonsup" type="button" style="background-color:#D9D9D9; color:red" onclick=>
      <p>Supprimer cette box</p>
    </button>

    <script>
      // fonction pour afficher la popup
      function showPopup(filepopup) {
        // recup de l'iframe
        var frame = document.getElementById("graphframe");
        // definir la source
        frame.src = filepopup;
        // recup des elements popup et overlay
        var popup = document.getElementById("popup");
        var overlay = document.getElementById("overlay");
        // affichage popup et overlay
        popup.style.display = "block";
        overlay.style.display = "block";
      }

      // Function to hide the popup
      function hidePopup() {
        // recup des elements popup et overlay
        var popup = document.getElementById("popup");
        var overlay = document.getElementById("overlay");
        // cacher popup et overlay
        popup.style.display = "none";
        overlay.style.display = "none";
        var frame = document.getElementById("graphframe");
        // definir la source
        frame.src = "";
      }

      // Ecouter pour des clicks sur le partie sombre pour sortir de la popup
      document.getElementById("overlay").addEventListener("click", hidePopup);
    </script>




  </div>
</body>

</html>