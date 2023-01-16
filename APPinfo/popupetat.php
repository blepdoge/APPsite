<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/css/popetatstyle.css">
<meta charset="utf-8" />
</head>

<body>
    <div class="titre">
    <h1 id="titre">
    </h1>
    <?php

    // Connexion a notre bdd
    require_once "config.php";

    // faire la requete sql en fonction du labo de la session actuelle
    $query = "SELECT LocalIP FROM labboxtable WHERE nomBox =" . $nomBox;
    $adresseIP = mysqli_query($link, $query);

    // fermer bdd
    mysqli_close($link);

    ?>
        
    </div>

    <div class="div1">
        <button class="button" type="button" style="background-color:#CEFCB9 ">
            <p>Allumer</p>
        </button>
        <button class="button" type="button" style="background-color:#FFA7A7 ">
            <p>Éteindre</p>
        </button>
    </div>
    <div class="text">
        <p>Statut : Active</p>
        <?php echo "<p>Adresse réseau : ".$adresseIP."</p>"; ?>
    </div>
    <div class="div2">
        <button class="buttonsup" type="button" style="background-color:#D9D9D9; color:red" onclick=>
            <p>Supprimer cette box</p>
        </button>

        <script>
            // fonction pour afficher la popup
            function showPopup(filepopup) {
              // recup de l'iframe
              var frame = document.getElementById("graphframe");
              // definir la source
              frame.src = filepopup;
              // recup des elements popup et overlay
              var popup = document.getElementById("popup");
              var overlay = document.getElementById("overlay");
              // affichage popup et overlay
              popup.style.display = "block";
              overlay.style.display = "block";
            }
        
            // Function to hide the popup
            function hidePopup() {
              // recup des elements popup et overlay
              var popup = document.getElementById("popup");
              var overlay = document.getElementById("overlay");
              // cacher popup et overlay
              popup.style.display = "none";
              overlay.style.display = "none";
              var frame = document.getElementById("graphframe");
              // definir la source
              frame.src = "";
            }
        
            // Ecouter pour des clicks sur le partie sombre pour sortir de la popup
            document.getElementById("overlay").addEventListener("click", hidePopup);
          </script>


            <script>
            function getParamValue(paramName)
            {
                var url = window.location.search.substring(1); //get rid of "?" in querystring
                var qArray = url.split('&'); //get key-value pairs
                for (var i = 0; i < qArray.length; i++) 
                {
                    var pArr = qArray[i].split('='); //split key and value
                    if (pArr[0] == paramName) 
                        return pArr[1]; //return value
                }
            }
            var param1 = getParamValue('currentBoxID');
            document.getElementById("titre").innerHTML = param1;
            </script>

    </div>    
</body> 
</html>   