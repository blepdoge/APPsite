<?php
// Initialize the session
session_start();

$userId = $_GET["userId"];

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}

require_once "../model/config.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>Profil</title>
  <link rel="stylesheet" href="../assets/css/User.css" />
  <meta charset="utf-8" />
</head>

<body>
  <script>
    function selectElement(id, valueToSelect) {
      let element = document.getElementById(id);
      element.value = valueToSelect;
    }
  </script>
  <?php $sql = "SELECT nom, prenom, adresse, email, adminPerm, laboratoires_idlaboratoires FROM users WHERE idusers = $userId";
  $result = $link->query($sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $prenom = $row['prenom'];
    $nom = $row['nom'];
    $adresse = $row['adresse'];
    $email = $row['email'];
    $adminPerm = $row['adminPerm'];
    $idlaboratoires = $row['laboratoires_idlaboratoires'];

    if ($adminPerm == 0) {
      $adminPermVerbose = "Utilisateur";
    } else {
      $adminPermVerbose = "Administrateur";
    }
  }
  // Close the connection
  $link->close();
  $_SESSION["userId"] = $userId;
  ?>

  <p class="titre">Profil</p>

  <form method="post" action="../model/TraitementModifyUser.php?userId=' . $userId . '">
    <div class="adduserwrapper">
      <input class="prenom" type="text" name="prenom" id="prenom" placeholder="Prénom" required size="30" maxlength="30"
        value="<?php echo $prenom; ?>" />
      <input class="nom" type="text" name="nom" id="nom" placeholder="Nom" required size="30" maxlength="30"
        value="<?php echo $nom ?>" />
      <input class="idlaboratoire" type="text" name="idlaboratoire" id="idlaboratoire" placeholder="ID du laboratoire"
        required size="30" maxlength="30" value="<?php echo $idlaboratoires ?>" />
      <input class="email" type="email" name="email" id="email" placeholder="E-mail" required size="30" maxlength="75"
        value="<?php echo $email ?>" />
      <input class="adresse" type="text" name="adresse" id="adresse" placeholder="Adresse" required size="30"
        maxlength="75" value="<?php echo $adresse ?>" />
      <input class="password" type="password" name="password" id="password" placeholder="mot de passe" 
         />

      <select class="statut" name="statut" id="statut" value="Choisir le statut" required>

        <option value="Administrateur">Administrateur</option>
        <option value="Utilisateur">Utilisateur</option>
      </select>
      <script>selectElement('statut', '<?php echo $adminPermVerbose ?>');</script>
      <input class="confirmer" type="submit" value="Confirmer" />
    </div>
  </form>

  </script>
</body>

</html>