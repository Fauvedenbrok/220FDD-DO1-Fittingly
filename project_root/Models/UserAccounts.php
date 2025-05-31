<?php
namespace Models;
// use PDO;
// use Core\Database;
use Models\CrudModel;

class UserAccounts
{
    private string $emailAddress;
    private string $userPassword;
    private string $accountStatus;
    private string $accountAccessRights;
    private string $dateOfRegistration;
    private string $phoneNumber;
    private bool $newsletter;
    private ?int $partnerID;
    private ?int $customerID;
    private array $userInfo;
    // private PDO $db;
        

    public function __construct(
        string $emailAddress,
        string $userPassword,
        string $accountStatus,
        string $accountAccessRights,
        string $dateOfRegistration,
        string $phoneNumber,
        int $newsletter,
        ?int $partnerID,
        ?int $customerID
    ) {
        // $this->db = Database::getConnection();

        $this->emailAddress = $emailAddress;
        $this->userPassword = $userPassword;
        $this->accountStatus = $accountStatus;
        $this->accountAccessRights = $accountAccessRights;
        $this->dateOfRegistration = $dateOfRegistration;
        $this->phoneNumber = $phoneNumber;
        $this->newsletter = $newsletter;
        $this->partnerID = $partnerID;
        $this->customerID = $customerID;
        $this->userInfo = $this->createAssociativeArray();
    }

    function __toString(){
        return "Email: " . $this->emailAddress . ", Password: " . $this->userPassword . ", Account Status: " . $this->accountStatus . ", Access Rights: " . $this->accountAccessRights . ", Date of Registration: " . $this->dateOfRegistration . ", Phone Number: " . $this->phoneNumber . ", Newsletter: " . $this->newsletter . ", Partner ID: " . $this->partnerID . ", Customer ID: " . $this->customerID;
    }

    public function setCustomerID($id){
        $this->customerID = $id;
        $this->userInfo['customerID'] = $id;
    }

    public function createAssociativeArray(): array {
        $userArray = array(
            'EmailAddress' => $this->emailAddress,
            'UserPassword' => password_hash($this->userPassword, PASSWORD_DEFAULT),
            'AccountStatus' => $this->accountStatus,
            'AccountAccessRights' => $this->accountAccessRights,
            'DateOfRegistration' => $this->dateOfRegistration,
            'PhoneNumber' => $this->phoneNumber,
            'Newsletter' => $this->newsletter,
            'PartnerID' => $this->partnerID,
            'CustomerID' => $this->customerID
        );
        return $userArray;
    }

    public function saveUserAccount(): bool {
        return CrudModel::createData("useraccounts", $this->userInfo);
    }
    // prepared statement nog voor het toevoegen van een account
    // public function saveUserAccount(): bool {
    //     $stmt = $this->db->prepare("
    //         INSERT INTO useraccounts (emailAddress, userPassword, accountStatus, accountAccessRights, dateOfRegistration, phoneNumber, newsletter, partnerID, customerID)
    //         VALUES (:emailAddress, :userPassword, :accountStatus, :accountAccessRights, :dateOfRegistration, :phoneNumber, :newsletter, :partnerID, :customerID)
    //     ");

    //     return $stmt->execute([
    //         ':emailAddress' => $this->emailAddress,
    //         ':userPassword' => password_hash($this->userPassword, PASSWORD_DEFAULT),
    //         ':accountStatus' => $this->accountStatus,
    //         ':accountAccessRights' => $this->accountAccessRights,
    //         ':dateOfRegistration' => $this->dateOfRegistration,
    //         ':phoneNumber' => $this->phoneNumber,
    //         ':newsletter' => $this->newsletter,
    //         ':partnerID' => $this->partnerID,
    //         ':customerID' => $this->customerID
    //     ]);
    // }

    // function getName(){
    //     return $this->name;
    // }
    // public function getPassword(){
    //     return password_hash($this->userPassword, PASSWORD_DEFAULT);
    // }
    // function checkPassword($userPassword){
    //     return password_verify($userPassword, $this->getPassword());
    // }

    // function calculateAge(){
    //     // placeholder
    // }
    // function addAddress(){
    //     // placeholder
    // }
    // function addPhoneNumber(){
    //     // placeholder
    // }
    // function changePassword(){
    //     // placeholder
    // }
    // function login(){
    //     // placeholder
    // }
    // function logout(){
    //     // placeholder
    // }




}