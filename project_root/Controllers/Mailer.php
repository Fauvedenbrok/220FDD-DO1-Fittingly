<?php

/**
 * Mailer class for sending emails via PHPMailer.
 *
 * Features:
 * - Sending contact form messages.
 * - Sending order confirmations after checkout.
 * - Validating form data (name, company, email, phone, message).
 * - Central configuration via config.php.
 * - Multilingual error and success messages via translation keys.
 *
 * Requirements:
 * - PHPMailer via Composer.
 * - Translator.php with init_translator().
 * - config.php with SMTP settings.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Class Mailer
 *
 * Handles the creation and sending of emails for contact forms and order confirmations.
 */
class Mailer
{
    /**
     * @var array Configuration settings from config.php (SMTP)
     */
    private array $config;

    /**
     * @var object|null Optional translator object for multilingual messages
     */
    private $translator;

    /**
     * Constructor for initializing the mailer with configuration and an optional translator.
     *
     * @param array $config SMTP settings such as host, user, port, etc.
     * @param object|null $translator Translator object for retrieving translated error/success messages
     */
    public function __construct(array $config, $translator = null)
    {
        $this->config = $config;
        $this->translator = $translator;
    }

    /**
     * Processes and sends an email from the contact form.
     *
     * @param array $data Form data from POST (name, company, email, phone, message)
     * @return string Translated success or error message
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

        // successKey and failKey are used for multilingual output
        return $this->tryToSend($mail, 'contactpagina_formulier_success', 'contactpagina_formulier_error');
    }

    /**
     * Sends an order confirmation to the customer.
     *
     * @param array $data Order data: name, email, orderId, articles, quantities
     * @return bool True on success, false on failure
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
     * Configures a PHPMailer instance with SMTP settings from config.php.
     *
     * @param string $toEmail Recipient's email address
     * @param string $toName Recipient's name
     * @return PHPMailer Fully configured mailer
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
     * Attempts to send the email and returns the result.
     *
     * - If keys are provided, the translation is retrieved via $translator.
     * - If no keys are provided, returns true/false.
     *
     * @param PHPMailer $mail The mail object to be sent
     * @param string $successKey Translation key for success (e.g., 'contactpagina_formulier_success')
     * @param string $failKey Translation key for failure (e.g., 'contactpagina_formulier_error')
     * @return string|bool Translated message or boolean result
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
     * Builds the HTML content of the email for contact messages.
     *
     * @param array $data Data from the contact form
     * @return string HTML string for the email body
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
     * Builds the HTML content of an order confirmation email.
     *
     * @param array $data Order details (articles, quantities, customer)
     * @return string HTML string for the confirmation email
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
     * Validates the contact form for required fields and a valid email address.
     *
     * @param array $data Input data from the form
     * @return bool True if all fields are correctly filled in
     */
    private function validateContactForm(array $data): bool
    {
        foreach (['naam', 'bedrijf', 'email', 'tel', 'bericht'] as $key) {
            if (empty($data[$key])) return false;
        }

        return filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    }
}
