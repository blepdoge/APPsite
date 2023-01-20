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
  <title>Foire aux Questions</title>
  <link rel="stylesheet" href="../assets/css/styleFAQ.css" />
  <meta charset="utf-8" />
</head>

<?php include_once "loggedINHeader.php" ?>

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

  <script src="../assets/js/FaqDisplayScript.js"> //anime les divs</script>
  
</body>

<?php include_once "footer.php" ?>

</html>