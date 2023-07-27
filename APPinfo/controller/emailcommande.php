<?php
//include libs
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

// Instantiate the PHPMailer class
$mail = new PHPMailer();

// recuperer les données post
$name = $_POST['inputNom'];
$first_name = $_POST['prenom'];
$position = $_POST['poste'];
$email = $_POST['email'];
$lab_name = $_POST['nomLaboratoire'];
$lab_address = $_POST['adressePostale'];
$motivation = $_POST['msgMotiv'];

try {
    // setup des données serveurs
    $mail->SMTPDebug = 0; // 2 to Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'nohost'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'still nothing'; // SMTP username
    $mail->Password = 'nothing here'; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 999; // TCP port to connect to

    // destinataire et expediteur
    $mail->setFrom('sorsenteam@sorsen.site', 'LabBox Team');
    $mail->addAddress('testrecip', 'recipient'); // Add a recipient

    // infos de l'email
    $mail->Subject = 'LabBox Inquiry';
    $mail->Body = "
    Un nouveau laboratoire s'interesse à nous !
    Voici la fiche de contact associée.
    Nom : $name
    Prénom : $first_name
    Poste dans le laboratoire : $position
    E-mail : $email
    Nom du laboratoire : $lab_name
    Adresse postale du laboratoire : $lab_address
    
    Motivation :
    $motivation
    ";

    // Envoi du mail
    $mail->send();
    header('Location: ../views/pageCommande.php');

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
