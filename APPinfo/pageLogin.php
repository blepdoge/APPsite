<?php
// recuperer ou initaliser la session
session_start();
 
// Check if the user is already logged in, if yes redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ContrôleBox.php");
    exit;
}
 
// infos de connexion bdd
require_once "config.php";
 
// Definition variables pour le script
$username = $password = $nomUser = $prenomUser = $adresseUser = $adminPerm = $idLabo = "";
$username_err = $password_err = $login_err = "";
 
// manipulation données recues
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // verif si email vide
    if(empty(trim($_POST["username"]))){
        $username_err = "Entrez un email.";
    } else{
        $username = mysqli_real_escape_string($link,trim($_POST["username"]));
    }
    
    // Cverif si mdp vide
    if(empty(trim($_POST["password"]))){
        $password_err = "Entrez votre mot de passe";
    } else{
        $password = mysqli_real_escape_string($link,trim($_POST["password"]));
    }
    
    // Valider les identifiants
    if(empty($username_err) && empty($password_err)){
        // Preparation de la requete SQL select
        $sql = "SELECT idusers, email, password, nom, prenom, adresse, adminPerm, laboratoires_idlaboratoires FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // asocation des variables a la req en tant que parametres
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // definition params
            $param_username = $username;
            
            // tentative d'execution du statement
            if(mysqli_stmt_execute($stmt)){
                // stockage resultats
                mysqli_stmt_store_result($stmt);
                
                // verif username, si existe dans ce cas check mdp
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // assocation des variables aux resultats de la req
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $nomUser, $prenomUser, $adresseUser, $adminPerm, $idLabo);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // mdp correct donc on crée une session php
                            session_start();
                            
                            // stockage des données user dans les variables session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["emailUser"] = $username;
                            $_SESSION["nomUser"] = $nomUser; 
                            $_SESSION["prenomUser"] = $prenomUser; 
                            $_SESSION["adresseUser"] = $adresseUser; 
                            $_SESSION["adminPerm"] = $adminPerm;
                            $_SESSION["idLabo"] = $idLabo;                              
                            
                            // Redirection
                            header("location: ContrôleBox.php");
                        } else{
                            // mdp non valide donc erreur
                            $login_err = "Mot de passe invalide.";
                        }
                    }
                } else{
                    // username non valide donc erreur
                    $login_err = "Email invalide.";
                }
            } else{ // si pb dans le if
                echo "Oups! Quelque chose s'est mal passé. Réessayez plus tard.";
            }

            // fermeture du statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // fermeture connection bdd
    mysqli_close($link);
}
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
        <li><a href="FAQ.html">FAQ</a></li>
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
    <img class="logobottom" src="assets/images/SorsenFull.png" width="100" height="90" />

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
