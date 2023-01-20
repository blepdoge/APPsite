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
  <title>Ajouter un nouvel utilisateur</title>
  <link rel="stylesheet" href="assets/css/User.css" />
  <meta charset="utf-8" />
</head>

<body>
  <p class="titre">Ajouter un nouvel utilisateur</p>

  <form method="post" action="TraitementAddUser.php">
    <div class="adduserwrapper">
      <input class="prenom" type="text" name="prenom" id="prenom" placeholder="Prénom" required size="30"
        maxlength="30" />
      <input class="nom" type="text" name="nom" id="nom" placeholder="Nom" required size="30" maxlength="30" />
      <input class="idlaboratoire" type="text" name="idlaboratoire" id="idlaboratoire" placeholder="ID du laboratoire"
        required size="30" maxlength="30" />
      <input class="email" type="email" name="email" id="email" placeholder="E-mail" required size="30"
        maxlength="75" />
      <input class="adresse" type="text" name="adresse" id="adresse" placeholder="Adresse" required size="30"
        maxlength="75" />
      <input class="password" type="password" name="password" id="password" placeholder="mot de passe" required />
      <select class="statut" name="statut" id="statut" value="statut" required>
        <option>Choisir le statut</option>
        <option value="Administrateur">Administrateur</option>
        <option value="Utilisateur">Utilisateur</option>
      </select>
      <input type="submit" class="confirmer" type="submit" value="Ajouter" />
    </div>
  </form>
</body>

</html>