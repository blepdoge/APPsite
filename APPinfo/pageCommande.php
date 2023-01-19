<!DOCTYPE html>
<html>

<head>
  <title>Commander une LabBox</title>
  <link rel="stylesheet" href="assets/css/styleFormCommande.css" />
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

<body style="margin: 0">
  <div class="contenuPage">
    <form action="emailcommande.php" method="post">
      <div class="formulaireContact">
        <h2>Vous souhaitez acquérir une LabBox ? C'est ici !</h2>
        <p>
          Remplissez les détails suivants et nous reviendrons vers vous sous
          peu !
        </p>
        <div class="nomPrenom">
          <input id="inputNom" name="inputNom" type="text" placeholder="Nom" required />
          <input type="text" name="prenom" placeholder="Prénom" required />
        </div>

        <input type="text" name="poste" placeholder="Poste dans le laboratoire" required />
        <input type="email" name="email" placeholder="E-mail" required />
        <input type="text" name="nomLaboratoire" placeholder="Nom du laboratoire" required />
        <input type="text" name="adressePostale" placeholder="Adresse postale du laboratoire" required />
        <p>
          Décrivez en quelques lignes votre motivation pour acquérir une
          LabBox
        </p>
        <textarea id="msgMotiv" name="msgMotiv" rows="5" required></textarea>
        <input type="submit" value="Envoyer le formulaire" id="commandeSendMail" />
      </div>
    </form>
  </div>

  <script>
    document
      .getElementById("commandeSendMail")
      .addEventListener("click", function (event) {
        if (!confirm("Voulez-vous vraiment envoyer le formulaire ?")) {
          event.preventDefault();
        }
      });
  </script>
</body>

<!--Bas de page-->
<?php include_once "views/footer.php" ?>

</html>