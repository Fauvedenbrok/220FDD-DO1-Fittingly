<?php
require_once __DIR__ . '/../public_html/Lang/translator.php';
$translator = init_translator();

require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$config = require __DIR__ . '/admin/includes/config.php';
#TODO array voor de verwachte velden

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = htmlspecialchars($_POST['naam']);
    $bedrijf = htmlspecialchars($_POST['bedrijf']);
    $email = htmlspecialchars($_POST['email']);
    $tel = htmlspecialchars($_POST['tel']);
    $bericht = htmlspecialchars($_POST['bericht']);

    #TODO  // functie met input array
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

        $mail->setFrom($config['from_email'], $config['from_name']);    // Sender
        $mail->addAddress($email, $naam);                               // Recipient
        $mail->addReplyTo($email, $naam);                               // Reply-To


        $mail->isHTML(true);
        $mail->Subject = 'Fittingly contactformulier';
        $mail->Body = "Naam: $naam\nBedrijf: $bedrijf\nEmail: $email\nTelefoon: $tel\nBericht: $bericht";

        $mail->send();
        echo $translator->get('contactpagina_formulier_success');
        exit;
    } catch (Exception $e) {
        echo $translator->get('contactpagina_formulier_error');
        error_log("PHPMailer fout: " . $mail->ErrorInfo);
        exit;
    }
    //
} else {
    echo $translator->get('contactpagina_formulier_no_post');
    exit;
}
