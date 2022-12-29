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
<html>

<head>
  <title>Paramètres</title>
  <link rel="stylesheet" href="assets/css/styleSettingsAPP.css" />
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
      //cache le menu
      //ce menu vous est apporté par louis-marie
    }
  </script>

  <nav>
    <ul class="navlien">
      <li><a href="FAQ.html">FAQ</a></li>
      <!--mettre le lien vers la FAQ-->
      <li style="color: gray">|</li>
      <li onclick="showOptions()">
        <a href="#">Mon compte</a>
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

<body style="margin: 0">
  <div class="contenuPage">
    <h2>Paramètres</h2>
    <form action="#">
      <div class="containerset">
        <div class="containerset1">
          <div class="Zonesdetextegauche">
            <div class="partiedroite">
              <p class="infolabotxt">Informations Laboratoire</p>

              <p class="infousertxt">Informations utilisateur</p>

              <p>Affichage</p>
            </div>
          </div>
        </div>

        <div class="containerset2">
          <div class="Zonesdetextedroite">
            <div class="partiedroite">
              <input type="text" placeholder="Laboratoire" required />
              <input type="email" placeholder="Adresse E-mail Laboratoire" required />
              <input type="text" placeholder="Domiciliation" required />
              <input type="text" placeholder="Téléphone Laboratoire" required />
            </div>

            <p></p>

            <div class="partiedroite">
              <input type="text" placeholder="Nom" required />
              <input type="text" placeholder="Prénom" required />
              <input type="email" placeholder="Adresse E-mail" required />
              <input type="text" placeholder="Mot de passe" required />
              <input type="text" placeholder="Téléphone" required />
              <input type="text" placeholder="Permission" required />
            </div>

            <p></p>

            <div class="partiedroite">
              <select class="Theme" value="Séléctionner le thème">
                <option>Séléctionner le thème</option>
                <option value="Lightmode">Lightmode</option>
                <option value="Darkmode">Darkmode</option>
              </select>
            </div>

            <p></p>

            <input type="submit" value="Sauvegarder" />
          </div>
        </div>
      </div>
    </form>
  </div>
</body>

<!--Bas de page-->
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
        <!--ici link le code phph pour s'abonner a la newsletter-->
        <div id="result"></div>
        <p>Abonnez-vous à notre newsletter ! <br /></p>
        <input type="text" id="email" placeholder="Adresse mail" name="email" required />
        <input type="submit" name="submitemail" value="S'abonner" />
      </form>
    </div>
    
    <!-- Display the result of the AJAX request -->
    <script src="newsletterlink.js"></script>
</footer>

</html>