<?php

class Addresses
{
    private $postalCode;
    private $country;
    private $city;
    private $streetName;
    private $houseNumber;


    

    public function __construct($postalCode, $houseNumber, $streetNumber, $city, $country){
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->country = $country;
    }
    function __toString(){
        return "$this->postalCode, $this->houseNumber, $this->streetNumber, $this->city, $this->country";
    }

}