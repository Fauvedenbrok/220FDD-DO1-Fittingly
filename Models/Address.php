<?php

class Address
{
    private $postalCode;
    private $country;
    private $city;
    private $streetName;
    private $streetNumber;
    private $streetNumberAppendix;

    public function __construct($postalCode, $streetName, $streetNumber, $streetNumberAppendix, $city, $country){
        $this->postalCode = $postalCode;
        $this->streetName = $streetName;
        $this->streetNumber = $streetNumber;
        $this->streetNumberAppendix = $streetNumberAppendix;
        $this->city = $city;
        $this->country = $country;
    }
    function __toString(){
        return "$this->postalCode, $this->streetName, $this->streetNumber, 
        $this->streetNumberAppendix, $this->city, $this->country";
    }

}