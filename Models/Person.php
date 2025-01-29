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

    // contructor met de variabele die nodig zijn bij het maken van een object van deze Klasse.
    public function __construct($name, $userName, $phoneNumber, $email, $dateOfBirth, $password, $address){
        $this->name = $name;
        $this->userName = $userName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
        $this->password = $password;
        $this->address = $address;
    }

    // Deze functie heeft een string als een return waarde. 
    // Deze functie wordt automatisch gebruikt zodra het object van deze Klasse wordt gezet in een echo().
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
    // De functie getPassword() heeft de returnwaarde van het gehashde wachtwoord. 
    // De $this->password is de waarde die is opgeslagen in de variabele $password.
    // De 'PASSWORD_DEFAULT' is een default algoritme van php. 
    public function getPassword(){
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
    // Deze functie wordt nog niet gebruikt maar deze controleerd of het ingevulde $password overeenkomt met het gehashde password. 
    // Hier is het belangrijke onderscheidt van $this-> te zien. 
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