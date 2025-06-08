<?php

use PHPUnit\Framework\TestCase;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../project_root/ContactMailer.php';


class ContactMailerTest extends TestCase
{
    private $translatorMock;
    protected function setUp(): void
    {
        // Maak hier de translator mock aan, met 'get' methode
        $this->translatorMock = $this->getMockBuilder(stdClass::class)
            ->addMethods(['get'])
            ->getMock();

        // Stel vaste return values in voor je vertalingen
        $this->translatorMock->method('get')->willReturnMap([
            ['contactpagina_formulier_success', 'Succesbericht'],
            ['contactpagina_formulier_error', 'Foutbericht'],
            ['contactpagina_formulier_no_post', 'Geen formulier ingediend'],
        ]);

        // Stel je dummy config hier in
        $this->config = [
            'smtp_host' => 'smtp.example.com',
            'smtp_user' => 'user',
            'smtp_pass' => 'pass',
            'smtp_encryption' => 'tls',
            'smtp_port' => 587,
            'from_email' => 'from@example.com',
            'from_name' => 'Test From',
        ];
    }

    public function testContactMailerCanBeInstantiated()
    {
        $mailer = new ContactMailer($this->config, $this->translatorMock);
        $this->assertInstanceOf(ContactMailer::class, $mailer);
    }


}