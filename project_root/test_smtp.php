<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/admin/includes/config.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_user'];
    $mail->Password = $config['smtp_pass'];
    $mail->SMTPSecure = $config['smtp_encryption'];
    $mail->Port = $config['smtp_port'];

    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Timeout = 10;

    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress('michadebruine@hotmail.com', 'Micha');

    $mail->Subject = 'Test SMTP verbinding';
    $mail->Body = 'Test bericht om SMTP verbinding te controleren.';

    $mail->send();
    echo 'Mail is verstuurd!';
} catch (Exception $e) {
    echo "Mail kon niet verzonden worden. Fout: {$mail->ErrorInfo}";
}
