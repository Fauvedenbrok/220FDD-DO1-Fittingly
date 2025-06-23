<?php
namespace Models;
/**
 * Class Stock
 *
 * Represents the stock information for an article/partner combination.
 *
 * @package Models
 */
class Stock{
   
    /**
     * @var int The quantity of stock available.
     * @var float The price of the stock item.
     * @var string The date when the stock was added.
     * @var string An internal reference for the stock item.
     * @var int The ID of the article associated with this stock.
     * @var int The ID of the partner associated with this stock.
     */
    private int $quantityOfStock;
    private float $price;
    private string $dateAdded;
    private string $internalReference;
    private int $articleID;
    private int $partnerID;
    
    /**
     * @var mixed CrudModel instance or null.
     */
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
     * @param mixed $crudModel Optional CrudModel instance for database operations.
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

    /**
     * Creates an associative array of the stock properties.
     *
     * @return array Associative array with stock data.
     */
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
