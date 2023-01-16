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
  <link rel="stylesheet" href="assets/css/SearchUser.css" />
  <meta charset="utf-8" />
</head>

<header>
  <div class="sideheader">
    <a href="pageAccueil.html"><img class="logotop" src="assets/images/logosorsen_crop.png" width="60"
        height="60" /></a>

    <div class="textelogo">
      <p style="margin: 18px">SORSEN</p>
    </div>
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
      <!--ceci fait spawn une popup-->
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
        <div class="graphe" onclick="showPopup('userAdd.php')">
          <img class="disablednotadmin" src="assets/images/ajouter.png" alt="addUser" width="30" height="30" />
        </div>
      </form>
    </div>
  </div>

  <div class="largelistwrapper">

    <?php
    require "getusersfromdb.php"
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
    }

    // Function to show the popup
    function showPopup(datapopup) {
      // Get the iframe element
      var frame = document.getElementById("graphframe");
      // Set the src attribute
      frame.src = datapopup;
      // Get the popup and overlay elements
      var popup = document.getElementById("popup");
      var overlay = document.getElementById("overlay");
      // Show the popup and overlay
      popup.style.display = "block";
      overlay.style.display = "block";
    }

    // Function to hide the popup
    function hidePopup() {
      // Get the popup and overlay elements
      var popup = document.getElementById("popup");
      var overlay = document.getElementById("overlay");
      // Hide the popup and overlay
      popup.style.display = "none";
      overlay.style.display = "none";
      var frame = document.getElementById("graphframe");
      // Set the src attribute
      frame.src = "";
    }

    // Add an event listener to the overlay to hide the popup when clicked
    document.getElementById("overlay").addEventListener("click", hidePopup);

  </script>

</body>
<!--Bas de page-->
<footer id="footer">
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
      <li><a href="CGU.html">CGU</a></li>
      <li><a href="#">Partenaires</a></li>
      <li><a href="mailto:contactsorsen@sorsen.fr">Nous contacter</a></li>
    </ul>
  </div>

  <div class="newsletterContainer">
    <form id="newsletterForm">
      <!--ici link le code phph pour s'abonner a la newsletter-->
      <div id="result"></div>
      <p>Abonnez-vous à notre newsletter ! <br /></p>
      <input type="email" id="email" placeholder="Adresse mail" name="email" required />
      <input type="submit" name="submitemail" value="S'abonner" />
    </form>
  </div>

  <!-- Display the result of the AJAX request -->
  <script src="newsletterlink.js"></script>
<script>
var table = document.getElementById("tableresultats");
    var nbLignesTable = table.tBodies[0].rows.length;

    if (nbLignesTable > 6) {
      var footer = document.getElementById("footer");
      footer.style.position = "relative";
    }
</script>

</footer>
