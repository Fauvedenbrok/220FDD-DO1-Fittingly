<?php

namespace Models;
use Models\CrudModel;

require_once __DIR__ . "/CrudModel.php";

/**
 * Class UserAccounts
 *
 * Represents a user account and provides methods to interact with the database.
 *
 * @package Models
 */
class UserAccounts
{
    /**
     * @var string The email address of the user.
     * @var string The password of the user (hashed or plain before hashing).
     * @var string The status of the user account (e.g., active, inactive).
     * @var string The access rights of the user account.
     * @var string The date when the user registered.
     * @var string The phone number of the user.
     * @var bool Indicates if the user is subscribed to the newsletter.
     * @var int|null The ID of the partner associated with the user, if any.
     * @var string|null The ID of the customer associated with the user, if any.
     * @var array Associative array containing all user account data.
     */
    private string $emailAddress;
    private string $userPassword;
    private string $accountStatus;
    private string $accountAccessRights;
    private string $dateOfRegistration;
    private string $phoneNumber;
    private bool $newsletter;
    private ?int $partnerID;
    private ?string $customerID;
    private array $userInfo;
    
    /**
     * @var mixed CrudModel instance or null.
     */
    private $crudModel;

    /**
     * UserAccounts constructor.
     *
     * @param string $emailAddress          The email address of the user.
     * @param string $userPassword          The password of the user.
     * @param string $accountStatus         The status of the user account (e.g., active, inactive).
     * @param string $accountAccessRights   The access rights of the user account.
     * @param string $dateOfRegistration    The date when the user registered.
     * @param string $phoneNumber           The phone number of the user.
     * @param int $newsletter               Indicates if the user is subscribed to the newsletter (1 for yes, 0 for no).
     * @param int|null $partnerID           The ID of the partner associated with the user, if any.
     * @param string|null $customerID       The ID of the customer associated with the user, if any.
     * @param mixed $crudModel              Optional CrudModel instance for database operations.
     */
    public function __construct(
        string $emailAddress,
        string $userPassword,
        string $accountStatus,
        string $accountAccessRights,
        string $dateOfRegistration,
        string $phoneNumber,
        int $newsletter,
        ?int $partnerID,
        ?string $customerID,
        $crudModel = null
    ) {
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
        $this->crudModel = $crudModel ?? new CrudModel();
    }
    /**
     * Returns a string representation of the user account.
     *
     * @return string
     */
    function __toString()
    {
        return "Email: " . $this->emailAddress . ", Password: " . $this->userPassword . ", Account Status: " . $this->accountStatus . ", Access Rights: " . $this->accountAccessRights . ", Date of Registration: " . $this->dateOfRegistration . ", Phone Number: " . $this->phoneNumber . ", Newsletter: " . $this->newsletter . ", Partner ID: " . $this->partnerID . ", Customer ID: " . $this->customerID;
    }
    /**
     * Sets the customer ID for the user account.
     *
     * @param string $id The customer ID to set.
     * @return void
     */
    public function setCustomerID($id)
    {
        $this->customerID = $id;
        $this->userInfo['customerID'] = $id;
    }

    /**
     * Creates an associative array of the user account properties.
     * Hashes the password if it is not already hashed.
     *
     * @return array Associative array with user account data.
     */
    public function createAssociativeArray(): array
    {
        $password = $this->userPassword;

        // Only hash if not already hashed (bcrypt hash is 60 chars and starts with $2)
        if (!(strlen($password) === 60 && str_starts_with($password, '$2'))) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        }
        $userArray = array(
            'EmailAddress' => $this->emailAddress,
            'UserPassword' => $password,
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
    /**
     * Saves the user account to the database using CrudModel.
     *
     * @return bool True on success, false on failure.
     */
    public function saveUserAccount(): bool
    {
        return ($this->crudModel)::createData("useraccounts", $this->userInfo);
    }
    /**
     * Retrieves a user account by email address.
     *
     * @param string $email The email address to search for.
     * @return array|null The user account data if found, null otherwise.
     */
    public static function getUserAccountByEmail(string $email): ?array
    {
        $db = \Core\Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM useraccounts WHERE EmailAddress = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user ?: null;
    }
    /**
     * Retrieves the user's first name based on the session data.
     *
     * @return string|null The first name of the user if found, null otherwise.
     */
    public static function getUserNameBySession(): ?string
    {
        $crudModel = new CrudModel();
        if (!isset($_SESSION['user_email'])) {
            return null;
        }
        $email = $_SESSION['user_email'];
        // Step 1: Retrieve user account
        
        $user = $crudModel::readAllById('useraccounts', 'EmailAddress', $email);
        if (!$user || !isset($user['CustomerID'])) {
            return null;
        }
        $customerID = $user['CustomerID'];
        // Step 2: Retrieve customer from customers table
        $customer = $crudModel::readAllById('customers', 'CustomerID', $customerID);
        if (!$customer || !isset($customer['FirstName'])) {
            return null;
        }
        // Adjust 'FirstName' if your column is named differently
        return $customer['FirstName'];
    }
    /**
     * Retrieves the user's email address.
     *
     * @return string The email address of the user.
     */
    public function getUserEmail(): string
    {
        return $this->emailAddress;
    }

}
