<?php
class UserAccounts
{
    private $emailAddress;
    private $userPassword;
    private $accountStatus;
    private $accountAccessRights;
    private $dateOfRegistration;
    private $phoneNumber;
    private $newsletter;
    private $partnerID;
    private $customerID;
        

    public function __construct($emailAddress, $userPassword, $accountStatus, $accountAccessRights, $dateOfRegistration, $phoneNumber, $newsletter, $partnerID, $customerID){
        $this->emailAddress = $emailAddress;
        $this->userPassword = $userPassword;
        $this->accountStatus = $accountStatus;
        $this->accountAccessRights = $accountAccessRights;
        $this->dateOfRegistration = $dateOfRegistration;
        $this->phoneNumber = $phoneNumber;
        $this->newsletter = $newsletter;
        $this->partnerID = $partnerID;
        $this->customerID = $customerID;
    }

    function __toString(){
        return "Email: " . $this->emailAddress . ", Password: " . $this->userPassword . ", Account Status: " . $this->accountStatus . ", Access Rights: " . $this->accountAccessRights . ", Date of Registration: " . $this->dateOfRegistration . ", Phone Number: " . $this->phoneNumber . ", Newsletter: " . $this->newsletter . ", Partner ID: " . $this->partnerID . ", Customer ID: " . $this->customerID;
    }

    function getName(){
        return $this->name;
    }
    public function getPassword(){
        return password_hash($this->userPassword, PASSWORD_DEFAULT);
    }
    function checkPassword($userPassword){
        return password_verify($userPassword, $this->getPassword());
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