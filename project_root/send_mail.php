<?php

use Core\Database;
use Core\Validator;


require_once __DIR__ . '/Core/Validator.php';
require_once __DIR__ . '/../public_html/Lang/Translator.php';
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../public_html/Lang/Translator.php';

$translator = init_translator();


$mailconfig = require __DIR__ . '/./Controllers/MailDataController.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class SendMail
{

    private $smtp_host;
    private $smtp_user;
    private $smtp_pass;
    private $smtp_port;
    private $smtp_encryption;
    private $from_email;
    private $from_name;
    private $validator;
    private $translator;



    public function __construct()
    {
        $this->smtp_host = 'send.one.com';
        $this->smtp_user = 'info.fittingly@dumpvanplaatjes.nl';
        $this->smtp_pass = 'fittingly';
        $this->smtp_port = 587;
        $this->smtp_encryption = 'tls';
        $this->from_email = 'info.fittingly@dumpvanplaatjes.nl';
        $this->from_name = 'Fittingly';
        $this->validator = new Validator();
        $this->translator = init_translator();
    }


    public function buildMailToCustomer($name, array $data): string
    {
        $mail = $name . "<br><br>";
        foreach ($data as $key => $value) {
            $mail .= $key . ": " . $value . "<br>";
        };
        return $mail;
    }

    public function sendMailCustomer($email, $message, $subject)
    {
        $mail = new PHPMailer();

        try {
            // SMTP configuratie
            $mail->isSMTP();
            $mail->Host = $this->smtp_host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtp_user;
            $mail->Password = $this->smtp_pass;
            $mail->SMTPSecure = $this->smtp_encryption;
            $mail->Port = $this->smtp_port;

            //Mail set from
            $mail->setFrom($this->from_email, $this->from_name);
            $mail->addAddress($email, $this->from_name);

            //Mail HTML content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = "Dit is tekst wanneer HTML niet gegenereerd kan worden. (Screen reader)";

            $mail->send();

            //Return message
            return $this->translator->get('mail_sent_success');
        } catch (exception $e) {
            $log = $e->getMessage();
            return $this->translator->get('mail_sent_failure');
        }
    }
}

$result = $mail->sendMailCustomer($email, $message, $subject);
echo $result;
