<?php
// recuperer ou initaliser la session
session_start();
 
// Check if the user is already logged in, if yes redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ContrôleBox.php");
    exit;
}
 
require_once "login.php";
?>


<!DOCTYPE html>

  <head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/styleLoginAPP.css">
  </head>

  <header>
    <a href="pageAccueil.html"><img class="logotop" src="assets/images/logosorsen_crop.png" width="60" height="60"/></a>

    <div class="textelogo">
      <p style="margin: 18px">SORSEN</p>
    </div>

    <nav>
      <ul class="navlien">
        <li><a href="FAQvisitor.html">FAQ</a></li>
        <!--mettre le lien vers la FAQ-->
        <li style="color: gray">|</li>
        <li><a href="pageLogin.php">Connexion</a></li>
        <!--mettre le lien vers la page de co-->
      </ul>
    </nav>
  </header>

  <body>
    <div class="center">
      <h1>Authentification</h1>

      <?php 
        if(!empty($login_err)){
            echo '<div style="color:red">' . $login_err . '</div>';
        }        
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="txt_field">
          <input type="text" name="username" value="<?php echo $username; ?>" required>
          <span></span>
          <label>Identifiant</label>
          <span class="invalid-feedback" style="color:red"><?php echo $username_err; ?></span>
        </div>

        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Mot de passe</label>
          <span class="invalid-feedback" style="color:red"><?php echo $password_err; ?></span>
        </div>

        <div class="pass">Mot de passe oublié?</div>
        <input type="submit" value="Login">
        </div>
      </form>

    </div>
  </body>

  <!--Bas de page-->
  <footer>
    <img class="logobottom" src="assets/images/SorsenFull.png" width="60" height="50" />

    <div class="infoFooterContainer">
      <ul class="infoFooter">
        <li>SORSEN ENTREPRISE</li>
        <li>10 rue de Vanves</li>
        <li>91230 Issy-les-Moulineaux</li>
      </ul>
    </div>

    <div class="line"></div>

    <div class="infoFooterContainer">
      <ul class="navlien">
        <li><a href="CGU.html">CGU</a></li>
        <li><a href="#">Partenaires</a></li>
        <li><a href="mailto:contactsorsen@sorsen.fr">Nous contacter</a></li>
      </ul>
    </div>

    <div class="newsletterContainer">
      <form id="newsletterForm">
        <!--ici link le code phph pour s'abonner a la newsletter-->
        <div id="result"></div>
        <p>Abonnez-vous à notre newsletter ! <br /></p>
        <input type="email" id="email" placeholder="Adresse mail" name="email" required />
        <input type="submit" name="submitemail" value="S'abonner" />
      </form>
    </div>
    
    <!-- Display the result of the AJAX request -->
    <script src="assets/js/newsletterlink.js"></script>
  </footer>

</html>
