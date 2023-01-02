<?php 
//tbtkhnmjjinpglxg
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'C:\Users\lmszy\Desktop\APP INFO\xampp\htdocs\APPinfo\vendor\autoload.php';

// Instantiate the PHPMailer class
$mail = new PHPMailer();

// Set up the form data
$name = $_POST['inputNom'];
$first_name = $_POST['prenom'];
$position = $_POST['poste'];
$email = $_POST['email'];
$lab_name = $_POST['nomLaboratoire'];
$lab_address = $_POST['adressePostale'];
$motivation = $_POST['msgMotiv'];

try {
    // Set up the server and sender information
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'lm.szymko@gmail.com';                  // SMTP username
    $mail->Password   = 'tbtkhnmjjinpglxg';                     // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // Set the recipient and sender
    $mail->setFrom('lm.szymko@gmail.com', 'LabBox Inquiry');
    $mail->addAddress('blep.doge@gmail.com', 'LabBox Team');     // Add a recipient

    // Set the email subject and body
    $mail->Subject = 'LabBox Inquiry';
    $mail->Body    = "
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

    // Send the email
    $mail->send();
    echo 'Message has been sent';
    header('Location: pageCommande.html');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>