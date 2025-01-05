<?php
class Person
{
    private $name;
    private $phoneNumber;
    public $address;
    private $email;
    private $dateOfBirth;

    public function __construct($name, $phoneNumber, $email, $dateOfBirth,$address){
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
        $this->address = $address;
    }

    function __toString(){
            return "$this->name, $this->phoneNumber, $this->email, $this->dateOfBirth";
    }

function getAddress()
{
    return $this->address;
}
    function getName(){
        return $this->name;
    }
}