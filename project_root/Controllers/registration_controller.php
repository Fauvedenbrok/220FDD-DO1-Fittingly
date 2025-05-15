<?php

namespace Controllers;
use Models\Addresses;
use Core\Validator;

class RegistrationController {
    public function register(): void{
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $_POST;

            $required = ['postalCode', 'houseNumber', 'streetName', 'city', 'country'];

            if (Validator::isEmpty($data, $required)) {
                echo "Vul alle velden in.";
                return;
            }

            $address = new Addresses(
                $data['postalCode'],
                $data['houseNumber'],
                $data['streetName'],
                $data['city'],
                $data['country']
            );

            if ($address->saveAddress()) {
                echo "Adres opgeslagen";
            } else {
                echo "Er ging iets mis bij het opslaan van het adres.";
            }
        }
    }
}