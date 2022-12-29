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
  <title>LabBox1</title>
  <link rel="stylesheet" href="assets/css/PageDesGraphesStyle.css">
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
        <a href="#">Mon compte</a>
      </li>
      <!--mettre le lien vers la page de co-->
    </ul>
  </nav>

  <div class="options">
    <ul>
      <li><a href="pageSettings.php">Paramètres</a></li>
      <li><a href="ContrôleBox.php">Administration</a></li>
      <li><a href="logout.php">Déconnexion</a>
        <!--ici faudra link le logout.php-->
      </li>
    </ul>
  </div>
</header>

<script>
  function display_c() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()', refresh)
  }
  function display_ct() {
    var x = new Date();
    var x1 = x.getDate() + "/" + (x.getMonth() + 1) + "/" + x.getFullYear();
    x1 = x1 + " - " + String(x.getHours()).padStart(2, "0") + ":" + String(x.getMinutes()).padStart(2, "0") + ":" + String(x.getSeconds()).padStart(2, "0");
    document.getElementById('horloge').innerHTML = x1;
    display_c();
  }
</script>

<body onload=display_ct()>
  <div class="titre">
    <h1>
      <?php echo urldecode($_GET["currentBoxID"]) ?>
    </h1>
  </div>

  <div class="trombone">
    <p id="horloge">
    </p>
  </div>

  <div class="boutonsSessions">
    <button class="boutonSessionStart">Lancer la session</button>
    <button class="boutonSessionStop">Arrêter la session</button>
    <button class="boutonSessionExporter">Exporter les données</button>
  </div>

  <div class="boxesWrapper">
    <div class="graphe">
      <h3>Concentration en CO2</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>500 ppm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe">
      <h3>Concentration en CO</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>45 ppm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe">
      <h3>Volume sonore</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>20 dB</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe">
      <h3>Fréquence cardiaque</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>150 bpm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe">
      <h3>Température</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>20°</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->

  </div>
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
    <form action="newslettergrab.php" method="POST">
      <!--ici link le code phph pour s'abonner a la newsletter-->

      <p>Abonnez-vous à notre newsletter ! <br /></p>
      <input type="text" placeholder="Adresse mail" name="mail" id="mail" required />
      <input type="submit" value="S'abonner" />
    </form>
  </div>
</footer>

</html>