<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ContrôleBox.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $nomUser = $prenomUser = $adresseUser = $adminPerm = $idLabo = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Entrez un email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Entrez votre mot de passe";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT idusers, email, password, nom, prenom, adresse, adminPerm, laboratoires_idlaboratoires FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $nomUser, $prenomUser, $adresseUser, $adminPerm, $idLabo);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $username;
                            $_SESSION["nomUser"] = $nomUser; 
                            $_SESSION["prenomUser"] = $prenomUser; 
                            $_SESSION["adresseUser"] = $adresseUser; 
                            $_SESSION["adminPerm"] = $adminPerm;
                            $_SESSION["idLabo"] = $idLabo;                              
                            
                            // Redirect user to welcome page
                            header("location: ContrôleBox.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Mot de passe invalide.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Email invalide.";
                }
            } else{ //if statement doesnt execute
                echo "Oups! Quelque chose s'est mal passé. Réessayez plus tard.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
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
    <img class="logotop" src="assets/images/logosorsen_crop.png" width="60" height="60" />

    <div class="textelogo">
      <p style="margin: 18px">SORSEN</p>
    </div>

    <nav>
      <ul class="navlien">
        <li><a href="#">FAQ</a></li>
        <!--mettre le lien vers la FAQ-->
        <li style="color: gray">|</li>
        <li><a href="#">Connexion</a></li>
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
        <li><a href="#">CGU</a></li>
        <li><a href="#">Partenaires</a></li>
        <li><a href="mailto:contactsorsen@sorsen.fr">Nous contacter</a></li>
      </ul>
    </div>

    <div class="newsletterContainer">
      <form action="#">
        <!--ici link le code phph pour s'abonner a la newsletter-->

        <p>Abonnez-vous à notre newsletter ! <br /></p>
        <input type="text" placeholder="Adresse mail" name="mail" required />
        <input type="submit" value="S'abonner" />
      </form>
    </div>
  </footer>

</html>
