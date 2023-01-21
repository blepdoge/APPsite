<?php 
if (isset($_POST['adduser'])) {
    require_once "config.php";

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $idlaboratoire = $_POST['idlaboratoire'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $password = $_POST['password'];
    $statut = $_POST['statut'];

    $passwordhash= password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (prenom, nom, laboratoires_idlaboratoires, email, adresse, password, adminPerm)
    VALUES ('$prenom', '$nom', '$idlaboratoire', '$email', '$adresse', '$passwordhash', '$statut')";

    if ($link->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }

    $link->close();
}
?>