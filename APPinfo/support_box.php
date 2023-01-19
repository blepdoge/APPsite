<?php
// recuperer la session
session_start();

// verifier si l'utilisateur est connecté sinon le rediriger
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}

require_once 'config.php';
$boxquery = "SELECT idLabBox, nomBox FROM labboxtable where laboratoires_idlaboratoires =" . $_SESSION["idLabo"];
$boxresult = mysqli_query($link, $boxquery);

mysqli_close($link);
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
  <form method="POST" action="adminsupportemail.php">

    <div class="div1">
      <select class="nature" name="nature" id="nature" value="nature" onchange=showHideSelect()>
        <option>Quelle est la nature de votre problème?</option>
        <option value="Sur une des labbox">Sur une des LabBox</option>
        <option value="Autre">Autre</option>
      </select>

      <select class="quelbox" name="quelbox" id="quelbox" value="quelbox">
        <option>Sur quelle labbox rencontrez vous un problème?</option>
        <?php
        if (isset($_SESSION['idLabo'])) {
          foreach ($boxresult as $box) {
            echo "<option value='" . $box["idLabBox"] . " nommée " . $box["nomBox"] . "'>" . $box["nomBox"] . "</option>";
          }
        }
        ?>
      </select>

      <select class="quelproblem" name="quelproblem" id="quelproblem" value="quelproblem">
        <option>Quel problème rencontrez-vous ?</option>
        <option value="Problèmes après-vente">Problèmes après-vente</option>
        <option value="Questions de qualité">Questions de qualité</option>
        <option value="another">Autre</option>
      </select>
    </div>
    <div class="div2">
      <p class="text">
        Merci de nous décrire plus précisément la nature du problème, un
        administrateur vous répondra dans les plus brefs délais.
      </p>
      <textarea class="commentaires" id="commentaires" name="commentaires" rows="8" cols="80"></textarea>
    </div>
    <div class="div1">
      <input class="envoyer" type="submit" value="Envoyer" />
    </div>
  </form>

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
</body>

</html>