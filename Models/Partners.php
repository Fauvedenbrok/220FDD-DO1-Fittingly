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


}