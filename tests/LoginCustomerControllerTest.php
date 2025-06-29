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

      
        $controller = new LoginCustomerController();
        $controller->login(true);
        $output = $_SESSION['login_error'];

        $this->assertStringContainsString('Vul alle verplichte velden in.', $output);
    }

    public function testLoginWithInvalidEmail(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'EmailAddress' => 'invalid-email',
            'UserPassword' => 'password123'
        ];


        $controller = new LoginCustomerController();
        $controller->login(true);
        $output = $_SESSION['login_error'];

        $this->assertStringContainsString('Ongeldig e-mailadres.', $output);
    }


}
    