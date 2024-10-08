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
  <link rel="stylesheet" href="../assets/css/style.css">
  <meta charset="utf-8" />
  
</head>

<?php include_once "loggedINHeader.php" ?>

<body>
  <div id="popup" class="popup" style="display:none;">
    <iframe id="graphframe" frameborder="0"></iframe>

  </div>

  <!-- Add the overlay div -->
  <div id="overlay" class="overlay" style="display:none;" onclick="document.location.reload(true)"></div>
  <script src="../assets/js/popupMgmt.js"></script>
  


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
    require_once "../model/config.php";

    // faire la requete sql en fonction du labo de la session actuelle
    $query = "SELECT nomBox FROM labboxtable WHERE laboratoires_idlaboratoires =" . $_SESSION["idLabo"];
    $result = mysqli_query($link, $query);

    // on loop a travers tous les rangées renvoyées par sql et on fait des divs a chaque fois, avec le nom de la box
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="box">
      <img src="../assets/images/rondvert.png" alt="icône" style="width:20px;height:20px;float:left;">
      <button class="disablednotadmin Modifnom" onclick=showPopup("popupetat.php?currentBoxID=' . urlencode($row['nomBox']) . '") style="width:32px;height:32px;float:right;"><img src="../assets/images/stylo.png" alt="icône" style="width:20px;height:20px;"></button>
      <br>
      <a href="pageGraphes.php?currentBoxID=' . urlencode($row['nomBox']) . '">
      <img src="../assets/images/imagebox.png" alt="image" style="width:170px;">
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
      <img src="../assets/images/icon.png" alt="icon"
        style="  position: absolute;top: 250px;right: 20px;width: 60px;height: 60px;">
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


  
  
</body>

<?php include_once "footer.php" ?>

