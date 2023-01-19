<!DOCTYPE html>
<html>

<head>
  <title>Foire aux Questions</title>
  <link rel="stylesheet" href="assets/css/styleFAQ.css" />
  <meta charset="utf-8" />
</head>

<header>
  <a href="pageAccueil.html"><img class="logotop" src="assets/images/logosorsen_crop.png" width="60" height="60" /></a>

  <div class="textelogo">
    <p style="margin: 18px">SORSEN</p>
  </div>

  <nav>
    <ul class="navlien">
      <li><a href="FAQvisitor.php">FAQ</a></li>
      <!--mettre le lien vers la FAQ-->
      <li style="color: gray">|</li>
      <li><a href="pageLogin.php">Connexion</a></li>
      <!--mettre le lien vers la page de co-->
    </ul>
  </nav>
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
        <p>1) Pourquoi acheter une labbox ? A quoi sert-elle ?</p>
      </div>
      <div class="dropdown-content" id="dropdown-content1">
        <div class="reponse">
          <p>
            Une labbox vous apporterait plus de confort dans la sécurisation de votre laboratoire et de vos employés,
            tout en étant facile à utiliser!
          </p>
        </div>

      </div>
    </div>

    <div class="questions">
      <div class="titre-question" id="titre-question2">
        <p>2) Quelles sont les certifications de la labbox ?</p>
      </div>
      <div class="dropdown-content" id="dropdown-content2">
        <div class="reponse">
          <p>
            Nos Labbox ont été certifiées par la norme 60601-1, qui définit les exigences générales pour la sécurité de
            base et les performances essentielles des appareils électromédicaux.
          </p>
        </div>

      </div>
    </div>

    <div class="questions">
      <div class="titre-question" id="titre-question3">
        <p>3) Y a-t'il une garantie pour ma LabBox ?</p>
      </div>
      <div class="dropdown-content" id="dropdown-content3">
        <div class="reponse">
          <p>
            La labbox est garantie pendant 2 ans.
            <br />
            De plus, nous proposons une offre "satisfaits ou remboursés" pendant une période d'essai de 30 jours.
          </p>
        </div>

      </div>
    </div>

    <div class="questions">
      <div class="titre-question" id="titre-question4">
        <p>
          4) Quel est l'état actuel du marché des outil de monitoring de sécurité dans les laboratoires, où Sorsen se
          place-t'il?
        </p>
      </div>
      <div class="dropdown-content" id="dropdown-content4">
        <div class="reponse">
          <p>
            Nos produits sont plutôt novateurs dans leur domaine, ainsi nous n'avons pas vraiment de concurrence et plus
            de partenariats. Bien sûr, il existe énormément de produits de monitoring en laboratoire, mais les gammes
            Labbox sont les seuls à proposer toutes ces activités en même temps.
          </p>
        </div>

      </div>
    </div>

  </div>

  <script src="FaqDisplayScript.js"> //anime les divs</script>
</body>

<?php include_once "views/footer.php" ?>

</html>