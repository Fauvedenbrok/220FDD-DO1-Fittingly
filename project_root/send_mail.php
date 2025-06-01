<?php
require_once __DIR__ . '/../public_html/Lang/translator.php';
$translator = init_translator();

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$config = require __DIR__ . '/admin/includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = htmlspecialchars($_POST['naam']);
    $bedrijf = htmlspecialchars($_POST['bedrijf']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $bericht = htmlspecialchars($_POST['bericht']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_user'];
        $mail->Password = $config['smtp_pass'];
        $mail->SMTPSecure = $config['smtp_encryption'];
        $mail->Port = $config['smtp_port'];

        $mail->Timeout = 10; // 10 seconden timeout

        $mail->setFrom($config['from_email'], $config['from_name']);      // jouw mailadres als afzender
        $mail->addAddress('michadebruine@hotmail.com', 'Micha');          // jouw mailadres als ontvanger
        $mail->addReplyTo($email, $naam);                                 // reply-to op het mailadres van de gebruiker


        $mail->isHTML(false);
        $mail->Subject = 'Fittingly contactformulier';
        $mail->Body = "Naam: $naam\nBedrijf: $bedrijf\nEmail: $email\nTelefoon: $tel\nBericht: $bericht";

        $mail->send();
<<<<<<< HEAD
        echo $translator->get('contactpagina_formulier_success');
=======
        // laat zien dat het bericht succesvol is verzonden en redirect naar de contactpagina
        header('Location: /contact.php?status=success');
>>>>>>> 1fa42cc2a50111639686833d47ab775bcf7519a0
        exit;
    } catch (Exception $e) {
        echo $translator->get('contactpagina_formulier_error');
        error_log("PHPMailer fout: " . $mail->ErrorInfo);
        exit;
    }
} else {
    echo $translator->get('contactpagina_formulier_no_post');
    exit;
}
