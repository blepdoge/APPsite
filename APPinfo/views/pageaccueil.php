<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Bienvenue chez Sorsen!</title>
  <link rel="stylesheet" href="assets/css/styleaccueil.css" />
</head>

<?php include_once "views/LoggedOUTHeader.php" ?>

<!------------------------------------------------BODY---------------------------------------------------->

<body style="margin: 0">
  <div class="mainWrapper">
    <!-- zone du titre avec description et quizz -->
    <div class="titleZone">
      <h1><strong>SORSEN</strong></h1>

      <h2>
        Fruit de plusieurs années d’expertise dans le milieu médical, SORSEN
        vous apporte des solutions pour sécuriser vos laboratoires et assurer
        à votre personnel des conditions optimales de travail.
      </h2>

      <h2>
        Connaissez-vous bien les dangers en laboratoire ?
      </h2>
      <a href=quiz.php> <button class="boutonQuiz">Faire le test</button></a>
    </div>

    <!-- zone de contenu principal -->
    <div class="mainContent1">
      <div class="colonneGaucheMilieuAccueil">
        <img class="imageProtoLabbox" src="assets/images/ImageProtoLabbox.png" alt="Image de Labbox" />
        <img class="labboxlogosmall" src="assets/images/labboxlogosmall.png" alt="logo labbox" />
        <p>
          LabBox, notre produit phare. Plusieurs capteurs associés à une
          plateforme interactive de haute qualité permettent d’assurer la
          sécurité de votre personnel à tout instant.
        </p>
      </div>

      <div class="colonneDroiteMilieuAccueil">
        <div class="barreGauche">
          <div class="containersBlabla">
            <img src="assets/images/logoCentralisation.png" alt="logoCentralisation" />
            <h3>
              Centralisation
            </h3>
            <p>
              Gestion centralisée des appareils, capteurs, et utilisateurs
            </p>
          </div>
          <!-- fin containeur centralisation-->

          <div class="containersBlabla">
            <!--containeur bien-être-->

            <img src="assets/images/logoBienetre.png" alt="logoBienetre" />
            <h3>
              Bien-être
            </h3>
            <p>
              Monitoring d’indicateurs provoquant du stress ou liés au stress
            </p>
          </div>
          <!-- fin containeur bien-être-->
        </div>
        <!--fin barre gauche-->

        <div class="barreDroite">
          <div class="containersBlabla">
            <!--containeur sécurité-->

            <img src="assets/images/logoSecurite.png" alt="logoSecurite" />
            <h3>
              Sécurité
            </h3>
            <p>Détection et monitoring des gazs nocifs présents dans l’air</p>
          </div>
          <!-- fin containeur sécurité-->

          <div class="containersBlabla">
            <!--containeur analyse et suivi-->

            <img src="assets/images/logoAnalyse.png" alt="logoAnalyse" />
            <h3>
              Analyse et Suivi
            </h3>
            <p>
              Affichage clair en graphes des données relevées avec possiblité
              d’export
            </p>
          </div>
          <!--fin containeur analyse et suivi-->
        </div>
        <!--fin barre droite-->
      </div>
    </div>

    <div class="maincontent2">
      <div class="content2info">
        <p>
          Vous ou votre laboratoire êtes intéressés par notre produit? Vous
          pouvez postuler en remplissant ce formulaire, nous permettant
          d’évaluer votre candidature et de vous proposer une solution
          adaptée.
        </p>
        <a href="pageCommande.php"><button class="formaccessbtn">Accéder au formulaire</button></a>
      </div>
      <img class="genericlaboimg" src="assets/images/genericlabo.png" alt="genericlabo" />
    </div>
  </div>
</body>

<!--Bas de page-->
<?php include_once "views/footer.php" ?>

</html>