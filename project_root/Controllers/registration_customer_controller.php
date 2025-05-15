<?php

namespace Controllers;
use Models\Customers;
use Models\UserAccounts;
use Models\Addresses;
use Core\Validator;

require_once "../Core/validator.php";
require_once "../Core/db_handler.php";
require_once "../Models/UserAccounts.php";
require_once "../Models/Addresses.php";
require_once "../Models/Customers.php";

class RegistrationCustomerController {
    public function register(): void{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;

            $required = ['FirstName', 'LastName', 'EmailAddress', 'UserPassword', 'DateOfBirth', 'PostalCode', 'HouseNumber', 'StreetName', 'City', 'Country'];
            $validation = new Validator();
            if ($validation->isEmpty($data, $required)) {
                echo "Vul alle velden in.";
                return;
            }

            if (!$validation->isValidEmail($data['EmailAddress'])) {
                echo "Ongeldig e-mailadres.";
                return;
            }

            try {
                $db = \Core\Database::getConnection();
                $db->beginTransaction();

                $userAccount = new \Models\UserAccounts(
                $data['EmailAddress'],
                $data['UserPassword'],
                'pending',          // voorbeeld status
                'customer',         // voorbeeld access rights
                date('Y-m-d'),      // registratie datum vandaag
                $data['PhoneNumber'] ?? '',
                isset($data['newsletter']) ? 1 : 0,
                null,
                null
                );

                if (!$userAccount->saveUserAccount()){
                    throw new \Exception("Fout bij het opslaan van een UserAccount");
                }

                $address = new \Models\Addresses(
                $data['PostalCode'],
                $data['HouseNumber'],
                $data['StreetName'],
                $data['City'],
                $data['Country']
                );

                if(!$address->saveAddress()){
                    throw new \Exception("Fout bij het opslaan van Address");
                }

                $customer = new \Models\Customers(
                rand(10, 99999),
                $data['FirstName'],
                $data['LastName'],
                $data['DateOfBirth'],
                $data['PostalCode'],
                $data['HouseNumber']
                );

                if(!$customer->saveCustomer()){
                    throw new \Exception("Fout bij het opslaan van Customer");
                }

                $db->commit();
                echo "Registratie succesvol!";
            } catch (\Exception $e){
                $db = \Core\Database::getConnection();
                $db->rollback();
                echo "Registratie mislukt: " . $e->getMessage();
            }

        }
    }
}