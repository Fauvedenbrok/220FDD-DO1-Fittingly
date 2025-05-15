<?php
namespace Models;
use PDO;
use Core\Database;

class Customers
{

    private int $customerID;
    private string $firstName;
    private string $lastName;
    private string $dateOfBirth;
    private string $postalCode;
    private string $houseNumber;
    private PDO $db;



    public function __construct(
        int $customerID,
        string $firstName,
        string $lastName,
        string $dateOfBirth,
        string $postalCode,
        string $houseNumber
    ) {
        $this->db = Database::getConnection();

        $this->customerID = $customerID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
    }

    public function __toString(){
        return "$this->customerID, $this->firstName, $this->lastName, $this->dateOfBirth, $this->postalCode, $this->houseNumber";
    }

    public function saveCustomer(): bool {
        $stmt = $this->db->prepare("
            INSERT INTO customers (customerID, firstName, lastName, dateOfBirth, postalCode, houseNumber)
            VALUES (:customerID, :firstName, :lastName, :dateOfBirth, :postalCode, :houseNumber)");

        return $stmt->execute([
            ':customerID' => $this->customerID,
            ':firstName' => $this->firstName,
            ':lastName' => $this->lastName,
            ':dateOfBirth' => $this->dateOfBirth,
            ':postalCode' => $this->postalCode,
            ':houseNumber' => $this->houseNumber
        ]);
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