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

      $nomBox= "";
      $nomBox_err ="";

      if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["nomBox"]))){
            $nomBox_err = "Donnez un nom à votre Box";
        } else{
            $nomBox=htmlspecialchars(trim($_POST["nomBox"]));
        }

        if(empty($nomBox_err)){
            // Ajouter le nom de la box dans la base de données
            $query = "INSERT INTO labboxtable(nombox, laboratoires_idlaboratoires) VALUES ('$nomBox', '".$_SESSION["idLabo"]."')";
            mysqli_query($link, $query);
        }
            
        // Close connection
        mysqli_close($link);
      }
  ?>
    
  <div class=formajout>
    <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      nom de la Box:
      <input type="text" name="nomBox">
      <span class="invalid-feedback" style="color:red"><?php echo $nomBox_err; ?></span>
      <input type="submit" value="Confirmer">
    </form>
  </div>

  <div class=annul>
    <button onclick="window.location.href = 'ContrôleBox.php';">
      Annuler
    </button>
  <div>


    








</body>