    <?php

    use Core\Database;
    use Core\Validator;


    require_once __DIR__ . '/Core/Validator.php';
    require_once __DIR__ . '/../public_html/Lang/translator.php';
    require __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../public_html/Lang/translator.php';

    $translator = init_translator();


    $mailconfig = require __DIR__ . '/./Controllers/MailDataController.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class SendMailToCustomers
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
        private $customerName;
        private $customers;

        public function __construct($name, $email, $data)
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

            $this->customerName = $name;
            foreach ($this->customers as $customer) {
                $name = $customer['name'];
                $email = $customer['email'];
            }
        }

        public function getAllCustomers()
        {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT DISTINCT `id`, `name`, `email` FROM customers");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buildMailToCustomer($name, array $data): string
        {
            $mail = $name . "<br><br>";
            foreach ($data as $key => $value) {
                $mail .= $key . ": " . $value . "<br>";
            };
            return $mail;
        }


        public function sendMailToCustomers($email, $message)
        {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = $this->smtp_host;
                $mail->SMTPAuth = true;
                $mail->Username = $this->smtp_user;
                $mail->Password = $this->smtp_pass;
                $mail->SMTPSecure = $this->smtp_encryption;
                $mail->Port = $this->smtp_port;

                //Recipients
                $mail->setFrom($this->from_email, $this->from_name);
                $mail->addAddress($email);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Fittingly Contactformulier';
                $mail->Body    = $message;

                // Send the email
                if ($mail->send()) {
                    echo "Email sent successfully to " . htmlspecialchars($email) . "<br>";
                } else {
                    echo "Email could not be sent to " . htmlspecialchars($email) . ". Error: " . htmlspecialchars($mail->ErrorInfo) . "<br>";
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }


        public function sendMail()
        {
            $customers = $this->getAllCustomers();
            foreach ($customers as $customer) {
                $name = $customer['name'];
                $email = $customer['email'];
                $message = $this->buildMailToCustomer($name, ['bericht' => 'Dit is een testbericht']);
                $this->sendMailToCustomers($email, $message);
            }
        }
    }
