<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}

?>


<!DOCTYPE html>

<head>
  <title>Liste des membres</title>
  <link rel="stylesheet" href="../assets/css/SearchUser.css" />
  <meta charset="utf-8" />

</head>

<header>
  <div class="sideheader">
    <a href="pageAccueil.php"><img class="logotop" src="../assets/images/logosorsen_crop.png" width="60"
        height="60" /></a>

    <div class="textelogo">
      <p style="margin: 18px">SORSEN</p>
    </div>
  </div>

  <script src="../assets/js/showOptions.js">

  </script>

  <nav>
    <ul class="navlien">
      <li><a href="FAQ.php">FAQ</a></li>
      <!--mettre le lien vers la FAQ-->
      <li style="color: gray">|</li>
      <li id="monCompte" onclick="showOptions()">
        <a>Mon compte</a>
      </li>
      <!--ceci fait spawn une popup-->
    </ul>
  </nav>

  <div class="options">
    <ul>
      <li><a href="pageSettings.php">Paramètres</a></li>
      <li><a href="accueilBox.php">Accueil</a></li>
      <li>
        <a href="../controller/logout.php">Déconnexion</a>
      </li>
    </ul>
  </div>
</header>

<!-- Corps de la page -->

<body style="margin:0">

  <div id="popup" class="popup" style="display:none;">
    <iframe id="graphframe" frameborder="0"></iframe>
  </div>

  <!-- Add the overlay div -->
  <div id="overlay" class="overlay" style="display:none;"></div>

  <div class="conteneur">
    <p class="returnp">
      <button class="return" onclick="rtn()">Retourner</button>
      <script>
        function rtn() {
          window.history.back();
        }
      </script>
    </p>
    <div id="search-bar-box">
      <form action="" id="searchform">
        <input id="input" type="text" name="userSearchBar" placeholder="Chercher un utilisateur">
        <button type="submit" id="searchUser" name="searchUser">Chercher</button>
        <div class="graphe disablednotadmin" onclick="showPopup('userAdd.php')">
          <img class="disablednotadmin" src="../assets/images/ajouter.png" alt="addUser" width="30" height="30" />
        </div>
      </form>
    </div>
  </div>

  <div class="largelistwrapper">

    <?php
    require_once "../model/getusersfromdb.php"
      ?>

  </div>
  
  <script>
    // recupere la variable php des permissions
    var adminPerm = <?php echo json_encode($_SESSION['adminPerm']); ?>;

    // check la valeur
    if (adminPerm == '0') {
      // Si la valeur est 0, c'est un user, donc on regarde les elts qui ont la classe
      document.querySelectorAll('.disablednotadmin').forEach(function (element) {
        element.setAttribute('disabled', '');
      });
      document.querySelectorAll('.disablednotadmin').forEach(function (element) {
        element.removeAttribute('onclick');
      });
    }
  </script>
  <script src="../assets/js/popupMgmt.js"></script>
  <script>
    function confirmDelete(userId) {
      
        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
          window.location.href = '../model/TraitementDeleteUser.php?userId=' + userId;

        }
    }
  </script>

</body>
<!--Bas de page-->


  <?php include_once "footer.php" ?>
<script>
  var table = document.getElementById("tableresultats");
  var nbLignesTable = table.tBodies[0].rows.length;

  if (nbLignesTable > 7) {
    var footer = document.getElementById("footer");
    footer.style.position = "relative";
  }
</script>

