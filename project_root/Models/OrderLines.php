<?php
namespace Models;
/**
 * Class OrderLines
 *
 * Represents an order line (a single item in an order) and provides methods to interact with the database.
 */
class OrderLines{
    
    private $quantity;
    private $startDateReservation;
    private $endDateReservation;
    private $orderLinePrice;
    private $orderID;
    private $articleID;
    private $partnerID;
    private $orderLineInfo;
    
    private $crudModel;

    /**
     * OrderLines constructor.
     *
     * @param int $quantity The quantity of the article in the order line.
     * @param string $startDateReservation The start date of the reservation.
     * @param string $endDateReservation The end date of the reservation.
     * @param float $orderLinePrice The price of the order line.
     * @param int $orderID The ID of the order this line belongs to.
     * @param int $articleID The ID of the article in this order line.
     * @param int $partnerID The ID of the partner associated with this order line.
     */
    public function __construct(int $quantity, string $startDateReservation, string $endDateReservation, float $orderLinePrice, int $orderID, int $articleID, int $partnerID, $crudModel = null){
        $this->quantity = $quantity;
        $this->startDateReservation = $startDateReservation;
        $this->endDateReservation = $endDateReservation;
        $this->orderLinePrice = $orderLinePrice;
        $this->orderID = $orderID;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
        $this->orderLineInfo = $this->createAssociativeArray();
        $this->crudModel = $crudModel ?? new \Models\CrudModel();
    }
    /**
     * Returns a string representation of the order line.
     *
     * @return string
     */
    public function __toString(){
        return "$this->quantity, $this->startDateReservation, $this->endDateReservation, $this->orderLinePrice, $this->orderID, $this->articleID, $this->partnerID";
    }

    /**
     * Creates an associative array of the order line properties.
     *
     * @return array Associative array with order line data.
     */
    public function createAssociativeArray(): array {
        $orderLineArray = array(
            'Quantity' => $this->quantity,
            'StartDateReservation' => $this->startDateReservation,
            'EndDateReservation' => $this->endDateReservation,
            'OrderLinePrice' => $this->orderLinePrice,
            'OrderID' => $this->orderID,
            'ArticleID' => $this->articleID,
            'PartnerID' => $this->partnerID
        );
        return $orderLineArray;
    }

    /**
     * Saves the order line to the database using CrudModel.
     *
     * @return bool True on success, false on failure.
     */
    public function saveOrderLine(): bool {
        return ($this->crudModel)::createData("orderlines", $this->oderLineInfo);
    }
}