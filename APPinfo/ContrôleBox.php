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
    $db = new mysqli('localhost', 'root', '', 'mydb');

    // check si il y a un erreur de co
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    // faire la requete sql en fonction du labo de la session actuelle
    $query = "SELECT nomBox FROM labboxtable WHERE laboratoires_idlaboratoires =" . $_SESSION["idLabo"];
    $result = $db->query($query);


    // recheck pour des erreurs encore
    if (!$result) {
      die("Query failed: " . $db->error);
    }

    // on loop a travers tous les rangées renvoyées par sql et on fait des divs a chaque fois, avec le nom de la box
    while ($row = $result->fetch_assoc()) {
      echo '<div class="box">
      <img src="assets/images/rondvert.png" alt="icône" style="width:20px;height:20px;float:left;">
      <a href="#"><img src="assets/images/stylo.png" alt="icône" style="width:20px;height:20px;float:right"></a>
      <br>
      <a href="pageGraphes.php?currentBoxID=' . urlencode($row['nomBox']) . '">
      <img src="assets/images/imagebox.png" alt="image" style="width:170px;">
      <p>' . $row['nomBox'] . '</p>
      </a>
  </div>';
    }

    // fermer bdd
    $db->close();

    ?>

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