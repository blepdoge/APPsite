<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
// Connexion a notre bdd
require_once "config.php";


if(isset($_POST["deleteBox"])){
    
    $query = "DELETE FROM labboxtable WHERE nomBox = '".$_SESSION["oldName"]."' AND laboratoires_idlaboratoires = '" . $_SESSION["idLabo"] . "'";
  error_log("Query: " . $query);
    mysqli_query($link, $query);
    error_log("Query result: " . $query);
    echo "<h1>La box a bien été supprimée</h1>";
    mysqli_close($link);
    
}


?>