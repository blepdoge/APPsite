<?php
$db_host = getenv("DB_HOST");
$db = getenv("SORSEN_DB");
$db_pass = getenv("SORSEN_PASS");
$db_user = getenv("SORSEN_USER");

// connexion vers la bdd locale
$link = mysqli_connect($db_host, $db_user, $db_pass, $db);


// verification de la connexion
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>