<?php
$currentBoxID = urldecode($_GET["currentBox"]);

require_once "config.php";
$query = "SELECT sensorvalues.* FROM sensorvalues INNER JOIN labboxtable ON sensorvalues.LabBoxTable_idLabBox = labboxtable.idLabBox WHERE labboxtable.nomBox='$currentBoxID'";
$data = mysqli_query($link, $query);

foreach ($data as $row) {
  
  $bpm[] = $row['BPMvalue'];
  $timestamp[] = $row['timestamp'];
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>popupGraph</title>
    <meta charset="utf-8" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="assets/css/popupGraphesStyle.css" />
  </head>

<body style="margin: 0">

  <div class="maincontentGraph">
      <div class="containersGraph grapheHorsLimite"> 
        <div class="titleZoneGraphes ">
          <h1><strong>Fréquence Cardiaque</strong></h1>   
        </div>
        <div class = "GraphetValeurText">
          <p class = "valeurGraphe">150 bpm<br><br>Valeur min :<br>80 bpm<br><br>Valeur max :<br>150 bpm</p>
          <img class = "ligne" src="assets/images/Line.png" alt="Graph" />
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
        label: 'Vitesse cardiaque',
        data: <?php echo json_encode($bpm); ?>,
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