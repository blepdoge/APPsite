<?php
ini_set('display_errors', 1);
// recuperer la session
session_start();

// verifier si l'utilisateur est connecté sinon le rediriger
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: pageAccueil.html");
    exit;
} else {
    header("location: accueilBox.php");
    exit;
}
?>