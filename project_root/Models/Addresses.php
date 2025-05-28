<?php
namespace Models;
use Models\CrudModel;
// use Core\DataBase;

require_once __DIR__ . '/CrudModel.php';

class Addresses
{

    // private PDO $db;

    private string $postalCode;
    private string $houseNumber;
    private string $streetName;
    private string $city;
    private string $country;
    private $addressInfo;
     
    public function __construct(
        string $postalCode,
        string $houseNumber,
        string $streetName,
        string $city,
        string $country
    ) {
        // $this->db = Database::getConnection();

        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetName = $streetName;
        $this->city = $city;
        $this->country = $country;
        $this->addressInfo = $this->createAssociativeArray();
    }

    public function createAssociativeArray(){
        $addressesArray = array(
            'PostalCode' => $this->postalCode,
            'HouseNumber' => $this->houseNumber,
            'StreetName' => $this->streetName,
            'City' => $this->city,
            'Country' => $this->country,
        );
        return $addressesArray;
    }

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
    
    // function __toString(){
    //     return "$this->postalCode, $this->houseNumber, $this->streetName, $this->city, $this->country";
    // }

}