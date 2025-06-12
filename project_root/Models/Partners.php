<?php

/**
 * Class Partners
 *
 * Represents a business partner and provides methods to interact with the database.
 */
class Partners
{


    private $partnerID;
    private $companyName;
    private $vatNr;
    private $coCNr;
    private $postalCode;
    private $houseNumber;
    
    private $crudModel;

    /**
     * Partners constructor.
     *
     * @param int $partnerID The unique ID of the partner.
     * @param string $companyName The name of the company.
     * @param string $vatNr The VAT number of the company.
     * @param int $coCNr The CoC number of the company.
     * @param string $postalCode The postal code of the company address.
     * @param string $houseNumber The house number of the company address.
     */
    public function __construct(int $partnerID, string $companyName, string $vatNr, int $coCNr, string $postalCode, string $houseNumber, $crudModel = null){
        $this->partnerID = $partnerID;
        $this->companyName = $companyName;
        $this->vatNr = $vatNr;
        $this->coCNr = $coCNr;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->crudModel = $crudModel ?? new \Models\CrudModel();
    }
    /**
     * Returns a string representation of the partner.
     *
     * @return string
     */
    public function __toString(){
        return "$this->partnerID, $this->companyName, $this->vatNr, $this->coCNr, $this->postalCode, $this->houseNumber";
    }

}