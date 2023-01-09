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

<header>

  <div class="sideheader">
    <a href="pageAccueil.html">
      <img class="logotop" src="assets/images/logosorsen_crop.png" width="60" height="60" />
    </a>


    <div class="textelogo">
      <p style="margin: 18px">SORSEN</p>
    </div>
  </div>


  <div class="userSearchBar">
    <form method="GET" action="userList.php" id="searchForm"> <!--rediriger vers userSearch avec les params en head-->

      <input type="text" id="userSearchBar" name="userSearchBar" placeholder="Chercher un utilisateur">
      <button type="submit" id="searchUser" name="searchUser">Chercher</button>

    </form>
  </div>

  <script>
    function showOptions() {

      const element = document.querySelector(".options");

      if (element.classList.contains('show') == false) {
        element.classList.add("show");// affiche le menu
      } else {
        element.classList.remove("show");
      }
      // cache le menu
      //ce menu vous est apporté par louis-marie
    }
  </script>

  <nav>
    <ul class="navlien">
      <li><a href="FAQ.html">FAQ</a></li>
      <!--mettre le lien vers la FAQ-->
      <li style="color: gray">|</li>
      <li id="monCompte" onclick="showOptions()">
        <a>Mon compte</a>
      </li>
      <!--mettre le lien vers la page de co-->
    </ul>
  </nav>

  <div class="options">
    <ul>
      <li><a href="pageSettings.php">Paramètres</a></li>
      <li><a href="ContrôleBox.php">Administration</a></li>
      <li>
        <a href="logout.php">Déconnexion</a>
        <!--ici faudra link le logout.php-->
      </li>
    </ul>
  </div>
</header>

<body>
<div id="popup" class="popup" style="display:none;">
  <iframe id="graphframe" frameborder="0"></iframe>
  <div class=annul style="right:150px;">
    <button onclick="hidePopup()"> 
      Terminé
    </button>
  </div>
  <div class=annul>
    <button onclick="hidePopup(), href='ContrôleBox.php'"> Annuler
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
      <a href="#"><img class="disablednotadmin" src="assets/images/stylo.png" alt="icône" style="width:20px;height:20px;float:right"></a>
      <br>
      <a href="pageGraphes.php?currentBoxID=' . urlencode($row['nomBox']) . '">
      <img src="assets/images/imagebox.png" alt="image" style="width:170px;">
      <p>' . $row['nomBox'] . '</p>
      </a>
      </div>';
    }

    // fermer bdd
    mysqli_close($link);

    ?>

  </div>

  <div class="container">
    <div style="width:fitcontent">
    <button class="plus" onclick="showPopup('AjoutBox.php')">
      <h1>+</h1>
    </button>
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

<footer>
  <img class="logobottom" src="assets/images/SorsenFull.png" width="100" height="90" />

  <div class="infoFooterContainer">
    <ul class="infoFooter">
      <li>SORSEN ENTREPRISE</li>
      <li>10 rue de Vanves</li>
      <li>91230 Issy-les-Moulineaux</li>
    </ul>
  </div>

  <div class="line"></div>

  <div class="infoFooterContainer">
    <ul class="navlien">
      <li><a href="#">CGU</a></li>
      <li><a href="#">Partenaires</a></li>
      <li><a href="mailto:contactsorsen@sorsen.fr">Nous contacter</a></li>
    </ul>
  </div>

  <div class="newsletterContainer">
    <form id="newsletterForm">
      <!--ici link le code ajax intervient pour s'abonner a la newsletter-->
      <div id="result"></div>
      <p>Abonnez-vous à notre newsletter ! <br /></p>
      <input type="email" id="email" placeholder="Adresse mail" name="email" required />
      <input type="submit" name="submitemail" value="S'abonner" />
    </form>
  </div>

  <!-- afficher le resultat de la requete AJAX -->
  <script src="newsletterlink.js"></script>
</footer>