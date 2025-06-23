<?php
namespace Models;
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
    /**
     * @var string The unique ID of the customer.
     * @var string The first name of the customer.
     * @var string The last name of the customer.
     * @var string The date of birth of the customer.
     * @var string The postal code of the customer.
     * @var string The house number of the customer.
     * @var array Associative array containing all customer data.
     */
    private string $customerID;
    private string $firstName;
    private string $lastName;
    private string $dateOfBirth;
    private string $postalCode;
    private string $houseNumber;
    private array $customerInfo;
    
    /**
     * @var mixed CrudModel instance or null.
     */
    private $crudModel;

    /**
     * Customers constructor.
     *
     * @param string $customerID   The unique ID of the customer.
     * @param string $firstName    The first name of the customer.
     * @param string $lastName     The last name of the customer.
     * @param string $dateOfBirth  The date of birth of the customer.
     * @param string $postalCode   The postal code of the customer.
     * @param string $houseNumber  The house number of the customer.
     * @param mixed $crudModel     Optional CrudModel instance for database operations.
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

    /**
     * Placeholder for registering an account for the customer.
     *
     * @return void
     */
    public function registerAccount(){
        // placeholder
    }

    /**
     * Placeholder for verifying the customer's account.
     *
     * @return void
     */
    public function verifyAccount(){
        // placeholder
    }

    /**
     * Placeholder for changing the verification status of the customer.
     *
     * @return void
     */
    public function changeVerificationStatus(){
        // placeholder
    }

    /**
     * Placeholder for adding a person related to the customer.
     *
     * @return void
     */
    function addPerson(){
        // placeholder
    }
    
    /**
     * Placeholder for adding an account ID to the customer.
     *
     * @return void
     */
    function addAccountID(){
        // placeholder
    }

}