<?php
// recuperer ou initaliser la session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}

$currentBox = urldecode($_GET["currentBoxID"]);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Données LabBox</title>
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
      <li><a href="FAQ.php">FAQ</a></li>
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
      <li><a href="ContrôleBox.php">Accueil</a></li>
      <li><a href="logout.php">Déconnexion</a>
        <!--ici faudra link le logout.php-->
      </li>
    </ul>
  </div>
</header>

<script>
  function display_c() {
    var refresh = 1000; // rafraichissemnt des infos en ms
    mytime = setTimeout('display_ct()', refresh)
  }
  function display_ct() {
    var x = new Date();
    //on remplit avec des zéros si ca fait pas la bonne taille!
    var x1 = String(x.getDate()).padStart(2, "0") + "/" + String((x.getMonth() + 1)).padStart(2, "0") + "/" + x.getFullYear();
    x1 = x1 + " - " + String(x.getHours()).padStart(2, "0") + ":" + String(x.getMinutes()).padStart(2, "0") + ":" + String(x.getSeconds()).padStart(2, "0");
    document.getElementById('horloge').innerHTML = x1;
    display_c();
  }
</script>

<body onload=display_ct()>
  <div class="titre">
    <h1>
      <?php echo $currentBox ?>
    </h1>
  </div>

  <button class="return" onclick="rtn()">Retourner</button>
  <script>
    function rtn() {
      window.history.back();
    }
  </script>


  <div class="trombone">
    <p id="horloge">
    </p>
  </div>


  <div id="popup" class="popup" style="display:none;">
    <iframe id="graphframe" frameborder="0"></iframe>
  </div>

  <!-- Add the overlay div -->
  <div id="overlay" class="overlay" style="display:none;"></div>

  <div class="boutonsSessions">
    <button class="boutonSessionStart">Lancer la session</button>
    <button class="boutonSessionStop">Arrêter la session</button>
    <button class="boutonSessionExporter">Exporter les données</button>
  </div>

  <div class="boxesWrapper">
    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesCO2.php?currentBox=' . urlencode($currentBox) ?>')">
      <h3>Concentration en CO2</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>500 ppm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesCO.php?currentBox=' . urlencode($currentBox) ?>')">
      <h3>Concentration en CO</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>45 ppm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesVolume.php?currentBox=' . urlencode($currentBox) ?>')">
      <h3>Volume sonore</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>20 dB</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesBPM.php?currentBox=' . urlencode($currentBox) ?>')">
      <h3>Fréquence cardiaque</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>150 bpm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe"
      onclick="showPopup('<?php echo 'popupGraphesTemperature.php?currentBox=' . urlencode($currentBox) ?>')">
      <h3>Température</h3>
      <img src="assets/images/graphe.png" alt="graphe" style="width:280px;">
      <div class="indic">
        <p>20°</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->

  </div>

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

    // Add an event listener to the overlay to hide the popup when clicked
    document.getElementById("overlay").addEventListener("click", hidePopup);
  </script>


</body>

<?php include_once "views/footer.php" ?>

</html>