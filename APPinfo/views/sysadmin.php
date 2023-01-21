<?php
// recuperer ou initaliser la session
session_start();

// Check if the user is already logged in, if yes redirect him to welcome page
if (!isset($_SESSION["sysloggedin"]) || $_SESSION["sysloggedin"] === false) {
    header("location: loginadmin.php");
    exit;
}

require_once "../model/config.php";
?>


<!DOCTYPE html>
<html>

<head>
    <title>Gestion système SORSEN</title>
    <link rel="stylesheet" href="../assets/css/styleSysAdmin.css">
    <meta charset="utf-8">
</head>
<header>
    <div id="headercontainer">

        <div>Gestion système SORSEN</div>
        <div><a href="../controller/logout.php">Deconnexion</a></div>
    </div>
</header>

<body style="margin:0">
    <div class="mainwrapper">
        <div id="containerLab">
            <div id="add-lab">
                <h3>Ajouter un laboratoire</h3>

            </div>
            <div class="dataform">
                <form class="dataform" action="../model/adminaddlabo.php" method="POST">

                    <input type="text" name="nomlabo" placeholder="Nom du laboratoire" required>
                    <input type="text" name="adresselabo" placeholder="Adresse du laboratoire" required>
                    <input type="text" name="emaillabo" placeholder="Email du laboratoire" required>
                    <input type="submit" name="addlabo" id="addlabo" value="Ajouter le laboratoire">

                </form>
            </div>
        </div>

        <div id="containerUser">
            <div id="add-user">
                <h3>Ajouter un utilisateur</h3>

            </div>
            <div class="dataform">
                <form class="dataform" action="../model/adminadduser.php" method="POST">

                    <input type="text" name="prenom" placeholder="Prénom" required maxlength="30" />
                    <input type="text" name="nom" placeholder="Nom" required maxlength="30" />
                    <input type="text" name="idlaboratoire" placeholder="ID du laboratoire" required maxlength="30" />
                    <input type="email" name="email" placeholder="E-mail" required maxlength="75" />
                    <input type="text" name="adresse" placeholder="Adresse" required maxlength="75" />
                    <input type="password" name="password" placeholder="mot de passe" required />
                    <select name="statut" value="statut" required>
                        <option>Choisir le statut</option>
                        <option value="1">Administrateur</option>
                        <option value="0">Utilisateur</option>
                    </select>
                    <input type="submit" name="adduser" id="adduser" value="Ajouter l'utilisateur" />

                </form>
            </div>
        </div>



    </div>

    <div class="tablewrapper">
    <p>Liste des laboratoires :</p>
        <div class="labtable">
            
            <?php include_once "../model/displaylaboadmin.php"; ?>
        </div>
        <p>Liste des utilisateurs :</p>
        <div class="usertable">
  
            <?php include_once "../model/displayuseradmin.php"; ?>

    </div>

    <script>
        //event listerner to prevent default form submission for addlabo
        document.getElementById("addlabo").addEventListener("click", function(event) {
            if(!confirm("Voulez-vous vraiment ajouter ce laboratoire ?")){
                event.preventDefault();
            } else {
                
                window.location.href = "sysadmin.php";
            }
            
        });

        document.getElementById("adduser").addEventListener("click", function(event) {
            if(!confirm("Voulez-vous vraiment ajouter cet utilisateur ?")){
                event.preventDefault();
            } else {
                window.location.href = "sysadmin.php";
            }
            
        });
    </script>

</body>

</html>