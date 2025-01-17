<?php

class Customer
{
    private $accountID;
    private $rentalHistory = array();
    private $verificationStatus;
    private $message;
    private $accessRights;
    private $person;
    private $newsletter;

    public function __construct($person, $accessRights, $newsletter){
        $this->accountID = uniqid(rand(), true);
        $this->verificationStatus = false;
        $this->person = $person;
        $this->accessRights = $accessRights;
        $this->newsletter = $newsletter;
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