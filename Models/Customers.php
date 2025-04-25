<?php

class Customers
{

    private $customerID;
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $postalCode;
    private $houseNumber;



    public function __construct($customerID, $firstName, $lastName, $dateOfBirth, $postalCode, $houseNumber){
        $this->customerID = $customerID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
    }

    public function registerAccount(){
        // placeholder
    }

    public function verifyAccount(){
        // placeholder
    }

    public function changeVerificationStatus(){
        // placeholder
    }

    function addPerson(){
        // placeholder
    }
    function addAccountID(){
        // placeholder
    }

}