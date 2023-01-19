<?php 
session_start();
//include libs
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor\autoload.php';

// Instantiate the PHPMailer class
$mail = new PHPMailer();

// recuperer les données post
$nature = $_POST['nature'];
$boxID = $_POST['quelbox'];
$probleme = $_POST['quelproblem'];
$commentaires = $_POST['commentaires'];


try {
    // setup des données serveurs
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'lm.szymko@gmail.com';                  // SMTP username
    $mail->Password   = 'tbtkhnmjjinpglxg';                     // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // destinataire et expediteur
    $mail->setFrom('lm.szymko@gmail.com', 'LabBox Team');
    $mail->addAddress('blep.doge@gmail.com', 'LabBox Team');     // Add a recipient

    // infos de l'email
    $mail->Subject = 'Demande de support rapide';
    $mail->Body    = "
    Un utilisateur a demandé de l'aide sur la plateforme LabBox.
    Voici les informations le concernant :
    Nom : ".$_SESSION['nomUser']."
    Prénom : ".$_SESSION['prenomUser']."
    E-mail : ".$_SESSION['emailUser']."
    ID du laboratoire rattaché : ".$_SESSION['idLabo']."

    La nature du problème est : $nature

    La box concernée est : $boxID

    Le problème rencontré est : $probleme
    
    Commentaires additionnels :
    $commentaires
    ";

    // Envoi du mail
    $mail->send();
    echo 'Message has been sent';
    header('Location: ContrôleBox.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>