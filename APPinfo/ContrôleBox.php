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
  <title>Panneau de contrôle</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <meta charset="utf-8" />
</head>

<?php include_once "views/LoggedINHeader.php" ?>

<body>
  <div id="popup" class="popup" style="display:none;">
    <iframe id="graphframe" frameborder="0"></iframe>
    <div class=annul style="right:150px;">
      <button onclick="hidePopup(), history.go(0)" class="btnpopup">
        Terminé
      </button>
    </div>
    <div class=annul>
      <button onclick="hidePopup(), href='ContrôleBox.php'" class="btnpopup"> Annuler
      </button>
    </div>
  </div>

  <!-- Add the overlay div -->
  <div id="overlay" class="overlay" style="display:none;"></div>


  <div class="titre">
    <h1>Bonjour, <b>
        <?php echo htmlspecialchars($_SESSION["prenomUser"]); ?>
      </b></h1>
  </div>

  <div class="trombone">
    <p>Vos appareils</p>
  </div>

  <div class="boxes">

    <?php

    // Connexion a notre bdd
    require_once "config.php";

    // faire la requete sql en fonction du labo de la session actuelle
    $query = "SELECT nomBox FROM labboxtable WHERE laboratoires_idlaboratoires =" . $_SESSION["idLabo"];
    $result = mysqli_query($link, $query);

    // on loop a travers tous les rangées renvoyées par sql et on fait des divs a chaque fois, avec le nom de la box
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="box">
      <img src="assets/images/rondvert.png" alt="icône" style="width:20px;height:20px;float:left;">
      <img class="disablednotadmin Modifnom" onclick=showPopup("popupetat.php?currentBoxID=' . urlencode($row['nomBox']) . '") src="assets/images/stylo.png" alt="icône" style="width:20px;height:20px;float:right; onclick="showPopup("Modifnombox.php")">
      <br>
      <a href="pageGraphes.php?currentBoxID=' . urlencode($row['nomBox']) . '">
      <img src="assets/images/imagebox.png" alt="image" style="width:170px;">
      <p class="titrebox">' . $row['nomBox'] . '</p>
      </a>
      </div>';
    }

    // fermer bdd
    mysqli_close($link);

    ?>

  </div>

  <div class="icon">
    <a href="support_box.php">
      <img src="assets/images/icon.png" alt="icon"
        style="  position: absolute;bottom: -100px;right: 20px;width: 60px;height: 60px;">
    </a>
  </div>

  <div>
    <div class="container">
      <div style="width:fitcontent">
        <button class="disablednotadmin plus" onclick="showPopup('AjoutBox.php')">
          <h1 style="margin:0px">+</h1>
        </button>
      </div>
    </div>
  </div>

  <br>
  <br>

  <script>
    // recupere la variable php des permissions
    var adminPerm = <?php echo json_encode($_SESSION['adminPerm']); ?>;

    // check la valeur
    if (adminPerm == '0') {
      // Si la valeur est 0, c'est un user, donc on regarde les elts qui ont la classe
      document.querySelectorAll('.disablednotadmin').forEach(function (element) {
        element.setAttribute('disabled', '');
      });
    }
  </script>

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
</body>

<?php include_once "views/footer.php" ?>