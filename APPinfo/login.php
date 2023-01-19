<?php
// infos de connexion bdd
require_once "config.php";

// Definition variables pour le script
$username = $password = $nomUser = $prenomUser = $adresseUser = $adminPerm = $idLabo = "";
$username_err = $password_err = $login_err = "";

// manipulation données recues
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // verif si email vide
    if (empty(trim($_POST["username"]))) {
        $username_err = "Entrez un email.";
    } else {
        $username = mysqli_real_escape_string($link, trim($_POST["username"]));
    }

    // Cverif si mdp vide
    if (empty(trim($_POST["password"]))) {
        $password_err = "Entrez votre mot de passe";
    } else {
        $password = mysqli_real_escape_string($link, trim($_POST["password"]));
    }

    // Valider les identifiants
    if (empty($username_err) && empty($password_err)) {
        // Preparation de la requete SQL select
        $sql = "SELECT idusers, email, password, nom, prenom, adresse, adminPerm, laboratoires_idlaboratoires FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // asocation des variables a la req en tant que parametres
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // definition params
            $param_username = $username;

            // tentative d'execution du statement
            if (mysqli_stmt_execute($stmt)) {
                // stockage resultats
                mysqli_stmt_store_result($stmt);

                // verif username, si existe dans ce cas check mdp
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // assocation des variables aux resultats de la req
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $nomUser, $prenomUser, $adresseUser, $adminPerm, $idLabo);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
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
                        } else {
                            // mdp non valide donc erreur
                            $login_err = "Mot de passe invalide.";
                        }
                    }
                } else {
                    // username non valide donc erreur
                    $login_err = "Email invalide.";
                }
            } else { // si pb dans le if
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