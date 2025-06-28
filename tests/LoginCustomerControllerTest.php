<?php
// namespace Controllers;

// require_once __DIR__ . '/../Controllers/LoginCustomerController.php';

// use PHPUnit\Framework\TestCase;

// class LoginCustomerControllerTest extends TestCase
// {
//     public function testLoginWithEmptyFields(): void
//     {
//         $_SERVER['REQUEST_METHOD'] = 'POST';
//         $_POST = [
//             'EmailAddress' => '',
//             'UserPassword' => ''
//         ];

//         ob_start();
//         $controller = new LoginCustomerControllerTest();
//         $controller->login();
//         $output = ob_get_clean();

//         $this->assertStringContainsString('Vul alle velden in.', $output);
//     }

//     public function testLoginWithInvalidEmail(): void
//     {
//         $_SERVER['REQUEST_METHOD'] = 'POST';
//         $_POST = [
//             'EmailAddress' => 'invalid-email',
//             'UserPassword' => 'password123'
//         ];

//         ob_start();
//         $controller = new LoginCustomerControllerTest();
//         $controller->login();
//         $output = ob_get_clean();

//         $this->assertStringContainsString('Ongeldig e-mailadres.', $output);
//     }


// }
    