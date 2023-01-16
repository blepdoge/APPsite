<?php
// recuperer ou initaliser la session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}

// Connect to the database
require_once "config.php";

// Select the data from the laboratoires table
$sql = "SELECT nomLabo, adresseLabo, emailLabo FROM laboratoires";
$result = mysqli_query($link, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
  // Store the data in variables for each row
  while ($rowLabData = mysqli_fetch_assoc($result)) {
    $nomLabo = $rowLabData["nomLabo"];
    $adresseLabo = $rowLabData["adresseLabo"];
    $emailLabo = $rowLabData["emailLabo"];
  }
} else {
  $nomLabo = "Données manquantes";
  $adresseLabo = "Données manquantes";
  $emailLabo = "Données manquantes";
}

// Close the connection
mysqli_close($link);

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
        <!--ici link le logout.php-->
      </li>
    </ul>
  </div>
</header>

<body style="margin: 0">


  <div class="contenuPage">
    <p class="returnp">
      <button class="return" onclick="rtn()">Retourner</button>
      <script>
      function rtn() {
        window.history.back();
      }
    </script> 
    </p>
    <h2>Paramètres</h2>
    <p id="resultat"></p>
    <form action="" method="POST" id="settingschanges">
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
              <input type="text" class="disablednotadmin" placeholder="Laboratoire"
                value="<?php echo htmlspecialchars($nomLabo); ?>" name="nomLabo" id="nomLabo"/>
              <input type="email" class="disablednotadmin" placeholder="Adresse E-mail Laboratoire"
                value="<?php echo htmlspecialchars($emailLabo); ?>" name="emailLabo" id="emailLabo"/>
              <input type="text" class="disablednotadmin" placeholder="Domiciliation"
                value="<?php echo htmlspecialchars($adresseLabo); ?>" name="adresseLabo" id="adresseLabo"/>
            </div>

            <p></p>

            <div class="partiedroite">
              <input type="text" placeholder="Nom" value="<?php echo htmlspecialchars($_SESSION["nomUser"]); ?>" name="nom" id="nom"/>
              <input type="text" placeholder="Prénom"
                value="<?php echo htmlspecialchars($_SESSION["prenomUser"]); ?>" name="prenom" id="prenom"/>
              <input type="email" placeholder="Adresse E-mail"
                value="<?php echo htmlspecialchars($_SESSION["emailUser"]); ?>" name="email" id="email"/>
              <input type="text" placeholder="Adresse"
                value="<?php echo htmlspecialchars($_SESSION["adresseUser"]); ?>" name="adresse" id="adresse"/>
              <input type="text" class="disablednotadmin" placeholder="Permission" disabled value="<?php if ($_SESSION["adminPerm"] == 1) {
              $adminPermission = "Administrateur";
            } else {
              $adminPermission = "Utilisateur";
            } //crée une nouvelle variable avec la version ecrite des permissions
            ;//puis ecrit la nouvelle variable dans l'input
            echo htmlspecialchars($adminPermission); ?>" />
              <input type="text" placeholder="Changer le mot de passe" name="motdepasse" id="motdepasse"/>
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
            <button onclick="rtn()">Retourner</button>
            <script>
            function rtn() {
              window.history.back();
            } 
</script>
          </div>
        </div>
      </div>
    </form>
    <script src="settingsupdate.js"></script>
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
  </script>


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
</footer>

</html>