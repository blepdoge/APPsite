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
  <title>Popup ajout de box</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <meta charset="utf-8" />
</head>

<body>
  <?php
  // Connexion a notre bdd
  require_once "config.php";

  $nomBox = "";
  $nomBox_err = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["nomBox"]))) {
      $nomBox_err = "Donnez un nom à votre Box";
    } else {
      $nomBox = mysqli_real_escape_string($link, trim($_POST["nomBox"]));
    }

    if (empty($nomBox_err)) {
      // Ajouter le nom de la box dans la base de données
      $query = "INSERT INTO labboxtable(nombox, laboratoires_idlaboratoires) VALUES ('$nomBox', '" . $_SESSION["idLabo"] . "')";
      mysqli_query($link, $query);
    }

    // Close connection
    mysqli_close($link);


  }

  ?>

  <div style="padding:50px;">
    <h3>Si vous avez acheté une nouvelle Box, nous vous remercions, et vous prions de bien vouloir lui donner un nom.
    </h3>
    <h3>En cliquant sur confirmer, vous l'ajouterez à votre écran.</h3>
  </div>


  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class=formajout>
    Nom de la Box:
    <input type="text" name="nomBox" class="inpnouvbox" />
    <span class="invalid-feedback">
      <?php echo $nomBox_err; ?>
    </span>
    <input type="submit" value="Confirmer" class="btnpopup" />
  </form>



</body>