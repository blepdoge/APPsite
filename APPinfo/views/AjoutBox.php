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
  <link rel="stylesheet" href="../assets/css/style.css">
  <meta charset="utf-8" />
</head>

<body>
  <?php
  require_once "../model/addBox.php";

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
    IP de la Box :
    <input type="text" name="ipBox" class="inpnouvbox">
    <input type="submit" value="Confirmer" class="btnpopup" />
    <script>
      var btn = document.querySelector('.btnpopup');
      btn.addEventListener('click', function (event) {
        if (confirm('Voulez-vous vraiment ajouter cette box?')) {
          // Save it!
          alert('Box ajoutée');
          window.location.replace('accueilbox.php');
        } else {
          // Do nothing!
          event.preventDefault();
        }
      });
    </script>
  </form>



</body>