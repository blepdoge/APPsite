<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Quiz des dangers</title>
  <link rel="stylesheet" href="assets/css/quizStyle.css" />
</head>

<?php include_once "views/LoggedOUTHeader.php" ?>
<!--------------------------------------------------------HAUT DE PAGE------------------------------------------------------------>



<body style="margin: 0">

  <div class="mainWrapper">
    <h1>Quiz : Connaissez-vous bien les dangers en laboratoire ?</h1>

    <div class="quiz-container">
      <div id="quiz" class="divDisplay"></div>
    </div>


    <div class="buttonsAll">
      <div class="divButtonsNav">
        <button class="buttonNav" id="previous">Question précédente</button>
        <button class="buttonNav" id="next">Question suivante</button>
      </div>
      <button id="submit">Voir mon résultat</button>
    </div>





    <div id="results">

      <script class src="assets/js/quizScript.js"></script>
    </div>
  </div>

</body>


<!---------------------------------------------------------BAS DE PAGE------------------------------------------------------------->
<?php include_once "views/footer.php" ?>

</html>