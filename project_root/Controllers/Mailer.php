<?php

/**
 * Mailer class voor het versturen van e-mails via PHPMailer.
 *
 * Functionaliteiten:
 * - Versturen van contactformulierberichten.
 * - Versturen van bestelbevestigingen na checkout.
 * - Valideren van formulierdata (naam, bedrijf, email, tel, bericht).
 * - Centrale configuratie via config.php.
 * - Meertalige fout- en succesmeldingen via vertaalkeys.
 *
 * Vereisten:
 * - PHPMailer via Composer.
 * - translator.php met init_translator().
 * - config.php met SMTP instellingen.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class Mailer
{
    /**
     * @var array Configuratie-instellingen uit config.php (SMTP)
     */
    private array $config;

    /**
     * @var object|null Optioneel vertaalobject voor meertalige meldingen
     */
    private $translator;

    /**
     * Constructor voor het initialiseren van de mailer met configuratie en optioneel een vertaler
     *
     * @param array $config SMTP-instellingen zoals host, user, port etc.
     * @param object|null $translator Vertaalobject voor het ophalen van vertaalde fout-/succesmeldingen
     */
    public function __construct(array $config, $translator = null)
    {
        $this->config = $config;
        $this->translator = $translator;
    }

    /**
     * Verwerkt en verstuurt een e-mail van het contactformulier
     *
     * @param array $data Formulierdata van de POST (naam, bedrijf, email, tel, bericht)
     * @return string Vertaalde succes- of foutmelding
     */
    public function sendContactMail(array $data): string
    {
        if (!$this->validateContactForm($data)) {
            return $this->translator?->get('contactpagina_formulier_error') ?? 'Ongeldige invoer.';
        }

        $mail = $this->prepareMailer($data['email'], $data['naam']);
        $mail->Subject = 'Fittingly contactformulier';
        $mail->Body = $this->buildContactBody($data);
        $mail->AltBody = strip_tags($mail->Body);

        // successKey en failKey worden gebruikt voor meertalige output
        return $this->tryToSend($mail, 'contactpagina_formulier_success', 'contactpagina_formulier_error');
    }

    /**
     * Verstuurt een bestelbevestiging naar de klant
     *
     * @param array $data Orderdata: naam, e-mail, orderId, artikelen, aantallen
     * @return bool True bij succes, false bij fout
     */
    public function sendOrderConfirmationMail(array $data): bool
    {
        $mail = $this->prepareMailer($data['email'], $data['name']);
        $mail->Subject = 'Bevestiging van uw bestelling';
        $mail->Body = $this->buildOrderBody($data);
        $mail->AltBody = strip_tags($mail->Body);

        return $this->tryToSend($mail) === true;
    }

    /**
     * Configureert een PHPMailer instantie met SMTP settings uit config.php
     *
     * @param string $toEmail E-mailadres van ontvanger
     * @param string $toName Naam van ontvanger
     * @return PHPMailer Volledig geconfigureerde mailer
     */
    private function prepareMailer(string $toEmail, string $toName): PHPMailer
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $this->config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $this->config['smtp_user'];
        $mail->Password = $this->config['smtp_pass'];
        $mail->SMTPSecure = $this->config['smtp_encryption'];
        $mail->Port = $this->config['smtp_port'];
        $mail->Timeout = 10;

        $mail->setFrom($this->config['from_email'], $this->config['from_name']);
        $mail->addBCC($this->config['from_email'], $this->config['from_name']);
        $mail->addAddress($toEmail, $toName);
        $mail->addReplyTo($toEmail, $toName);
        $mail->isHTML(true);

        return $mail;
    }

    /**
     * Probeert de e-mail te versturen en retourneert het resultaat
     *
     * - Als je keys meegeeft, wordt de vertaling opgehaald via $translator
     * - Als je geen keys meegeeft, krijg je gewoon true/false
     *
     * @param PHPMailer $mail Het mailobject dat verzonden wordt
     * @param string $successKey Vertaalkey bij succes (bijv. 'contactpagina_formulier_success')
     * @param string $failKey Vertaalkey bij fout (bijv. 'contactpagina_formulier_error')
     * @return string|bool Vertaalde melding of boolean resultaat
     */
    private function tryToSend(PHPMailer $mail, string $successKey = '', string $failKey = ''): string|bool
    {
        try {
            $mail->send();

            return $successKey
                ? ($this->translator?->get($successKey) ?? 'Verzonden.')
                : true;

        } catch (Exception $e) {
            error_log("Mail error: " . $mail->ErrorInfo);

            return $failKey
                ? ($this->translator?->get($failKey) ?? 'Fout bij verzenden.')
                : false;
        }
    }

    /**
     * Bouwt de HTML inhoud van de e-mail voor contactberichten
     *
     * @param array $data Gegevens uit het contactformulier
     * @return string HTML string voor in de mail
     */
    private function buildContactBody(array $data): string
    {
        return "
        <html>
        <body>
            <div style='font-family: Arial;'>
                <p><strong>Naam:</strong> {$data['naam']}</p>
                <p><strong>Bedrijf:</strong> {$data['bedrijf']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Telefoon:</strong> {$data['tel']}</p>
                <p><strong>Bericht:</strong><br><pre>{$data['bericht']}</pre></p>
            </div>
        </body>
        </html>";
    }

    /**
     * Bouwt de HTML inhoud van een bestelbevestiging
     *
     * @param array $data Ordergegevens (artikelen, hoeveelheden, klant)
     * @return string HTML string voor in de bevestigingsmail
     */
    private function buildOrderBody(array $data): string
    {
        $items = '';
        foreach ($data['articles'] as $article) {
            $qty = $data['quantities'][$article['ArticleID']] ?? 0;
            $items .= "<li>" . htmlspecialchars($article['Name']) . " ({$qty} stuks)</li>";
        }

        return "
        <html>
        <body>
            <h2>Bedankt voor uw bestelling!</h2>
            <p>Beste " . htmlspecialchars($data['name']) . ",</p>
            <p>Uw bestelling (Order ID: {$data['orderId']}) is succesvol geplaatst.</p>
            <p>Overzicht van uw bestelling:</p>
            <ul>{$items}</ul>
        </body>
        </html>";
    }

    /**
     * Valideert het contactformulier op verplichte velden en geldig e-mailadres
     *
     * @param array $data Ingevoerde data uit formulier
     * @return bool True als alles correct is ingevuld
     */
    private function validateContactForm(array $data): bool
    {
        foreach (['naam', 'bedrijf', 'email', 'tel', 'bericht'] as $key) {
            if (empty($data[$key])) return false;
        }

        return filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }
}
