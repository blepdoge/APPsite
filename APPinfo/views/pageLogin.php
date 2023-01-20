<?php
// recuperer ou initaliser la session
session_start();

// Check if the user is already logged in, if yes redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: accueilBox.php");
  exit;
}

require_once "../model/login.php";
?>


<!DOCTYPE html>

<head>
  <title>Connexion</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../assets/css/styleLoginAPP.css">
</head>

<?php include_once "loggedOUTHeader.php" ?>

<body>
  <div class="center">
    <h1>Authentification</h1>

    <?php
    if (!empty($login_err)) {
      echo '<div style="color:red">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <div class="txt_field">
        <input type="text" name="username" value="<?php echo $username; ?>" required>
        <span></span>
        <label>Identifiant</label>
        <span class="invalid-feedback" style="color:red">
          <?php echo $username_err; ?>
        </span>
      </div>

      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Mot de passe</label>
        <span class="invalid-feedback" style="color:red">
          <?php echo $password_err; ?>
        </span>
      </div>

      <div class="pass">Mot de passe oublié?</div>
      <input type="submit" value="Login">
  </div>
  </form>

  </div>
</body>

<!--Bas de page-->
<?php include_once "footer.php" ?>

</html>