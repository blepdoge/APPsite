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
    <title>Foire Aux Questions</title>
    <link rel="stylesheet" href="assets/css/styleFAQ.css" />
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
        <li>
          <a href="logout.php">Déconnexion</a>
          <!--ici faudra link le logout.php-->
        </li>
      </ul>
    </div>
  </header>

  <body>
    <div class="titre">
      <h1>FAQ</h1>
      <h2>
        Vous avez des questions, des interrogations, des doutes ? Trouvez vos
        réponses ici !
      </h2>
    </div>

    <div class="liste">
      <div class="questions">
        <div class="titre-question" id="titre-question1">
          <p>1) Comment allumer ma labbox ?</p>
        </div>
        <div class="dropdown-content" id="dropdown-content1">
          <div class="reponse">
            <p>
              Appuyez sur le bouton situé sur la base de la boîte. Vérifiez le
              cable d'alimentation si jamais rien de ne se passe au bout de 30
              secondes.
            </p>
          </div>
          
        </div>
      </div>

      <div class="questions">
        <div class="titre-question" id="titre-question2">
          <p>2) Comment faire si les graphiques ne s'actualisent plus ?</p>
        </div>
        <div class="dropdown-content" id="dropdown-content2">
          <div class="reponse">
            <p>
              Depuis la page sur laquelle vous voyez les graphes de la LabBox
              concernée, cliquez sur "lancer la session". Si ça ne marche pas,
              éteignez votre LabBox et rallumez la. Si ça ne marche pas,
              contactez le service client via la popup de support rapide en bas
              à droite de l'écran.
            </p>
          </div>
          
        </div>
      </div>

      <div class="questions">
        <div class="titre-question" id="titre-question3">
          <p>3) Y a t'il une garantie pour ma LabBox ?</p>
        </div>
        <div class="dropdown-content" id="dropdown-content3">
          <div class="reponse">
            <p>
              La labbox est garantie pendant 2 ans, mais l'achat d'une labbox
              est définitif.
              <br />
              Afin d'éviter d'abîmer votre LabBox, évitez de la mouiller ou de
              l'exposer à des températures très élevées ou très basses. Dans ces
              cas, la température sera détectée et provoquera une alerte mais la
              LabBox risque de ne plus fonctionner correctement. Si la LabBox
              permet de sauver des vies, il est évident qu'il vaut mieux qu'elle
              soit détruite plutôt qu'inutilisée. Il faut garder en tête
              l'importance d'une vie humaine par rapport au prix d'une LabBox.
            </p>
          </div>
          
        </div>
      </div>

      <div class="questions">
        <div class="titre-question" id="titre-question4">
          <p>
            4) Quels signaux indiquent qu'un seuil fixé de CO2, CO, vitesse de
            coeur, température ou volume sonore est dépassé ?
          </p>
        </div>
        <div class="dropdown-content" id="dropdown-content4">
          <div class="reponse">
            <p>
              Si la labbox détecte un problème dans les conditions de travail
              d'un laborantin, un signal sonore vous en alertera et le graphique
              correspondant deviendra rouge. Cela voudra dire qu'une valeur
              critique sera atteinte.
            </p>
          </div>
          
        </div>
      </div>

      <div class="questions">
        <div class="titre-question" id="titre-question5">
          <p>5) Comment contacter le service client ?</p>
        </div>
        <div class="dropdown-content" id="dropdown-content5">
          <div class="reponse">
            <p>
              Vous trouverez tout en bas de la page d'accueil un mail auquel
              vous pouvez écrire et nous vous répondrons dans les plus brefs
              délais :) Si vous n'avez pas de réponse en quelques jours, reférez
              vous à votre administrateur qui dispose d'un lien direct avec nos
              équipes.
            </p>
          </div>
          
        </div>
      </div>
    </div>

    <script src="assets/js/FaqDisplayScript.js"> //anime les divs</script>
  </body>

  <footer>
    <img
      class="logobottom"
      src="assets/images/SorsenFull.png"
      width="60"
      height="50"
    />

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
    <script src="assets/js/newsletterlink.js"></script>
  </footer>
</html>
