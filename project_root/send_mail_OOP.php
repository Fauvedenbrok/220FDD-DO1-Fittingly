<?php

/**
* ContactMailer class
*
* Deze klasse handelt het verzenden van contactformulieren af via e-mail met behulp van PHPMailer.
*
* Functionaliteiten:
* - Initialisatie met configuratie en vertaler.
* - Versturen van een e-mail met de gegevens uit het contactformulier.
* - Retourneert een vertaald succes- of foutbericht op basis van het resultaat.
*
* Belangrijke methoden:
* - __construct($config, $translator): Slaat de configuratie en vertaler op voor later gebruik.
* - send($data): Verstuurt een e-mail met de opgegeven data. Retourneert een vertaald succes- of foutbericht.
*
* Gebruik:
* - Wordt aangeroepen wanneer het contactformulier via POST wordt verzonden.
* - De ingevoerde gegevens worden gesanitized en doorgegeven aan de send-methode.
* - Bij succes of fout wordt een passend vertaald bericht teruggegeven.
*
* Foutafhandeling:
* - Bij fouten tijdens het verzenden wordt de fout gelogd en een foutmelding getoond aan de gebruiker.

*/

require_once __DIR__ . '/../public_html/Lang/translator.php';
require __DIR__ . '/../vendor/autoload.php';

$translator = init_translator();
$config = require __DIR__ . '/admin/includes/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactMailer
{
    private $config;
    private $translator;

    public function __construct($config, $translator)
    {
        $this->config = $config;
        $this->translator = $translator;
    }

    private function validate($data)
    {
        foreach (['naam', 'bedrijf', 'email', 'tel', 'bericht'] as $key) {
            if (empty($data[$key]))
                return false;
        }

        return filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }

    public function send($data)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $this->config['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->config['smtp_user'];
            $mail->Password = $this->config['smtp_pass'];
            $mail->SMTPSecure = $this->config['smtp_encryption'];
            $mail->Port = $this->config['smtp_port'];
            $mail->Timeout = 10;

            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $mail->addAddress($data['email'], $data['naam']);
            $mail->addReplyTo($data['email'], $data['naam']);

            $mail->isHTML(true);
            $mail->Subject = 'Fittingly contactformulier';
            $mail->Body = $this->buildEmailBody($data);
            $mail->AltBody = "Naam: {$data['naam']}\nBedrijf: {$data['bedrijf']}\nEmail: {$data['email']}\nTelefoon: {$data['tel']}\nBericht:\n{$data['bericht']}";

            $mail->send();
            return $this->translator->get('contactpagina_formulier_success');
        } catch (Exception $e) {
            error_log("PHPMailer fout: " . $mail->ErrorInfo);
            return $this->translator->get('contactpagina_formulier_error');
        }
    }

    private function buildEmailBody(array $data): string
    {
        return "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                }
                .container {
                    padding: 20px;
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                    border-radius: 6px;
                    max-width: 600px;
                }
                .field {
                    margin-bottom: 12px;
                }
                .label {
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='field'><span class='label'>Naam:</span> {$data['naam']}</div>
                <div class='field'><span class='label'>Bedrijf:</span> {$data['bedrijf']}</div>
                <div class='field'><span class='label'>Email:</span> {$data['email']}</div>
                <div class='field'><span class='label'>Telefoon:</span> {$data['tel']}</div>
                <div class='field'><span class='label'>Bericht:</span><br><pre>{$data['bericht']}</pre></div>
            </div>
        </body>
        </html>
    ";
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'naam' => htmlspecialchars($_POST['naam']),
        'bedrijf' => htmlspecialchars($_POST['bedrijf']),
        'email' => htmlspecialchars($_POST['email']),
        'tel' => htmlspecialchars($_POST['tel']),
        'bericht' => htmlspecialchars($_POST['bericht']),
    ];

    $mailer = new ContactMailer($config, $translator);
    echo $mailer->send($data);
    exit;
} else {
    echo $translator->get('contactpagina_formulier_no_post');
    exit;
}

