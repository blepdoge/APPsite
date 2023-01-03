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
  <title>Commander une LabBox</title>
  <link rel="stylesheet" href="assets/css/SearchUser.css" />
  <meta charset="utf-8" />
</head>

<header>
  <div class="sideheader">
    <a href="pageAccueil.html"><img class="logotop" src="assets/images/logosorsen_crop.png" width="60" height="60" /></a>

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

  <div class="conteneur">
    <div id="search-bar-box">
      <form action="" id="searchform">
        <input id="input" type="text" name="userSearchBar" placeholder="Chercher un utilisateur">
        <button type="submit" id="searchUser" name="searchUser">Chercher</button>
        <img class="disablednotadmin" src="assets/images/ajouter.png" alt="addUser" width="30" height="30" />
      </form>
    </div>
  </div>

  <div class="largelistwrapper">

    <?php
    // Connexion a notre bdd
    $db = new mysqli('localhost', 'root', '', 'mydb');

    // check si il y a un erreur de co
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    //si qqc est passé en param get, on l'affecte a une variable, sinon, display tout
    if (isset($_GET['userSearchBar']) && !empty($_GET['userSearchBar'])) {
      // Sanitize les inputs pour eviter une injection sql
      $search = $db->real_escape_string($_GET['userSearchBar']);

      // Generer la requete SQL en cherchant par nom ou prenom
      $searchquery = "SELECT prenom, nom, email, adminPerm FROM users WHERE nom = '" . $search . "'OR prenom = '" . $search . "' ";
    } else {
      // si rien de renvoyé alors on affiche tout
      $searchquery = "SELECT * FROM users ORDER BY nom asc";
    }

    // faire la requete sql en fonction de la query plus haut
    $resultSearch = $db->query($searchquery);

    // recheck pour des erreurs encore
    if (!$resultSearch) {
      die("Query failed: " . $db->error);
    }

    if($resultSearch->num_rows==0){
      echo '<img src="assets/images/empty.png" width="128" height="128" style="margin-top:50px">
      <h2 style="margin-top:80px">Pas de résultat correspondant, essayez autre chose...<h2>';
    }else{
    // on loop a travers tous les rangées renvoyées par sql et on fait des divs a chaque fois, avec le nom de la box
    while ($user = $resultSearch->fetch_assoc()) {
      

      if ($user["adminPerm"] == 1) {
        $adminPermission = "Administrateur";
      } else {
        $adminPermission = "Utilisateur";
      }
      echo '<table>
      <tr class="conteneurline">
        <td width="60"><img src="assets/images/personne.png" alt="Logo personne" width="30" height="30" /></td>
        <td width="200"><p>' . $user["prenom"] . '</p></td>
        <td width="200"><p>' . $user["nom"] . '</p></td>
        <td width="60" class="seperate"><p>I</p></td>
        <td width="400"><p>' . $user["email"] . '</p></td>
        <td width="200"><p>' . $adminPermission . '</p></td>
        <td width="60"><img class="disablednotadmin" src="assets/images/parametre.png" alt= "Logo param" width="30" height="30" /></td>
        <td width="30"><img class="disablednotadmin" src="assets/images/supprimer.png" alt= "Logo delete" width="30" height="30" /></td>
      </tr>
    </table>';
    }}

    // Fermeture de la bdd
    $db->close();

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
        <input type="email" id="email" placeholder="Adresse mail" name="email" required />
        <input type="submit" name="submitemail" value="S'abonner" />
      </form>
    </div>
    
    <!-- Display the result of the AJAX request -->
    <script src="newsletterlink.js"></script>
</footer>