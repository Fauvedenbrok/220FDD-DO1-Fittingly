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

    public function __toString(){
        return "$this->customerID, $this->firstName, $this->lastName, $this->dateOfBirth, $this->postalCode, $this->houseNumber";
    }

    // prepared statement nog voor het toevoegen van een klant
    public function addCustomer($conn){
        $sql = "INSERT INTO customers (customerID, firstName, lastName, dateOfBirth, postalCode, houseNumber) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("isssss", $this->customerID, $this->firstName, $this->lastName, $this->dateOfBirth, $this->postalCode, $this->houseNumber);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
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