<?php

/**
 * ContactMailer class en verwerking van contactformulier
 * 
 * Dit script verwerkt het contactformulier via POST, valideert en verstuurt de mail via PHPMailer.
 * 
 * Functionaliteiten:
 * - Initialiseren van ContactMailer met configuratie en vertaler.
 * - Valideren van formulierdata (naam, bedrijf, email, tel, bericht).
 * - Versturen van e-mail met PHPMailer (SMTP).
 * - Teruggeven van vertaalde succes- of foutmelding.
 * - Redirect na 5 seconden bij succesmelding.
 * 
 * Gebruik:
 * - Wordt aangeroepen na submit van contactformulier.
 * - Sanitize input met htmlspecialchars().
 * - Resultaat wordt ge-echo'd (bericht en redirect).
 * 
 * Vereisten:
 * - PHPMailer via Composer autoload.
 * - Translator functie init_translator().
 * - Configbestand met SMTP gegevens.
 * 
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

    /**
     * Constructor slaat configuratie en translator op voor later gebruik
     * 
     * @param array $config SMTP en mailconfiguratie
     * @param object $translator Vertaalfunctie object
     */
    public function __construct($config, $translator)
    {
        $this->config = $config;
        $this->translator = $translator;
    }

    /**
     * Validatie van formulierdata: controleert op lege velden en geldig emailadres
     * 
     * @param array $data Formulierdata
     * @return bool True als alles geldig, anders false
     */
    private function validate($data)
    {
        // Check of verplichte velden niet leeg zijn
        foreach (['naam', 'bedrijf', 'email', 'tel', 'bericht'] as $key) {
            if (empty($data[$key])) {
                return false;
            }
        }
        // Controleer of email valide is
        return filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }

    /**
     * Verstuurt de mail met PHPMailer, op basis van de data.
     * Retourneert vertaalde succes- of foutmelding.
     * 
     * @param array $data Formulierdata
     * @return string Vertaalde boodschap (succes/fout)
     */
    public function send($data)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP configuratie
            $mail->isSMTP();
            $mail->Host = $this->config['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->config['smtp_user'];
            $mail->Password = $this->config['smtp_pass'];
            $mail->SMTPSecure = $this->config['smtp_encryption'];
            $mail->Port = $this->config['smtp_port'];
            $mail->Timeout = 10;

            // Afzender en ontvanger instellen
            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $mail->addAddress($data['email'], $data['naam']); // E-mail naar de persoon die het formulier invulde
            $mail->addReplyTo($data['email'], $data['naam']); // Antwoordadres instellen

            // Mail content opmaken
            $mail->isHTML(true);
            $mail->Subject = 'Fittingly contactformulier';
            $mail->Body = $this->buildEmailBody($data); // HTML body
            $mail->AltBody = "Naam: {$data['naam']}\nBedrijf: {$data['bedrijf']}\nEmail: {$data['email']}\nTelefoon: {$data['tel']}\nBericht:\n{$data['bericht']}"; // Plain text body

            $mail->send();

            // Return succesbericht vertaling
            return $this->translator->get('contactpagina_formulier_success');
        } catch (Exception $e) {
            // Log foutmelding en return foutbericht vertaling
            error_log("PHPMailer fout: " . $mail->ErrorInfo);
            return $this->translator->get('contactpagina_formulier_error');
        }
    }

    /**
     * Bouwt de HTML body van de mail met de formulierdata
     * 
     * @param array $data Formulierdata
     * @return string HTML string van e-mail body
     */
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

// Verwerking van POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitizen van formulierdata (specialchars om XSS te voorkomen)
    $data = [
        'naam' => htmlspecialchars($_POST['naam']),
        'bedrijf' => htmlspecialchars($_POST['bedrijf']),
        'email' => htmlspecialchars($_POST['email']),
        'tel' => htmlspecialchars($_POST['tel']),
        'bericht' => htmlspecialchars($_POST['bericht']),
    ];

    // ContactMailer instantie maken en mail versturen
    $mailer = new ContactMailer($config, $translator);
    $result = $mailer->send($data);

    // Resultaat tonen
    echo $result;

    // Bij succes redirect na 5 seconden
    if ($result === $translator->get('contactpagina_formulier_success')) {
        echo '<meta http-equiv="refresh" content="5;url=../public_html/index.php">';
    }

    exit;

} else {
    // Geen POST, geen formulier ingediend
    echo $translator->get('contactpagina_formulier_no_post');
    exit;
}

