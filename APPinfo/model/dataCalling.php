<?php 


require_once "config.php";
$query = "SELECT * FROM (SELECT sensorvalues.* FROM sensorvalues INNER JOIN labboxtable ON sensorvalues.LabBoxTable_idLabBox = labboxtable.idLabBox WHERE labboxtable.nomBox='$currentBoxID' ORDER BY timestamp DESC LIMIT 6)Var1 ORDER BY timestamp ASC";
$data = mysqli_query($link, $query);

foreach ($data as $row) {
    $dbson[] = $row['dBvalue'];
    $temp[] = $row['Tempvalue'];
    $co2[] = $row['CO2value'];
    $humid[] = $row['COvalue'];//remap humidity
    $bpm[] = $row['BPMvalue'];
    $timestamp[] = $row['timestamp'];
    //make the timestamp only be hours and minutes and seconds
    $timestamp = array_map(function ($timestamp) {
        return date('H:i:s', strtotime($timestamp));
    }, $timestamp);
}
?>