<?php
// recuperer ou initaliser la session

require_once "../model/loginSysadmin.php";
?>


<!DOCTYPE html>

<head>
  <title>Connexion SysAdmin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../assets/css/styleLoginAPP.css">
</head>

<?php include_once "loggedOUTHeader.php" ?>

<body>
  <div class="center">
    <h1>Gestion système</h1>

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

      <input type="submit" value="Login">
  </div>
  </form>

  </div>
</body>

</html>