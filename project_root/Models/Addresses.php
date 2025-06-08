<?php
namespace Models;
use Models\CrudModel;
// use Core\DataBase;

require_once __DIR__ . '/CrudModel.php';

/**
 * Class Addresses
 *
 * Represents an address and provides methods to interact with the database.
 *
 * @package Models
 */
class Addresses
{

    private string $postalCode;
    private string $houseNumber;
    private string $streetName;
    private string $city;
    private string $country;
    private array $addressInfo;
     
    /**
     * Addresses constructor.
     *
     * @param string $postalCode   The postal code.
     * @param string $houseNumber  The house number.
     * @param string $streetName   The street name.
     * @param string $city         The city.
     * @param string $country      The country.
     */
    public function __construct(
        string $postalCode,
        string $houseNumber,
        string $streetName,
        string $city,
        string $country
    ) {
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetName = $streetName;
        $this->city = $city;
        $this->country = $country;
        $this->addressInfo = $this->createAssociativeArray();
    }

    /**
     * Creates an associative array of the address properties.
     *
     * @return array Associative array with address data.
     */
    public function createAssociativeArray(){
        $addressesArray = array(
            'PostalCode' => $this->postalCode,
            'HouseNumber' => $this->houseNumber,
            'StreetName' => $this->streetName,
            'City' => $this->city,
            'Country' => $this->country
        );
        return $addressesArray;
    }

    /**
     * Saves the address to the database using CrudModel.
     *
     * @return bool True on success, false on failure.
     */
    public function saveAddress(): bool {
        return CrudModel::createData("Addresses", $this->addressInfo);
        // $stmt = $this->db->prepare("
        //     INSERT INTO addresses (PostalCode, HouseNumber, StreetName, City, Country)
        //     VALUES (:postalCode, :houseNumber, :streetName, :city, :country)
        // ");

        // return $stmt->execute([
        //     ':postalCode' => $this->postalCode,
        //     ':houseNumber' => $this->houseNumber,
        //     ':streetName' => $this->streetName,
        //     ':city' => $this->city,
        //     ':country' => $this->country
        // ]);
    }
    
    /**
     * Returns a string representation of the address.
     *
     * @return string The address as a string.
     */
    function __toString(){
        return "$this->postalCode, $this->houseNumber, $this->streetName, $this->city, $this->country";
    }


}