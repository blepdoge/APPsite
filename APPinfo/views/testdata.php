<?php

require_once "../model/config.php";

$ch = curl_init(); //code moodle adapté
curl_setopt(
    $ch,
    CURLOPT_URL,
    "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=004C"
);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$data = curl_exec($ch);
curl_close($ch);
$data_tab_unfil = str_split($data, 33); //split les trames

$data_tab = array_slice($data_tab_unfil, 32); // on filtre les données faussées
$size = count($data_tab);

$groupedPackets = []; //dico des packets groupés par timestamp

for ($i = 0; $i < $size - 2; $i += 3) { //loop pour afficher les trames et choper les infos par groupes de 3
    $trameArray1 = defragtrame($data_tab[$i]);
    $trameArray2 = defragtrame($data_tab[$i + 1]);
    $trameArray3 = defragtrame($data_tab[$i + 2]);

    //on fait le timestamp à partir de la première trame
    $timestamp = "$trameArray1[8]-$trameArray1[9]-$trameArray1[10] $trameArray1[11]:$trameArray1[12]:$trameArray1[13]";
    if (!isset($groupedPackets[$timestamp])) { //on créé une entrée dans le tableau si elle n'existe pas
        $groupedPackets[$timestamp] = [];
    }

    // Add the values to the groupedPackets dictionary
    $groupedPackets[$timestamp][] = [
        'typeCapteur' => 'Température',
        'value' => hexdec($trameArray1[5]),
    ];
    $groupedPackets[$timestamp][] = [
        'typeCapteur' => 'Humidité',
        'value' => hexdec($trameArray2[5]),
    ];
    $groupedPackets[$timestamp][] = [
        'typeCapteur' => 'Microphone',
        'value' => hexdec($trameArray3[5]),
    ];

}

$query = "SELECT COUNT(*) AS row_count FROM sensorvalues";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$rowCount = $row['row_count'];
echo "Number of rows in the sensorvalue table: " . $rowCount;

$gpCount = count(array_keys($groupedPackets));

// Print the groupedPackets dictionary with its contents
foreach ($groupedPackets as $timestamp => $packets) {
    echo "--------------------------------<br />";
    echo "Timestamp: $timestamp<br />";
    foreach ($packets as $packet) {
        $typeCapteur = $packet['typeCapteur'];
        $value = $packet['value'];
        echo "Type de capteur: $typeCapteur<br />";
        echo "Valeur du capteur: $value<br />";
    }
}

$diff = $gpCount - $rowCount;
$slicedData = array_slice($groupedPackets, $rowCount);


// Prepare the INSERT statement
$query = "INSERT INTO sensorvalues (timestamp, CO2value, COvalue, dBvalue, Tempvalue, BPMvalue, LabBoxTable_idLabBox) VALUES (?, 400, ?, ?, ?, 70, 1)";

$stmt = mysqli_prepare($link, $query);

foreach ($slicedData as $timestamp => $packets) {
    $temperature = null;
    $humidity = null;
    $sound = null;
    foreach ($packets as $packet) {
        $typeCapteur = $packet['typeCapteur'];
        $value = $packet['value'];

        // Extract the values for temperature, humidity, and sound

        switch ($typeCapteur) {
            case 'Température':
                $temperature = $value;
                break;
            case 'Humidité':
                $humidity = $value;
                break;
            case 'Microphone':
                $sound = $value;
                break;
        }

    }
    // Bind the parameters and execute the statement
    mysqli_stmt_bind_param($stmt, 'sddd', $timestamp, $humidity, $sound, $temperature);
    mysqli_stmt_execute($stmt);
}


// Close the statement
mysqli_stmt_close($stmt);


//ex trame temp 1004C1301001FB00B8820230619111929

function defragtrame($trame) // analyse de trame
{
    $t = substr($trame, 0, 1); //type de trame
    $o = substr($trame, 1, 4); //Equipe
    $r = substr($trame, 5, 1); //type de requete
    $c = substr($trame, 6, 1); //type du capteur
    $n = substr($trame, 7, 2); //numero du capteur
    $v = substr($trame, 9, 4); //valeur du capteur
    $a = substr($trame, 13, 4); //numero de la trame
    $x = substr($trame, 17, 2); //checksum
    $year = substr($trame, 19, 4); //annee
    $month = substr($trame, 23, 2); //mois
    $day = substr($trame, 25, 2); //jour
    $hour = substr($trame, 27, 2); //heure
    $min = substr($trame, 29, 2); //minute
    $sec = substr($trame, 31, 2); //seconde
    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
        sscanf($trame, "%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s"); // décodage avec sscanf
    echo ("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
    return array(
        $t,
        $o,
        $r,
        $c,
        $n,
        $v,
        $a,
        $x,
        $year,
        $month,
        $day,
        $hour,
        $min,
        $sec
    );
}


?>