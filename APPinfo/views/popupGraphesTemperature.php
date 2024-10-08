<?php

$currentBoxID = urldecode($_GET["currentBox"]);
require_once "../model/dataCalling.php";

?>

<!DOCTYPE html>
<html>

<head>
  <title>Température</title>
  <meta charset="utf-8" />
  
  <link rel="stylesheet" href="../assets/css/popupGraphesStyle.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="margin: 0">

  <div class="maincontentGraph">
    <div class="containersGraph">
      <div class="titleZoneGraphes">
        <h1><strong>Température</strong></h1>
      </div>
      <div class="GraphetValeurText">
        <p class="valeurGraphe"><?php echo end($temp)?>°C<br><br>Valeur min :<br><?php echo min($temp)?>°C<br><br>Valeur max :<br><?php echo max($temp)?>°C</p>
        <img class="ligne" src="../assets/images/Line.png" alt="Graph" />
        <div class="canvasContainer">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode($timestamp); ?>,
      datasets: [{
        label: 'Température',
        data: <?php echo json_encode($temp); ?>,
        borderWidth: 1
      }]
    },
      options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  </script>

</body>

</html>

<!--https://www.cssscript.com/categories/chart-graph/ lien pour faire les graphes quand on sera plus avancés-->