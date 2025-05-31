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
    private ?string $customerID;
    private PDO $db;

        

    public function __construct(
        string $emailAddress,
        string $userPassword,
        string $accountStatus,
        string $accountAccessRights,
        string $dateOfRegistration,
        string $phoneNumber,
        int $newsletter,
        ?int $partnerID,
        ?string $customerID
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

    }

    function __toString(){
        return "Email: " . $this->emailAddress . ", Password: " . $this->userPassword . ", Account Status: " . $this->accountStatus . ", Access Rights: " . $this->accountAccessRights . ", Date of Registration: " . $this->dateOfRegistration . ", Phone Number: " . $this->phoneNumber . ", Newsletter: " . $this->newsletter . ", Partner ID: " . $this->partnerID . ", Customer ID: " . $this->customerID;
    }

    public function setCustomerID($id){
        $this->customerID = $id;
        $this->userInfo['customerID'] = $id;
    }

    public static function getUserAccountByEmail(string $email): ?array {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM useraccounts WHERE emailAddress = :emailAddress");
        $stmt->execute([':emailAddress' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function saveUserAccount(): bool {
    $db = \Core\Database::getConnection();
    $stmt = $db->prepare("INSERT INTO useraccounts 
        (emailAddress, userPassword, accountStatus, accountAccessRights, dateOfRegistration, phoneNumber, newsletter, partnerID, customerID)
        VALUES (:emailAddress, :userPassword, :accountStatus, :accountAccessRights, :dateOfRegistration, :phoneNumber, :newsletter, :partnerID, :customerID)");
    return $stmt->execute([
        ':emailAddress' => $this->emailAddress,
        ':userPassword' => password_hash($this->userPassword, PASSWORD_DEFAULT),
        ':accountStatus' => $this->accountStatus,
        ':accountAccessRights' => $this->accountAccessRights,
        ':dateOfRegistration' => $this->dateOfRegistration,
        ':phoneNumber' => $this->phoneNumber,
        ':newsletter' => $this->newsletter,
        ':partnerID' => $this->partnerID,
        ':customerID' => $this->customerID
    ]);
}


}