<?php

class OrderLines{
    
    private $quantity;
    private $startDateReservation;
    private $endDateReservation;
    private $orderLinePrice;
    private $orderID;
    private $articleID;
    private $partnerID;
    private $orderLineInfo;

    public function __construct(int $quantity, string $startDateReservation, string $endDateReservation, float $orderLinePrice, int $orderID, int $articleID, int $partnerID){
        $this->quantity = $quantity;
        $this->startDateReservation = $startDateReservation;
        $this->endDateReservation = $endDateReservation;
        $this->orderLinePrice = $orderLinePrice;
        $this->orderID = $orderID;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
        $this->orderLineInfo = $this->createAssociativeArray();
    }
    public function __toString(){
        return "$this->quantity, $this->startDateReservation, $this->endDateReservation, $this->orderLinePrice, $this->orderID, $this->articleID, $this->partnerID";
    }

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

    public function saveCustomer(): bool {
        return CrudModel::createData("orderlines", $this->oderLineInfo);
    }
}