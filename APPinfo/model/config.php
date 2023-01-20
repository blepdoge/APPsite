<?php
// Infos de la BDD locale 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mydb');

// connexion vers la bdd locale
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// verification de la connexion
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>