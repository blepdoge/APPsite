<?php
require_once "config.php";

$sql = "SELECT idusers, nom, prenom, email, adminPerm, laboratoires_idlaboratoires FROM users";
$result = $link->query($sql);

echo "<table border='1'>";
echo "<tr>";

// Print table headers
echo "<th>ID</th>";
echo "<th>nom</th>";
echo "<th>prenom</th>";
echo "<th>email</th>";
echo "<th>adminPerm</th>";
echo "<th>ID Labo</th>";

echo "</tr>";

// Print table rows
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["idusers"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["prenom"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["adminPerm"] . "</td>";
        echo "<td>" . $row["laboratoires_idlaboratoires"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

echo "</table>";

$link->close();

?>
