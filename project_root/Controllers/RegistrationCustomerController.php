<?php

namespace Controllers;
use Models\Customers;
use Models\UserAccounts;
use Models\Addresses;
use Core\Validator;
use Core\Database;
use Ramsey\Uuid\Uuid;

require_once __DIR__ .  '/../Core/Validator.php';
require_once __DIR__ .  '/../Core/Database.php';
require_once __DIR__ .  '/../Models/UserAccounts.php';
require_once __DIR__ .  '/../Models/Addresses.php';
require_once __DIR__ .  '/../Models/Customers.php';
require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Class RegistrationCustomerController
 *
 * Handles the registration process for new customers.
 * - Validates input data from the registration form.
 * - Creates and saves address, customer, and user account records in the database.
 * - Uses transactions to ensure data consistency.
 */
class RegistrationCustomerController {

    public $message;

    /**
     * Handles the registration process for a new customer.
     *
     * - Validates required fields and email address.
     * - Begins a database transaction.
     * - Creates and saves address, customer, and user account objects.
     * - Rolls back the transaction and outputs an error message if any step fails.
     *
     * @return void
     */
    public function register(): void{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;

            $required = ['FirstName', 'LastName', 'EmailAddress', 'UserPassword', 'DateOfBirth', 'PostalCode', 'HouseNumber', 'StreetName', 'City', 'Country'];
            $validation = new Validator();
            if ($validation->isEmpty($data, $required)) {
                echo "Vul alle velden in.";
                $this->message = "Vul alle velden in.";
                return;
            }

            if (!$validation->isValidEmail($data['EmailAddress'])) {
                echo "Ongeldig e-mailadres.";
                $this->message = "Ongeldig e-mailadres.";
                return;
            }

            try {
                $db = Database::getConnection();
                $db->beginTransaction();

                /**
                 * Generate a unique customer ID using UUID.
                 * @var string $customerID The generated customer ID.
                 */
                $customerID = Uuid::uuid4()->toString();

                /**
                 * Create and save the address.
                 * @var Addresses $address The address object.
                 */
                $address = new Addresses(
                $data['PostalCode'],
                $data['HouseNumber'],
                $data['StreetName'],
                $data['City'],
                $data['Country']
                );

                
                if(!$address->saveAddress()){
                    throw new \Exception("Fout bij het opslaan van Address");
                }

                /**
                 * Create and save the customer.
                 * @var Customers $customer The customer object.
                 */
                $customer = new Customers(
                $customerID,
                $data['FirstName'],
                $data['LastName'],
                $data['DateOfBirth'],
                $data['PostalCode'],
                $data['HouseNumber']
                );

                if(!$customer->saveCustomer()){
                    throw new \Exception("Fout bij het opslaan van Customer");
                }

                /**
                 * Create and save the user account.
                 * @var UserAccounts $userAccount The user account object.
                 */
                $userAccount = new UserAccounts(
                $data['EmailAddress'],
                $data['UserPassword'],
                'pending',          // voorbeeld status
                'customer',         // voorbeeld access rights
                date('Y-m-d'),      // registratie datum vandaag
                $data['PhoneNumber'] ?? '',
                isset($data['newsletter']) ? 1 : 0,
                null,
                $customerID
                );

                if (!$userAccount->saveUserAccount()){
                    throw new \Exception("Fout bij het opslaan van een UserAccount");
                }

                $db->commit();
            } catch (\Exception $e){
                $db = Database::getConnection();
                $db->rollback();
                echo "Registratie mislukt: " . $e->getMessage();
                exit;
            }

        }
    }
    
}