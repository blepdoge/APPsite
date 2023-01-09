<?php
// recuperer ou initaliser la session
session_start();
 
// Unset all of the session variables
session_unset();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: pageLogin.php");
exit;
?>