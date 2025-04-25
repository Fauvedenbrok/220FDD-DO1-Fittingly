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

}