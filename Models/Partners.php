<?php

class Partners
{


    private $partnerID;
    private $companyName;
    private $vatNr;
    private $coCNr;
    private $postalCode;
    private $houseNumber;

    public function __construct(int $partnerID, string $companyName, string $vatNr, int $coCNr, string $postalCode, string $houseNumber){
        $this->partnerID = $partnerID;
        $this->companyName = $companyName;
        $this->vatNr = $vatNr;
        $this->coCNr = $coCNr;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
    }
    public function __toString(){
        return "$this->partnerID, $this->companyName, $this->vatNr, $this->coCNr, $this->postalCode, $this->houseNumber";
    }

    // prepared statement nog voor het toevoegen van een partner
    public function addPartner($conn){
        $sql = "INSERT INTO partners (partnerID, companyName, vatNr, coCNr, postalCode, houseNumber) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // issssi moet nog veranderd worden naar de juiste types
        // s = string, i = integer, d = double, b = blob
        $stmt->bind_param("issssi", $this->partnerID, $this->companyName, $this->vatNr, $this->coCNr, $this->postalCode, $this->houseNumber);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}