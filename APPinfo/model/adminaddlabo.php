<?php 
if (isset($_POST['addlabo'])) {
    require_once "config.php";

    $nomlabo = $_POST['nomlabo'];
    $adresselabo = $_POST['adresselabo'];
    $emaillabo = $_POST['emaillabo'];

    $sql = "INSERT INTO laboratoires (nomLabo, adresseLabo, emailLabo)
    VALUES ('$nomlabo', '$adresselabo', '$emaillabo')";

    if ($link->query($sql) === TRUE) {
        echo "<script>alert(Laboratoire ajouté avec succès)</script>";
    } else {
        echo "<script>alert(Erreur: " . $sql . "<br>" . mysqli_error($link) . ")</script>";
    }

    $link->close();
    header("Location: ../views/sysadmin.php");
}

?>