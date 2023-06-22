<?php 

require_once "config.php";
$query = "SELECT * FROM (SELECT sensorvalues.* FROM sensorvalues INNER JOIN labboxtable ON sensorvalues.LabBoxTable_idLabBox = labboxtable.idLabBox WHERE labboxtable.nomBox='$currentBoxID' ORDER BY timestamp DESC LIMIT 6)Var1 ORDER BY timestamp ASC";
$data = mysqli_query($link, $query);

$dbson = [];
$temp = [];
$co2 = [];
$humid = [];
$bpm = [];
$timestamp = [];
$timestampsF = [];
foreach ($data as $row) {
    $co2[] = $row['CO2value'];
    $humid[] = $row['COvalue'];//remap humidity
    $temp[] = $row['Tempvalue'];
    $dbson[] = $row['dBvalue'];
    $bpm[] = $row['BPMvalue'];
    $timestamp[] = $row['timestamp'];
    //make the timestamp only be hours and minutes and seconds
    $timestampsF = array_map(function ($timestamp) {
        return date('H:i:s', strtotime($timestamp));
    }, $timestamp);
}


?>