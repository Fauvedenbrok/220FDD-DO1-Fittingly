<?php

namespace Controllers;
use Models\Customers;
use Models\UserAccounts;
use Models\Addresses;
use Core\Validator;

class RegistrationCustomerController {
    public function register(): void{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;

            $required = ['FirstName', 'LastName', 'EmailAddress', 'UserPassword', 'DateOfBirth', 'PostalCode', 'HouseNumber', 'StreetName', 'City', 'Country'];

            if (Validator::isEmpty($data, $required)) {
                echo "Vul alle velden in.";
                return;
            }

            if (!Validator::isValidEmail($data['EmailAddress'])) {
                echo "Ongeldig e-mailadres.";
                return;
            }

            try {
                $db = \Core\Database::getConnection();
                $db = beginTransaction();

                $userAccount = new Models\UserAccount(
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

                $customer = new Models\Customer(
                null,
                $data['FirstName'],
                $data['LastName'],
                $data['DateOfBirth'],
                $data['PostalCode'],
                $data['HouseNumber']
                );

                if(!$customer->saveCustomer()){
                    throw new \Exception("Fout bij het opslaan van Customer");
                }

                $address = new Addresses(
                $data['postalCode'],
                $data['houseNumber'],
                $data['streetName'],
                $data['city'],
                $data['country']
                );

                if(!$address->saveAddress()){
                    throw new \Exception("Fout bij het opslaan van Address");
                }

                $db->commit();
                echo "Registratie succesvol!";
            } catch (\Exception $e){
                $db->rollback();
                echo "Registratie mislukt: " . $e->getMessage();
            }

        }
    }
    
}