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
    <title>Support rapide</title>
    <link rel="stylesheet" href="assets/css/supportstyle.css" />
  </head>
  <header>
    <div class="textelogo">
      <p style="margin: 18px">Support Labbox</p>
    </div>
  </header>

  <body style="margin: 0">
    <form action="#">

        <script>
            function showHideSelect() {
                var nature = document.getElementById("nature");
                var quelbox = document.getElementById("quelbox");
                var quelproblem = document.getElementById("quelproblem");
                if (nature.value === "Sur une des labbox") {
                    quelbox.style.display = "block";
                    quelproblem.style.display = "none";
                } else if (nature.value === "Autre") {
                    quelproblem.style.display = "block";
                    quelbox.style.display = "none";
                } else {
                    quelbox.style.display = "none";
                    quelproblem.style.display = "none";
                }
            }
        </script>

      <div class="div1">
        <select class="nature" name="nature" id="nature" value="nature" onchange="showHideSelect()">
          <option>Quelle est la nature de votre problème?</option>
          <option value="Sur une des labbox">Sur une des labbox</option>
          <option value="Autre">Autre</option>
        </select>

          <select class="quelbox" name="quelbox" id="quelbox" value="quelbox">
              <option>Sur quelle labbox rencontrez vous un problème?</option>
              <?php
              if(isset($_SESSION['nomBox'])){
                  $nomBox = $_SESSION['nomBox'];
                  for($i=1; $i<=$nomBox; $i++){
                      echo '<option value="labbox n°'.$i.'">labbox n°'.$i.'</option>';
                  }
              }
              ?>
          </select>

          <select class="quelproblem" name="quelproblem" id="quelproblem" value="quelproblem" >
              <option>Quel problem vous racontre?</option>
              <option value="Problèmes après-vente">Problèmes après-vente</option>
              <option value="Questions de qualité">Questions de qualité</option>
              <option value="another">autre</option>
          </select>


          <!--<select class="quelbox" name="quelbox" id="quelbox" value="quelbox">
          <option>Sur quelle labbox rencontrez vous un problème?</option>
          <option value="labbox n°1 (192.178.0.1)">
            labbox n°1 (192.178.0.1)
          </option>
          <option value="labbox n°2 (192.178.0.2)">
            labbox n°2 (192.178.0.2)
          </option>
        </select>-->
      </div>
      <div class="div2">
        <p class="text">
          Merci de nous décrire précisément la nature du problème, un
          administrateur vous répondra dans les plus brefs délais.
        </p>
        <textarea
          class="commentaires"
          id="commentaires"
          name="commentaires"
          rows="8"
          cols="80"
        ></textarea>
      </div>
      <div class="div1">
        <input class="envoyer" type="submit" value="Envoyer" />
      </div>
    </form>
  </body>
</html>
