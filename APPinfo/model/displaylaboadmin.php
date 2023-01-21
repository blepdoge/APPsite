<?php
require_once "config.php";


$sql = "SELECT idlaboratoires, nomLabo, emailLabo, adresseLabo FROM laboratoires";
$result = $link->query($sql);

echo "<table border='1'>";
echo "<tr>";

// Print table headers
echo "<th>ID</th>";
echo "<th>Nom</th>";
echo "<th>Email</th>";
echo "<th>Adresse</th>";

echo "</tr>";

// Print table rows
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["idlaboratoires"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nomLabo"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["emailLabo"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["adresseLabo"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

echo "</table>";

//ne pas fermer pour laisser les users s'importer

?>
