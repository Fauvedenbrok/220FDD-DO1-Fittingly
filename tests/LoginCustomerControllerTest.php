<?php
use PHPUnit\Framework\TestCase;
use Controllers\LoginCustomerController;
use Models\UserAccounts;
use Core\Session;

require_once __DIR__ . '/../project_root/Controllers/LoginCustomerController.php';
require_once __DIR__ . '/../project_root/Models/UserAccounts.php';
require_once __DIR__ . '/../project_root/Core/Session.php';

class LoginCustomerControllerTest extends TestCase
{
    public function testLoginWithEmptyFields(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'EmailAddress' => '',
            'UserPassword' => ''
        ];

        ob_start();
        $controller = new LoginCustomerController();
        $controller->login();
        $output = ob_get_clean();

        $this->assertStringContainsString('Vul alle velden in.', $output);
    }

    public function testLoginWithInvalidEmail(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'EmailAddress' => 'invalid-email',
            'UserPassword' => 'password123'
        ];

        ob_start();
        $controller = new LoginCustomerController();
        $controller->login();
        $output = ob_get_clean();

        $this->assertStringContainsString('Ongeldig e-mailadres.', $output);
    }


}
    