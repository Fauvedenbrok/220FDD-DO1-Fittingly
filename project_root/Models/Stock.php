<?php

/**
 * Class Stock
 *
 * Represents the stock information for an article/partner combination.
 */
class Stock{
   
    private int $quantityOfStock;
    private decimal $price;
    private date $dateAdded;
    private string $internalReference;
    private int $articleID;
    private int $partnerID;

    /**
     * Stock constructor.
     *
     * @param int $quantityOfStock The quantity of stock available.
     * @param float $price The price of the stock item.
     * @param string $dateAdded The date when the stock was added.
     * @param string $internalReference An internal reference for the stock item.
     * @param int $articleID The ID of the article associated with this stock.
     * @param int $partnerID The ID of the partner associated with this stock.
     */
    public function __construct(int $quantityOfStock, float $price, string $dateAdded, string $internalReference, int $articleID, int $partnerID){
        $this->quantityOfStock = $quantityOfStock;
        $this->price = $price;
        $this->dateAdded = $dateAdded;
        $this->internalReference = $internalReference;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
    }
    /**
     * Returns a string representation of the stock.
     *
     * @return string
     */
    public function __toString(){
        return "$this->quantityOfStock, $this->price, $this->dateAdded, $this->internalReference, $this->articleID, $this->partnerID";
    }

}
