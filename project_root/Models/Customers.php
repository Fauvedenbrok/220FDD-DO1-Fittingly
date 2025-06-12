<?php
namespace Models;
// use PDO;
// use Core\Database;
use CrudModel;

require_once __DIR__ . '/CrudModel.php';

/**
 * Class Customers
 *
 * Represents a customer and provides methods to interact with the database.
 *
 * @package Models
 */
class Customers
{

    private string $customerID;
    private string $firstName;
    private string $lastName;
    private string $dateOfBirth;
    private string $postalCode;
    private string $houseNumber;
    private array $customerInfo;
    
    private $crudModel;
    // private PDO $db;

    /**
     * Customers constructor.
     *
     * @param string $customerID   The unique ID of the customer.
     * @param string $firstName    The first name of the customer.
     * @param string $lastName     The last name of the customer.
     * @param string $dateOfBirth  The date of birth of the customer.
     * @param string $postalCode   The postal code of the customer.
     * @param string $houseNumber  The house number of the customer.
     */
    public function __construct(
        string $customerID,
        string $firstName,
        string $lastName,
        string $dateOfBirth,
        string $postalCode,
        string $houseNumber,
        $crudModel = null
    ) {
        // $this->db = Database::getConnection();

        $this->customerID = $customerID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->customerInfo = $this->createAssociativeArray();
        $this->crudModel = $crudModel ?? new \Models\CrudModel();
    }

    /**
     * Returns a string representation of the customer.
     *
     * @return string
     */
    public function __toString(){
        return "$this->customerID, $this->firstName, $this->lastName, $this->dateOfBirth, $this->postalCode, $this->houseNumber";
    }

    /**
     * Creates an associative array of the customer properties.
     *
     * @return array Associative array with customer data.
     */
    public function createAssociativeArray(): array {
        $customerArray = array(
            'CustomerID' => $this->customerID,
            'FirstName' => $this->firstName,
            'LastName' => $this->lastName,
            'DateOfBirth' => $this->dateOfBirth,
            'PostalCode' => $this->postalCode,
            'HouseNumber' => $this->houseNumber
        );
        return $customerArray;
    }

    /**
     * Saves the customer to the database using CrudModel.
     *
     * @return bool True on success, false on failure.
     */
    public function saveCustomer(): bool {
        return ($this->crudModel)::createData("customers", $this->customerInfo);
    }


    // public function saveCustomer(): bool {
    //     $stmt = $this->db->prepare("
    //         INSERT INTO customers (customerID, firstName, lastName, dateOfBirth, postalCode, houseNumber)
    //         VALUES (:customerID, :firstName, :lastName, :dateOfBirth, :postalCode, :houseNumber)");

    //     return $stmt->execute([
    //         ':customerID' => $this->customerID,
    //         ':firstName' => $this->firstName,
    //         ':lastName' => $this->lastName,
    //         ':dateOfBirth' => $this->dateOfBirth,
    //         ':postalCode' => $this->postalCode,
    //         ':houseNumber' => $this->houseNumber
    //     ]);
    // }

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