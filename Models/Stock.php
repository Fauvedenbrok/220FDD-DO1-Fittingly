<?php

class Stock{
   
    private $quantityOfStock;
    private $price;
    private $dateAdded;
    private $internalReference;
    private $articleID;
    private $partnerID;

    public function __construct(int $quantityOfStock, float $price, string $dateAdded, string $internalReference, int $articleID, int $partnerID){
        $this->quantityOfStock = $quantityOfStock;
        $this->price = $price;
        $this->dateAdded = $dateAdded;
        $this->internalReference = $internalReference;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
    }
}