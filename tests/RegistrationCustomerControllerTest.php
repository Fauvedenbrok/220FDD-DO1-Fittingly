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
        $this->addresses = $this->createMock(Addresses::class);
        $this->customers = $this->createMock(Customers::class);
        $this->userAccounts = $this->createMock(UserAccounts::class);
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

        ob_start();
        $controller = new RegistrationCustomerController();
        $controller->register();
        $output = ob_get_clean();

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

        ob_start();
        $controller = new RegistrationCustomerController();
        $controller->register();
        $output = ob_get_clean();

        $this->assertStringContainsString('Ongeldig e-mailadres.', $output);
    }

    public function testSaveCustomerDetailsFails(): void
    {
        
        $_POST = [
            'FirstName' => 'John',
            'LastName' => 'Doe',
            'EmailAddress' => uniqid('test_', true) . '@email.com',
            'UserPassword' => 'password123',
            'DateOfBirth' => '2000-01-01',
            'PostalCode' => uniqid('PC'),
            'HouseNumber' => rand(1, 10000),
            'StreetName' => 'Straatnaam',
            'City' => 'Amsterdam',
            'Country' => 'Nederland'
        ];

        $addressesMock = $this->createMock(Addresses::class);
        $addressesMock->method('saveAddress')->willReturn(true);

        $customersMock = $this->createMock(Customers::class);
        $customersMock->method('saveCustomer')->willReturn(false);

        $userAccountsMock = $this->createMock(UserAccounts::class);
        $userAccountsMock->method('saveUserAccount')->willReturn(true);

        ob_start();
        $controller = new RegistrationCustomerController($addressesMock, $customersMock, $userAccountsMock);
        $controller->register();
        $output = ob_get_clean();

        $this->assertStringContainsString('Fout bij het opslaan van Customer', $output);
    }
}
