<?php
namespace Models;
use PDO;
use Core\Database;

class Addresses
{    
    private $postalCode;
    private $country;
    private $city;
    private $streetName;
    private $houseNumber;

    private PDO $db;

    private string $postalCode;
    private string $houseNumber;
    private string $streetName;
    private string $city;
    private string $country;
     
    public function __construct(
        string $postalCode,
        string $houseNumber,
        string $streetName,
        string $city,
        string $country
    ) {
        $this->db = Database::getConnection();

        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetName = $streetName;
        $this->city = $city;
        $this->country = $country;
    }

    public function saveAddress(): bool {
        $stmt = $this->db->prepare("
            INSERT INTO addresses (PostalCode, HouseNumber, StreetName, City, Country)
            VALUES (:postalCode, :houseNumber, :streetName, :city, :country)
        ");
        
        return $stmt->execute([
            ':postalCode' => $this->postalCode,
            ':houseNumber' => $this->houseNumber,
            ':streetName' => $this->streetName,
            ':city' => $this->city,
            ':country' => $this->country
        ]);
    }


    public function __construct($postalCode, $houseNumber, $streetName, $city, $country){
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetName = $streetName;
        $this->city = $city;
        $this->country = $country;
    }
    function __toString(){
        return "$this->postalCode, $this->houseNumber, $this->streetName, $this->city, $this->country";
    }

    // prepared statement voor het toevoegen van een adres
    public function addAddress($conn){
        $sql = "INSERT INTO addresses (postalCode, houseNumber, streetName, city, country) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("sssss", $this->postalCode, $this->houseNumber, $this->streetName, $this->city, $this->country);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}