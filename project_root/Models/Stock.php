<?php

class Stock{
   
    private int $quantityOfStock;
    private decimal $price;
    private date $dateAdded;
    private string $internalReference;
    private int $articleID;
    private int $partnerID;

    public function __construct(int $quantityOfStock, float $price, string $dateAdded, string $internalReference, int $articleID, int $partnerID){
        $this->quantityOfStock = $quantityOfStock;
        $this->price = $price;
        $this->dateAdded = $dateAdded;
        $this->internalReference = $internalReference;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
    }
    public function __toString(){
        return "$this->quantityOfStock, $this->price, $this->dateAdded, $this->internalReference, $this->articleID, $this->partnerID";
    }

}


