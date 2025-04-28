<?php

class Addresses
{
    private $postalCode;
    private $country;
    private $city;
    private $streetName;
    private $houseNumber;

    public function __construct($postalCode, $houseNumber, $streetName, $city, $country){
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetName = $streetName;
        $this->city = $city;
        $this->country = $country;
    }
    function __toString(){
        return "$this->postalCode, $this->houseNumber, $this->streetName, $this->city, $this->country";
    }

    // prepared statement voor het toevoegen van een adres
    public function addAddress($conn){
        $sql = "INSERT INTO addresses (postalCode, houseNumber, streetName, city, country) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // sssss moet nog veranderd worden naar de juiste types
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("sssss", $this->postalCode, $this->houseNumber, $this->streetName, $this->city, $this->country);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}