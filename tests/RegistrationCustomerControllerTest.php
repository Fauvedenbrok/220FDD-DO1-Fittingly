<?php

use PHPUnit\Framework\TestCase;
use Controllers\RegistrationCustomerController;
use Models\Addresses;
use Models\Customers;
use Models\UserAccounts;



include_once __DIR__ . '/../project_root/Controllers/RegistrationCustomerController.php';



class RegistrationCustomerControllerTest extends TestCase
{
    private $addresses;
    private $customers;
    private $userAccounts;

    protected function setUp(): void
    {
        $this->addresses = new Addresses('empty', 'empty', 'empty', 'empty', 'empty');
        $this->customers = new UserAccounts('empty', 'empty', 'empty', 'empty', 'empty', 'empty', 0, 0 , 'empty');
        $this->userAccounts = new Customers('empty', 'empty', 'empty', 'empty', 'empty', 'empty');
    }



    // public function setup(): void
    // {
    //     $_POST = [];
    //     $_SERVER['REQUEST_METHOD'] = 'POST';
    //     $this->addresses = $this->createMock(Addresses::class);
    //     $this->customers = $this->createMock(Customers::class);
    //     $this->userAccounts = $this->createMock(UserAccounts::class);
    // }

    public function testRegisterMissingFields(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'FirstName' => 'John',
            'LastName' => 'Doe',
            // Missing other required fields
        ];

        $controller = new RegistrationCustomerController();
        $controller->register();
        $output = $controller->message;

        
        $this->assertStringContainsString('Vul alle velden in.', $output);
    }

    public function testInvalidEmail(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'FirstName' => 'John',
            'LastName' => 'Doe',
            'EmailAddress' => 'invalid-email',
            'UserPassword' => 'password123',
            'DateOfBirth' => '2000-01-01',
            'PostalCode' => '1234AB',
            'HouseNumber' => '1',
            'StreetName' => 'Straatnaam',
            'City' => 'Amsterdam',
            'Country' => 'Nederland'
        ];

        $controller = new RegistrationCustomerController();
        $controller->register();
        $output = $controller->message;

        $this->assertStringContainsString('Ongeldig e-mailadres.', $output);
    }
}
