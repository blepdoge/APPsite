<?php
// recuperer ou initaliser la session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: pageLogin.php");
  exit;
}
$currentBoxID = urldecode($_GET["currentBoxID"]);
require_once "../model/dataCalling.php"
?>

<!DOCTYPE html>
<html>

<head>
  <title>Données LabBox</title>
  <link rel="stylesheet" href="../assets/css/PageDesGraphesStyle.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <meta charset="utf-8" />

</head>

<?php include_once "loggedINHeader.php" ?>

<script>
  function display_c() {
    var refresh = 1000; // rafraichissemnt des infos en ms
    mytime = setTimeout('display_ct()', refresh)
  }
  function display_ct() {
    var x = new Date();
    //on remplit avec des zéros si ca fait pas la bonne taille!
    var x1 = String(x.getDate()).padStart(2, "0") + "/" + String((x.getMonth() + 1)).padStart(2, "0") + "/" + x.getFullYear();
    x1 = x1 + " - " + String(x.getHours()).padStart(2, "0") + ":" + String(x.getMinutes()).padStart(2, "0") + ":" + String(x.getSeconds()).padStart(2, "0");
    document.getElementById('horloge').innerHTML = x1;
    display_c();
  }
</script>

<body onload=display_ct()>
  <div class="titre">
    <h1>
      <?php echo $currentBoxID ?>
    </h1>
  </div>

  <button class="return" onclick="rtn()">Retourner</button>
  <script>
    function rtn() {
      window.history.back();
    }
  </script>


  <div class="trombone">
    <p id="horloge">
    </p>
  </div>


  <div id="popup" class="popup" style="display:none;">
    <iframe id="graphframe" frameborder="0"></iframe>
  </div>

  <!-- Add the overlay div -->
  <div id="overlay" class="overlay" style="display:none;"></div>

  <div class="boutonsSessions">
    <button class="boutonSessionStart">Lancer la session</button>
    <button class="boutonSessionStop">Arrêter la session</button>
    <button class="boutonSessionExporter">Exporter les données</button>
  </div>

  <div class="boxesWrapper">
    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesCO2.php?currentBox=' . urlencode($currentBoxID) ?>')">
      <h3>Concentration en CO2</h3>
      <div class="canvasContainer">
        <canvas id="myChartCO2"></canvas>
      </div>
      <div class="indic">
        <p>500 ppm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesCO.php?currentBox=' . urlencode($currentBoxID) ?>')">
      <h3>Concentration en CO</h3>
      <div class="canvasContainer">
        <canvas id="myChartCO"></canvas>
      </div>
      <div class="indic">
        <p>45 ppm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe"
      onclick="showPopup('<?php echo 'popupGraphesVolume.php?currentBox=' . urlencode($currentBoxID) ?>')">
      <h3>Volume sonore</h3>
      <div class="canvasContainer">
        <canvas id="myChartDB"></canvas>
      </div>
      <div class="indic">
        <p>20 dB</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe" onclick="showPopup('<?php echo 'popupGraphesBPM.php?currentBox=' . urlencode($currentBoxID) ?>')">
      <h3>Fréquence cardiaque</h3>
      <div class="canvasContainer">
        <canvas id="myChartBPM"></canvas>
      </div>
      <div class="indic">
        <p>150 bpm</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->


    <div class="graphe"
      onclick="showPopup('<?php echo 'popupGraphesTemperature.php?currentBox=' . urlencode($currentBoxID) ?>')">
      <h3>Température</h3>
      <div class="canvasContainer">
        <canvas id="myChartTEMP"></canvas>
      </div>
      <div class="indic">
        <p>20°</p>
      </div> <!--fin div indic -->
    </div> <!--ferme div graphe -->

  </div>


  <script src="../assets/js/popupMgmt.js"></script>

  <script src="../assets/js/graphCalling.js"></script>
  <script>
    graphCalling("myChartCO2", <?php echo json_encode($timestamp) ?>, <?php echo json_encode($co2) ?>, "Concentration en CO2");
    graphCalling("myChartCO", <?php echo json_encode($timestamp) ?>, <?php echo json_encode($co) ?>, "Concentration en CO");
    graphCalling("myChartDB", <?php echo json_encode($timestamp) ?>, <?php echo json_encode($dbson) ?>, "Volume sonore");
    graphCalling("myChartBPM", <?php echo json_encode($timestamp) ?>, <?php echo json_encode($bpm) ?>, "Fréquence cardiaque");
    graphCalling("myChartTEMP", <?php echo json_encode($timestamp) ?>, <?php echo json_encode($temp) ?>, "Température");
  </script>


</body>

<?php include_once "footer.php" ?>

</html>