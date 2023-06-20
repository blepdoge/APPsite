<?php $ch = curl_init();
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
echo "Raw Data:<br />";
//echo ("$data");
$data_tab = str_split($data, 33);
echo "Tabular Data:<br />";
$size = count($data_tab);

for ($i = 0; $i < $size - 1; $i++) { //loop pour afficher les trames et choper les infos
    echo ($i);
    echo "Trame $i: $data_tab[$i]<br />";
    $trameArray = defragtrame($data_tab[$i]);
    switch($trameArray[3]){//switch pour afficher le type de capteur
        case "3":
            $typeCapteur = "Température";
            break;
        case "4":
            $typeCapteur = "Humidité";
            break;
        case "A":
            $typeCapteur = "Microphone";
            break;
    }
    
    echo("Type de capteur : $typeCapteur<br />");
    $decimalValue = hexdec("$trameArray[5]");
    echo("Valeur du capteur : $decimalValue<br />");
    echo ("---------------<br />");
}

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
        sscanf($trame, "%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");// décodage avec sscanf
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