<?php

class Address
{
    private $postalCode;
    private $country;
    private $city;
    private $streetName;
    private $streetNumber;
    private $streetNumberAppendix;
<<<<<<< HEAD
=======

>>>>>>> 32aa7be1b424362c40c1b88aae8f75ebdae399a9
    

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