<?php
namespace Models;
/**
 * Class Stock
 *
 * Represents the stock information for an article/partner combination.
 */
class Stock{
   
    private int $quantityOfStock;
    private float $price;
    private string $dateAdded;
    private string $internalReference;
    private int $articleID;
    private int $partnerID;
    
    private $crudModel;

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
    public function __construct(int $quantityOfStock, float $price, string $dateAdded, string $internalReference, int $articleID, int $partnerID, $crudModel = null){
        $this->quantityOfStock = $quantityOfStock;
        $this->price = $price;
        $this->dateAdded = $dateAdded;
        $this->internalReference = $internalReference;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
        $this->crudModel = $crudModel ?? new \Models\CrudModel();
    }
    /**
     * Returns a string representation of the stock.
     *
     * @return string
     */
    public function __toString(){
        return "$this->quantityOfStock, $this->price, $this->dateAdded, $this->internalReference, $this->articleID, $this->partnerID";
    }

    public function createAssociativeArray(){
        $stockArray = array(
            'QuantityOfStock' => $this->quantityOfStock,
            'Price' => $this->price,
            'DateAdded' => $this->dateAdded,
            'InternalReference' => $this->internalReference,
            'ArticleID' => $this->articleID,
            'PartnerID' => $this->partnerID,
        );
        return $stockArray;
    }

}
