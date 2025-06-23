<?php
namespace Models;

/**
 * Class Partners
 *
 * Represents a business partner and provides methods to interact with the database.
 *
 * @package Models
 */
class Partners
{

    /**
     * @var int The unique ID of the partner.
     * @var string The name of the company.
     * @var string The VAT number of the company.
     * @var int The CoC (Chamber of Commerce) number of the company.
     * @var string The postal code of the company address.
     * @var string The house number of the company address.
     */
    private $partnerID;
    private $companyName;
    private $vatNr;
    private $coCNr;
    private $postalCode;
    private $houseNumber;
    
    /**
     * @var mixed CrudModel instance or null.
     */
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
     * @param mixed $crudModel Optional CrudModel instance for database operations.
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