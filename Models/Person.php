<?php
class Person
{
    private $name;
    private $userName;
    private $phoneNumber;
    public $address;
    private $email;
    private $dateOfBirth;
    private $password;

    public function __construct($name, $userName, $phoneNumber, $email, $dateOfBirth, $password, $address){
        $this->name = $name;
        $this->userName = $userName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
        $this->password = $password;
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
    public function getPassword(){
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    function checkPassword($password){
        return password_verify($password, $this->getPassword());
    }

    function calculateAge(){
        // placeholder
    }
    function addAddress(){
        // placeholder
    }
    function addPhoneNumber(){
        // placeholder
    }
    function changePassword(){
        // placeholder
    }
    function login(){
        // placeholder
    }
    function logout(){
        // placeholder
    }




}