<?php

class Account
{
    private $id;
    private $loginData;
    private $rentalHistory = array();
    private $verificationStatus;
    private $person;
    private $accountType;
    private $newsletter;

    public function __construct($loginData, $person, $accountType, $newsletter){
        $this->id = uniqid(rand(), true);
        $this->loginData = $loginData;
        $this->verificationStatus = false;
        $this->person = $person;
        $this->accountType = $accountType;
        $this->newsletter = $newsletter;
    }

    public function registerAccount(){
        //placeholder
    }

    public function sendVerification(){
        // send verification link
    }

    public function validateAccount(){
        // if link is clicked (set to true)
    }

    function addRental(){
        // adds a rental to rental history
    }

}