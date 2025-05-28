<?php

class OrderLines{
    
    private $quantity;
    private $startDateReservation;
    private $endDateReservation;
    private $orderLinePrice;
    private $orderID;
    private $articleID;
    private $partnerID;

    public function __construct(int $quantity, string $startDateReservation, string $endDateReservation, float $orderLinePrice, int $orderID, int $articleID, int $partnerID){
        $this->quantity = $quantity;
        $this->startDateReservation = $startDateReservation;
        $this->endDateReservation = $endDateReservation;
        $this->orderLinePrice = $orderLinePrice;
        $this->orderID = $orderID;
        $this->articleID = $articleID;
        $this->partnerID = $partnerID;
    }
    public function __toString(){
        return "$this->quantity, $this->startDateReservation, $this->endDateReservation, $this->orderLinePrice, $this->orderID, $this->articleID, $this->partnerID";
    }

}